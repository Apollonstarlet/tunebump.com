<?php

namespace App\Http\Controllers;

use Spotify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credits;
use App\Models\Musics;
use App\Models\Prices;
use App\Models\Reviews;
use App\Models\Users;
use App\Models\Genres;
use App\Models\Subgenres;
use App\Models\Like;
use Session;

class MusicController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }
    
    public function Home(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        $data = array();
        if($user->role == "artist"){
            $data['genres'] = Subgenres::get();
            $data['musics'] = Musics::orderBy('created_at', 'DESC')->paginate(10);
            $data['like'] = Like::where('userId', $user->id)->where('status', 'y')->get();
            $data['reviews'] = Reviews::join('users', 'users.id', '=', 'reviews.userId')->orderBy('reviews.created_at', 'DESC')
                ->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.created_at', 'reviews.musicId', 'users.spotifyId']);
            return view('/artist/overview', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/admin/users', ['pageConfigs' => $pageConfigs])->with('data', $data);
        }
    }
    
    public function Hot(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        $current = date("Y-m-d H:i:s");
        $ago_1d = date('Y-m-d H:i:s', strtotime($current . ' -1 day'));
        $data = array();
        if($user->role == "artist"){
            $data['genres'] = Subgenres::get();
            $data['musics'] = Musics::where('status', 'Active')->orderBy('created_at', 'DESC')->paginate(10);
            $data['like'] = Like::where('userId', $user->id)->where('status', 'y')->get();
            $data['reviews'] = Reviews::join('users', 'users.id', '=', 'reviews.userId')->orderBy('reviews.created_at', 'DESC')
                ->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.created_at', 'reviews.musicId', 'users.spotifyId']);
            
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
            return view('/artist/overview_hot', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/admin/users', ['pageConfigs' => $pageConfigs])->with('data', $data);
        }
    }

    public function NewSong(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        $data = array();
        $data['credit'] = Credits::where('userId', $user->id)->first();
        $data['genres'] = Genres::get();
        return view('/artist/newPromotion', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }

    public function FilterSong(Request $request)
    {
        $uri = str_replace("https://open.spotify.com/track/","", $request->url);
        $song = Spotify::track($uri)->get();
        $data = json_decode(json_encode($song), TRUE);
        return $data;
    }

    public function AddSong(Request $request)
    {
        $id = $request->user()->id;

        if(!isset($id)){
            Session::flash("error", "Faild. Please insert Spotify's song url.");
        } else if(!isset($request->main_genre)){
            Session::flash("error", "Faild. Please choose main genre.");
        } else if(!isset($request->sub_genre)){
            Session::flash("error", "Faild. Please choose sub genres.");
        } else{
            $fee = Prices::where('name', 'promotion')->first();
            $Credit = Credits::where('userId', $id)->first();
            $rest = $Credit->credits - $fee->price*(int)$request->term;
            if($rest < 0){
                Session::flash("error", "Faild. Your credits is not enough.");
            } else{
                $uri = str_replace("https://open.spotify.com/track/","", $request->id);
                $song = Spotify::track($uri)->get();
                $data = json_decode(json_encode($song), TRUE);
                
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
                $Music = new Musics();
                $Music->userId = $id;
                $Music->title = $data['name'];
                $Music->artist = $data['artists'][0]['name'];
                $Music->spotify = $request->id;
                $Music->genre = $request->main_genre;
                $Music->genres = $genre;
                if ($request->hasFile('upfile') && $request->file('upfile')->isValid()){
                    $file = $request->file('upfile');
                    $filename = date("Y-m-d-h-m").'.'. str_replace('mp3', 'mp3', $request->file('upfile')->guessExtension());
                    $file->move("upload/",$filename);
                    
                    $Music->link = 'upload/'. $filename;
                    $Music->img = $data['album']['images'][0]['url'];
                    $Music->term = (int)$request->term;
                    $Music->save();
                    $Credit->credits = $rest;
                    $Credit->save();
                    Session::flash('success', 'Promotion successful! Follow your promotion via the promotions page.');
                } else{
                    Session::flash("error", "Faild. Please upload song's MP3 file.");
                }
            }
        }
        return back();
    }
    
    public function Promotions(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];

        $data = array();
        $data['ads'] = Musics::where('userId', $request->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $data['count'] = count($data['ads']);

        return view('/artist/promotions', ['pageConfigs' => $pageConfigs])->with('data', $data);
    }
    
    public function Reviews(Request $request){
        $musicId = $request->musicId;
        $reviews = Reviews::join('users', 'users.id', '=', 'reviews.userId')->where('musicId', $musicId)->get(['users.firstname', 'users.img', 'reviews.review', 'reviews.status', 'users.spotifyId']);
        return $reviews = json_decode(json_encode($reviews), TRUE);
    }
    
    public function Cancel(Request $request){
        $musicId = $request->musicId;
        $music = Musics::where('id', $musicId)->first();
        $num = $music->term - $music->review;
        $user_id = $music->userId;
        $music->status = 'Canceled';
        $music->save();
        
        $credit = Credits::where('userId', $user_id)->first();
        $credit->credits += $num*20;
        $credit->save();
        
        return "success";
    }
}
