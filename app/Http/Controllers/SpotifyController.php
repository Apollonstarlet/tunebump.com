<?php

namespace App\Http\Controllers;

use Spotify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Musics;
use App\Models\Credits;
use App\Models\User;
use App\Models\Transactions;
use App\Models\Reviews;
use App\Models\Prices;
use App\Models\Playlists;
use App\Models\Genres;
use App\Models\Subgenres;
use App\Models\Like;
use Session;
use Mail;

class SpotifyController extends Controller
{
    public function ToReview(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $data = array();
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $data['user'] = User::where('spotifyId', $spotifyId)->first();
            $userId = $data['user']->id;
            $data['review_list'] = Reviews::where('userId', $userId)->get();
            $data['like'] = Like::where('userId', $userId)->where('status', 'y')->get();
            $data['musics'] = Musics::where('status', 'Active')->orderBy('created_at', 'DESC')->get();
            $data['reviews'] = Reviews::join('users', 'users.id', '=', 'reviews.userId')->orderBy('reviews.created_at', 'DESC')
                    ->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.created_at', 'reviews.musicId', 'users.spotifyId']);
            $data['playlist'] = Playlists::where('userId', $userId)->where('status', 'Accepted')->get();
            $data['review_music'] = array();
            foreach($data['musics'] as $music){
                $flag = 0;
                foreach($data['playlist'] as $playlist){
                    if($music->genre == $playlist->genre){
                        $genres = explode(", ", $playlist->genres);
                        foreach($genres as $genre){
                            $fla = strpos($music->genres, $genre);
                            if($fla !== false){
                                $flag = 1;
                                continue;
                            }
                        }
                    }
                    if($flag == 1){
                        continue;
                    }
                }
                if($flag == 1){
                    if($music->review < $music->term){
                        foreach($data['review_list'] as $val){
                            if($val->musicId == $music->id){
                                $flag = 0;
                                continue;
                            }
                        }
                    } else{
                        $flag = 0;
                    }
                }
                if($flag == 1){
                    array_push($data['review_music'], $music);
                }
            }
            return view('/curator/overview', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            $arr = array("firstname"=>"", "lastname"=>"", "img"=>"images/user/default.jpg", "role"=>"curator", "spotifyId"=>"");
            $data['user'] = (object)$arr;
            return view('/curator/preload', ['pageConfigs' => $pageConfigs])->with('data', $data);
        }
    }
    
    public function Dashbord(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $data = array();
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $data['user'] = User::where('spotifyId', $spotifyId)->first();
            $userId = $data['user']->id;
            $data['review_list'] = Reviews::where('userId', $userId)->get();
            $data['like'] = Like::where('userId', $userId)->where('status', 'y')->get();
            $data['musics'] = Musics::orderBy('created_at', 'DESC')->paginate(10);
            $data['reviews'] = Reviews::join('users', 'users.id', '=', 'reviews.userId')->orderBy('reviews.created_at', 'DESC')
                    ->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.created_at', 'reviews.musicId', 'users.spotifyId']);
            $data['playlist'] = Playlists::where('userId', $data['user']->id)->where('status', 'Accepted')->get();
            return view('/curator/overview_new', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
    }
    
    public function Hot(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $current = date("Y-m-d H:i:s");
        $ago_1d = date('Y-m-d H:i:s', strtotime($current . ' -1 day'));
        $data = array();
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $data['user'] = User::where('spotifyId', $spotifyId)->first();
            $userId = $data['user']->id;
            $data['review_list'] = Reviews::where('userId', $userId)->get();
            $data['like'] = Like::where('userId', $userId)->where('status', 'y')->get();
            $data['musics'] = Musics::orderBy('created_at', 'DESC')->paginate(10);
            $data['reviews'] = Reviews::join('users', 'users.id', '=', 'reviews.userId')->orderBy('reviews.created_at', 'DESC')
                    ->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.created_at', 'reviews.musicId', 'users.spotifyId']);
            $data['playlist'] = Playlists::where('userId', $data['user']->id)->where('status', 'Accepted')->get();
            
            $hot_reviews = Reviews::where('created_at', '>', $ago_1d)->get();
            if(isset($hot_reviews)){
                $flag = 0;
                foreach($hot_reviews as $val){
                    $hot_music = Musics::where('id', $val->musicId)->first();
                    if($flag == 0)
                        $hot_music->hot = 0;
                    $hot_music->hot = $hot_music->hot + 1;
                    $hot_music->save();
                    $flag = $flag + 1;
                }
                $data['hot'] = Musics::orderBy('hot', 'DESC')->paginate(10);
            } else{
                $data['hot'] = $data['musics'];
            }
            return view('/curator/overview_hot', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
    }
    
    public function Review(Request $request)
    {
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $user = User::where('spotifyId', $spotifyId)->first();
            
            $flag = Reviews::where('musicId', $request->musicId)->where('userId', $user->id)->first();
            if(!isset($flag)){
                $review = new Reviews();
                $review->musicId = $request->musicId;
                $review->userId = $user->id;
                $review->review = $request->review;
                $review->status = $request->status;
                $review->save();
                
                $music = Musics::where('id', $request->musicId)->first();
                $to = User::where('id', $music->userId)->first();
                $music->review = $music->review + 1;
                if($music->review == $music->term){
                    $music->status = 'Completed';
                }
                $music->save();
                
                $price = Prices::where('name', 'review')->first();
                $credit = Credits::where('userId', $user->id)->first();
                $credit->credits = $credit->credits + $price->price;
                $credit->save();
                
                
    			$toMail = $to->email;
    			$mail_data = array('name' => $to->firstname, 'review' => $request->review,);
    			Mail::send('mail.get_review', $mail_data, function($message) use ($toMail) {
    				$message->from('info@tunebump.com', 'Tunebump');
    				$message->to($toMail)->subject('You have received a new review');
    			  });
            }
        }
        return back();
    }

    public function Signup(Request $request)
    {
        $is_User = User::where('email', $request->email)->first();
        $request->session()->put('spotifyId', $request->spotifyId);
        if(!isset($is_User)){
            $user = new User();
            $user->firstname = $request->firstname; 
            $user->email = $request->email; 
            $user->spotifyId = $request->spotifyId; 
            $user->role = 'curator';
            $user->img = $request->img;
            $user->save();
            $currentUser = User::where('email', $request->email)->first();

            $credits = new Credits();
            $credits->userId = $currentUser->id;
            $credits->credits = 0;
            $credits->save();
        }
        return 'done';
    }
    
    public function Playlist(Request $request){
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $data = array();
            $data['user'] = User::where('spotifyId', $spotifyId)->first();
            $data['playlists'] = Playlists::where('userId', $data['user']->id)->paginate(10);
            $data['review_playlists'] = Playlists::where('userId', $data['user']->id)->where('status', 'review')->paginate(10);
            $data['accept_playlists'] = Playlists::where('userId', $data['user']->id)->where('status', 'Accepted')->paginate(10);
            $data['denied_playlists'] = Playlists::where('userId', $data['user']->id)->where('status', 'Denied')->paginate(10);
            $data['genres'] = Genres::get();
            return view('/curator/playlist', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
    }
    
    public function AddPlaylist(Request $request){
        //
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $user = User::where('spotifyId', $spotifyId)->first();
            if(!isset($request->url)){
                Session::flash("error", "Faild. Please insert playlist's playlist url.");
            } else if(!isset($request->main_genre)){
                Session::flash("error", "Faild. Please choose main genre.");
            } else if(!isset($request->sub_genre)){
                Session::flash("error", "Faild. Please choose sub genres.");
            } else{
               $url = str_replace("https://open.spotify.com/playlist/","", $request->url);
                if (strpos($url, '?')) { 
                    $val = explode("?",$url);
                    $url = $val[0];
                }
                $info = Spotify::playlist($url)->get();
                $data = json_decode(json_encode($info), TRUE);
                if(count($data['images']) > 0){
                    if($spotifyId == $data['owner']['id']){
                        $playlist = Playlists::where('userId', $user->id)->where('spotifyId', $url)->first();
                        if(!isset($playlist)){
                            $playlist = new Playlists();
                        }
                        $genres = $request->sub_genre;
                        $genre = '';
                        $i = 0;
                        foreach($genres as $val){
                            if($i == 0){
                                $genre = $val;
                            } else{
                                $genre = $genre.', '.$val;
                            }
                            $i++;
                        }
                        $playlist->userId = $user->id;
                        $playlist->title = $data['name'];
                        $playlist->spotifyId = $url;
                        $playlist->genre = $request->main_genre;
                        $playlist->genres = $genre;
                        $playlist->img = $data['images'][0]['url'];
                        $playlist->followers = $data['followers']['total'];
                        $playlist->tracks = count($data['tracks']['items']);
                        $playlist->save();
                        Session::flash('success', 'New playlist posting success!');
                    } else{
                        Session::flash("error", "Faild. It is not your playlist.");
                    } 
                } else{
                    Session::flash("error", "Faild. Playlist url is not correct.");
                }
            }
        }
        
        return back();
    }
    
    public function Balance(Request $request){
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $data = array();
            $user = User::where('spotifyId', $spotifyId)->first();
            $credits = Credits::where('userId', $user->id)->first();
            $data['user'] = $user;
            $data['credits'] = $credits->credits;
            $data['pending'] = 0;
            $data['paid'] = 0;
            $pending_credits = Transactions::where('userId', $user->id)->where('status', 'Pending')->get();
            if(isset($pending_credits)){
                foreach($pending_credits as $val){
                    $data['pending'] = $data['pending'] + $val->description;
                }
            }
            $paid = Transactions::where('userId', $user->id)->where('status', 'Paid')->get();
            if(isset($paid)){
                foreach($paid as $val){
                    $data['paid'] = $data['paid'] + $val->amount;
                }
            }
            $data['transactions'] = Transactions::where('userId', $user->id)->paginate(10);
            $data['count'] = count($data['transactions']);
            return view('/curator/balance', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
    }
    
    public function SendInvoice(Request $request){
        $spotifyId = $request->session()->get('spotifyId');
        if(isset($spotifyId)){
            $user = User::where('spotifyId', $spotifyId)->first();
            $transaction = new Transactions();
            $transaction->userId = $user->id;
            $transaction->paypal = $request->account;
            $transaction->description = $request->credits;
            $transaction->amount = $request->credits * 0.1;
            $transaction->status = 'Pending';
            $transaction->save();
            $credits = Credits::where('userId', $user->id)->first();
            $credits->credits = $credits->credits - $request->credits;
            $credits->save();
        }
        
        return back();
    }
}