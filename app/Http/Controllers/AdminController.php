<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Playlists;
use App\Models\Transactions;
use Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }
    
    public function Playlists(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        if($user->role == "admin"){
            $data = array();
            $data['playlists'] = Playlists::join('users', 'users.id', '=', 'playlists.userId')->get(['users.firstname', 'users.email', 'playlists.title', 'playlists.genres', 'playlists.spotifyId', 'playlists.img', 'playlists.status']);
    
            return view('/admin/playlists', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
        
    }
    
    public function Status(Request $request)
    {
        $user = $request->user();
        if($user->role == "admin"){
            $status = $request->status;
            $playlistId = $request->id;
            $playlist = Playlists::where('spotifyId', $playlistId)->first();
            $to = User::where('id', $playlist->userId)->first();
            $toMail = $to->email;
    		$mail_data = array('name' => $to->firstname, 'title' => $playlist->title,);
            if($playlist->status != $status){
                if($status == 'Accepted'){
    			Mail::send('mail.get_accept', $mail_data, function($message) use ($toMail) {
    				$message->from('info@tunebump.com', 'Tunebump');
    				$message->to($toMail)->subject('Accept e-mail');
    			  });
                } else{
                Mail::send('mail.get_reject', $mail_data, function($message) use ($toMail) {
    				$message->from('info@tunebump.com', 'Tunebump');
    				$message->to($toMail)->subject('Reject e-mail');
    			  });   
                }
                $playlist->status = $status;
                $playlist->save();
            }
        }
        return "Success!";
    }
    
    public function Payment(Request $request)
    {
        $transactionId = $request->id;
        $transaction = Transactions::where('id', $transactionId)->first();
        $transaction->status = 'Paid';
        $transaction->save();
        
        return "Success!";
    }
    
    public function Curators(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        if($user->role == "admin"){
            return view('/admin/curators', ['pageConfigs' => $pageConfigs]);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
        
    }
    
    public function Withdraw(Request $request)
    {
        // navbar large
        $pageConfigs = ['navbarLarge' => false];
        $user = $request->user();
        if($user->role == "admin"){
            $data = array();
            $data['transactions'] = Transactions::join('users', 'users.id', '=', 'transactions.userId')->where('transactions.paypal', 'like', '%@%')
            ->get(['transactions.id', 'users.firstname', 'users.email', 'transactions.paypal', 'transactions.description', 'transactions.amount', 'transactions.status', 'transactions.created_at']);
            return view('/admin/withdrawals', ['pageConfigs' => $pageConfigs])->with('data', $data);
        } else{
            return view('/pages/page-404', ['pageConfigs' => $pageConfigs]);
        }
        
    }
}