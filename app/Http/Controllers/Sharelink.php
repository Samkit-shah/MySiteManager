<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Mail\Sharepostmail;
use App\Post;
use Redirect, Response, DB, Config;
use Mail;
use Auth;

class Sharelink extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mailsend()
    {
        $user = Auth::user();

        $linkdata = Post::where('user_id', $user->id)->get();
        $mailto = $user->email;
// return view('email.sharepost',['linkdata'=>$linkdata]);


        Mail::to($mailto)->send(new Sharepostmail($linkdata));
        return redirect()->back()->with('mailsent', 'Check your,Mail box.<br> We have mailed you your links');
    }
}
