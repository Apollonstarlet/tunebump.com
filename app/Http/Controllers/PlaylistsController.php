<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlists;
use App\Models\Subgenres;
use App\Models\Musics;
use App\Models\Like;

class PlaylistsController extends Controller
{
    
    public function GetSubGenres(Request $request){
        
         $data = array();
         $mainId = $request->mainId;
         $genres = Subgenres::where('mainId', $mainId)->get();
         $data['genres'] = json_decode(json_encode($genres), TRUE);
         $curator = Playlists::where('status', 'Accepted')->where('genre', $request->mainId)->orderBy('userId', 'DESC')->get();
         $data['num_curator'] = 0;
         $rule = 0;
         foreach($curator as $val){
             if($rule == $val->userId){
                 continue;
             }
             $rule = $val->userId;
             $data['num_curator'] = $data['num_curator'] + 1;
         }
         return $data;
    }
    
    public function GetSubNum(Request $request){
        
         $data = array();
         $subgenres = $request->subGenres;
         $playlists = Playlists::where('genre', $request->mainId)->where('status', 'Accepted')->orderBy('userId', 'DESC')->get();
         $a = array();
         if(isset($subgenres)){
             foreach($subgenres as $genre){
                $state = 0;
                $userId = '';
                foreach($playlists as $playlist){
                    $o_flag = 0;
                    if( $state == 1 && $userId == $playlist->userId){
                        continue;
                    }
                    $flag = strpos($playlist->genres, $genre);
                    if($flag !== false){
                        $userId = $playlist->userId;
                        foreach($a as $val){
                            if($userId == $val){
                                $o_flag = 1;
                                continue;
                            }
                        }
                        if($o_flag == 0){
                            array_push($a, $playlist->userId);
                            $state = 1;
                            continue;
                        }
                    }
                }
             }
             $num = count($a);
         } else{
             $num = 0;
         }
         return $num;
    }
    
    public function addLike(Request $request){
        //
        $like = Like::where('userId', $request->userId)->where('musicId', $request->musicId)->first();
        
        if(!isset($like)){
            $like = new Like();
            $like->userId = $request->userId;
            $like->musicId = $request->musicId;
            $like->save();
            
            $music = Musics::where('id', $request->musicId)->first();
            $music->like = $music->like + 1;
            $music->save();
            return "yes";
        } else{
            if($like->status == 'n'){
                $like->status = 'y';
                $like->save();
                $music = Musics::where('id', $request->musicId)->first();
                $music->like = $music->like + 1;
                $music->save();
                return "yes";
            } else{
            return "no";
            }
        }
    }
    
    public function removeLike(Request $request){
        //
        $like = Like::where('userId', $request->userId)->where('musicId', $request->musicId)->first();
        
        if($like->status == 'y'){
            $like->status = 'n';
            $like->save();
            
            $music = Musics::where('id', $request->musicId)->first();
            $music->like = $music->like - 1;
            $music->save();
            return "yes";
        } else{
            return "no";
        }
    }
}
