<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          $user=Auth::user();
          // $posts=Post::all();
          $posts=Post::where('user_id',$user->id)->get();
          return view('home',compact('user','posts'));
     
    }
}
