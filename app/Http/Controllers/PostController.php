<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{

   public function createpost(){


 
$user_id = Auth::id();
   $post = new Post();
  $post->user_id=$user_id;
   $post->title = request('title');
   $post->description = request('description');  
    $post->sitelink = request('sitelink');
   

   $post->save();

    return redirect()->route('showposts');
   }


   
  public function search(Request $request){

  return view('post.search',compact('searchresult'));
  }

     public function showpost(Request $request){

$search=$request->get('search');
     $user=Auth::user();
     
     $posts=Post::where('user_id',$user->id)->where('title','like','%'.$search.'%')->get();


     return view('post.showpost',compact('user','posts'));
     }

     public function deletelink($id) {
     DB::delete('delete from posts where id = ?',[$id]);
      return redirect()->back()->with('success', 'Link Deleted');
     }
}
