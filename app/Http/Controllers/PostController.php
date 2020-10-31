<?php

namespace App\Http\Controllers;

use App\Mail\Welcomemail;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PDF;

class PostController extends Controller {
    public function __construct() {
        $this->middleware( ['auth', 'verified'] );
    }

    public function createpost( Request $request ) {
        $this->validate( $request, [
            'title' => ['required', ],
            'sitelink' => ['required', 'url'],
        ] );

        $user_id = Auth::id();
        $post = new Post();
        $post->user_id = $user_id;
        $post->title = request( 'title' );
        $post->description = request( 'description' );
        $post->sitelink = request( 'sitelink' );

        $post->save();

        return redirect()->route( 'showposts' );
    }

    // public function search( Request $request )
    // {
    //     return view( 'post.search', compact( 'searchresult' ) );
    // }

    public function showpost( Request $request ) {
        $searchbydescription = $request->get( 'searchbydescription' );

        $searchbytitle = $request->get( 'searchbytitle' );
        $user = Auth::user();
        if ( $searchbydescription == null && $searchbytitle == null ) {
            $posts = Post::where( 'user_id', $user->id )->get()->sortByDesc( 'created_at' );

            $searchresults = '';
            return view( 'post.showpost', compact( 'user', 'posts', 'searchresults' ) );
        } else if ( $searchbydescription == null ) {
            $posts = Post::where( 'user_id', $user->id )->where( 'title', 'like', '%' . $searchbytitle .
            '%' ) ->get()->sortByDesc( 'created_at' );
            $searchresults = 'Search result having the searched keyword in your link title';
            return view( 'post.showpost', compact( 'user', 'posts', 'searchresults' ) );
        } else if ( $searchbytitle == null ) {
            $posts = Post::where( 'user_id', $user->id )->where( 'description', 'like', '%' . $searchbydescription .
            '%' ) ->get()->sortByDesc( 'created_at' );

            $searchresults = 'Search result having the searched keyword in your link description';

            return view( 'post.showpost', compact( 'user', 'posts', 'searchresults' ) );
        }

    }

    public function deletelink( $id ) {
        DB::delete( 'delete from posts where id = ?', [$id] );
        return redirect()->back()->with( 'success', 'Link Deleted' );
    }

    public function myprofile() {
        $user = Auth::user();
        return view( 'myprofile', compact( 'user' ) );

    }

    public function downloadPDF( $user ) {

        $user = Auth::user();

        $site_details = Post::where( 'user_id', $user->id )->get();
        $pdf = PDF::loadView( 'post.linkspdf', compact( 'site_details' ) );

        return $pdf->download( 'mysitemanager(sitelinks).pdf' );
    }


}
