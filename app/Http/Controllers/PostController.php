<?php

namespace App\Http\Controllers;

use App\Mail\Welcomemail;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function createpost(Request $request)
    {
        $this->validate($request, [
            'title' => ['required',],
            'sitelink' => ['required','url'],
        ]);
// $this->validate()

        $user_id = Auth::id();
        $post = new Post();
        $post->user_id = $user_id;
        $post->title = request('title');
        $post->description = request('description');
        $post->sitelink = request('sitelink');


        $post->save();

        return redirect()->route('showposts');
    }


    public function search(Request $request)
    {

        return view('post.search', compact('searchresult'));
    }

    public function showpost(Request $request)
    {

        $search = $request->get('search');
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->where('title', 'like', '%' . $search . '%')->get();



        return view('post.showpost', compact('user', 'posts'));
    }

    public function deletelink($id)
    {
        DB::delete('delete from posts where id = ?', [$id]);
        return redirect()->back()->with('success', 'Link Deleted');
    }


    public function myprofile()
    {
        $user = Auth::user();
        return view('myprofile', compact('user'));


    }

    public function downloadPDF($user) {



        $user = Auth::user();

        $site_details = Post::where('user_id', $user->id)->get();
        $pdf = PDF::loadView('post.linkspdf', compact('site_details'));

        return $pdf->download('mysitemanager(sitelinks).pdf');
    }

}
