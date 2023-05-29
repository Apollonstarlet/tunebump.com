<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }
    
    public function Setting(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        $data = array();
        
        if($user->role == 'artist'){
            $user = $request->user();
            return view('/artist/setting', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } elseif($user->role == 'admin'){
            $user = $request->user();
            return view('/admin/setting', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            
        }
    }
    
    public function Profile(Request $request)
    {
        $user = User::where('email', $request->user()->email)->first();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;

        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $file = $request->file('image');
            $filename = date("Y-m-d-h-m").'.'. str_replace('jpg', 'jpg', $request->file('image')->guessExtension());
            
            $file->move("images/user/",$filename);
            $user->img = 'images/user/'. $filename;
        }

        $user->save();
        return redirect()->back()->with(session()->flash('success', 'Profile change successful'));
    }
    
    public function SetPassword(Request $request)
    {
        $user = User::where('email', $request->user()->email)->first();
        if($request->newpwd == $request->repwd){
            if(Hash::check($request->get('oldpwd'), Auth::user()->password)){
                $user->password = Hash::make($request->newpwd);
                $user->save();
                return redirect()->back()->with(session()->flash('success', 'Password change successful'));
            } else{
                return redirect()->back()->with(session()->flash('error', 'Your current password is incorrect'));
            }
        } else{
            return redirect()->back()->with(session()->flash('error', 'Your new password is incorrect'));
        }
    }
}
