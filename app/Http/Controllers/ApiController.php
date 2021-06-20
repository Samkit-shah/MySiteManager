<?php

namespace App\Http\Controllers;
use App\Pocketearned;
use App\Pocketspent;
use App\User;
use App\Post;
use App\Pocketsevent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;

class ApiController extends Controller
{

    public function register_google(Request $request)
    {
        $user_exist = User::where('email',  $request->email)->count();
        if ($user_exist) {
            return response()->json(null, 406);//Not Acceptable
        }else {
            $name=$request->name;
            $email=$request->email;
            $contactno=$request->contactno;
            $google_id=$request->google_id;

            $userdetails = User::create([
            'name' => $name,
            'email' => $email,
            'contactno' => 0000000000,
            'google_id' => $google_id,
            'password' => Hash::make('Dummy123')
            ]);
            return response()->json($userdetails, 201);
        }

    }
    public function login_google(Request $request)
    {
        $remember_me=$request->get('remember');
        // return response()->json($r, 201);
        $user_details = User::where('email',  $request->email)->count();
        if ($user_details == 1) {
            $user = User::where('email', $request->email)->get();
            $id=$user[0]['id'];
            $res=['email' => $request->email,'remember_me' => $remember_me,'id'=>$id];
            return response()->json($res, 201);
        }else {
             $res=['error' => 'true','email' => '', 'message'=>'Error'];
             return response()->json($res, 401);
        }

    }

    public function register(Request $request)
    {
        $user_exist = User::where('email',  $request->email)->count();
        if ($user_exist) {
            return response()->json(null, 406);//Not Acceptable
        }else {
            $name=$request->name;
            $email=$request->email;
            $contactno=$request->contactno;
            $password=$request->password;
            $userdetails = User::create([
            'name' => $name,
            'email' => $email,
            'contactno' => $contactno,
            'password' => Hash::make($password)
            ]);
            return response()->json($userdetails, 201);
        }

    }
    public function login(Request $request)
    {
        if (empty( $request->email)) {
            $res=['error' => true,'event_id' => ''];
            return response()->json($res, 400);
            die;
        }
        if (empty( $request->password)) {
            $res=['error' => true,'event_id' => ''];
            return response()->json($res, 400);
            die;
        }
        $remember_me=$request->get('remember');
        // return response()->json($r, 201);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember_me)) {
            $classname = User::where('email', $request->email)->get();
            $id=$classname[0]['id'];
            $res=['email' => $request->email,'remember_me' => $remember_me,'id'=>$id];
            return response()->json($res, 201);
        }else {
             $res=['error' => 'true','email' => '', 'message'=>'Error'];
             return response()->json($res, 401);
        }

    }
    public function getevents(Request $request)
    {
        $user_id = $request->userid;
        $events = Pocketsevent::where( 'user_id', $user_id )->orderBy('updated_at', 'desc')->get();
        foreach ($events as &$event) {
            $total_spent = DB::table('spent')
            ->where([
                ['user_id', $user_id],
                ['event_id', $event['id']],
            ])
            ->sum('spent');
            $event['total_spent']=$total_spent;
            $total_earned = DB::table('earned')
            ->where([
                ['user_id', $user_id],
                ['event_id', $event['id']],
            ])
            ->sum('earned');
            $event['total_earned']=$total_earned;
        }
        return response()->json($events, 201);
    }
    public function deleteevent(Pocketsevent $event)
    {
        $event->delete();
        // $res=['success' => true];
        return response()->json(null, 204);
    }
    public function getspent(Request $request)
    {
        $user_id = $request->userid;
        $event_id = $request->event_id;
        $spent = Pocketspent::where( 'user_id', $user_id )->where( 'event_id', $event_id )->get();
        return response()->json($spent, 201);
    }
    public function getearned(Request $request)
    {
        $user_id = $request->userid;
        $event_id = $request->event_id;
        $earned = Pocketearned::where( 'user_id', $user_id )->where( 'event_id', $event_id )->get();
        return response()->json($earned, 201);
    }
    public function getallfromevent(Request $request)
    {
        $user_id = $request->userid;
        $event_id = $request->event_id;
        $earned = Pocketearned::where( 'user_id', $user_id )->where( 'event_id', $event_id )->orderBy('created_at', 'desc')->get();
        $spent = Pocketspent::where( 'user_id', $user_id )->where( 'event_id', $event_id )->orderBy('created_at', 'desc')->get();
        $response['earned'] =$earned;
        $response['spent'] =$spent;
        return response()->json($response, 201);
    }
    public function addevent( Request $request ) {
        $user_id = $request->userid;
        $event_name = $request->event_name;
        if (empty( $event_name)) {
            $res=['error' => true,'event_id' => ''];
            return response()->json($res, 400);
            die;
        }
        $Pocketsevent = new Pocketsevent();

        $Pocketsevent->user_id = $user_id;
        $Pocketsevent->event_name = $event_name;
        $Pocketsevent->save();

        $lastevent =  $Pocketsevent->id;
        $res=['error' => false,'event_id' => $lastevent];
        return response()->json($res, 201);
    }
    public function addearned( Request $request ) {
        $user_id = $request->userid;
        $event_id = $request->event_id;
        $earned_amount = $request->earned_amount;
        $earned_note = $request->earned_note;
        $earned_mode = $request->earned_mode;

        if (empty($event_id)) {
            $res=['error' => true,'message' => 'Error'];
            return response()->json($res, 400);
            die;
        }
        if (empty($earned_amount)) {
            $res=['error' => true,'message' => 'Please enter the Earned Amount'];
            return response()->json($res, 400);
            die;
        }
        if (empty($earned_note)) {
            $earned_note= '';
        }

        $lastearned = Pocketearned::where(

            [
                ['user_id', $user_id],
                ['event_id', $event_id],
            ]

        )->get()->last();
        if (empty($lastearned)) {
            $lastearned_total=0;
        } else {
            $lastearned_total=$lastearned->total_earned;
        }
        $Pocketearned = new Pocketearned();
        $Pocketearned->user_id = $user_id;
        $Pocketearned->event_id = $event_id;
        $Pocketearned->total_earned = $earned_amount + $lastearned_total;
        $Pocketearned->earned = $earned_amount;
        $Pocketearned->earned_note = $earned_note;
        $Pocketearned->earned_mode = $earned_mode;
        $Pocketearned->save();
        $lastearned_added =  $Pocketearned->id;
        $res=['error' => false,'message' => 'Amount Added'];
        return response()->json($res, 201);
    }
    public function addspent( Request $request ) {
        $user_id = $request->userid;
        $event_id = $request->event_id;
        $spent_amount = $request->spent_amount;
        $spent_note = $request->spent_note;
        $spent_mode = $request->spent_mode;

        if (empty($event_id)) {
            $res=['error' => true,'message' => 'Error'];
            return response()->json($res, 400);
            die;
        }
        if (empty($spent_amount)) {
            $res=['error' => true,'message' => 'Please enter the Spent Amount'];
            return response()->json($res, 400);
            die;
        }
        if (empty($spent_note)) {
            $spent_note= '';
        }

        $lastspent = Pocketspent::where(

            [
                ['user_id', $user_id],
                ['event_id', $event_id],
            ]

        )->get()->last();
        if (empty($lastspent)) {
            $lastspent_total=0;
        } else {
            $lastspent_total=$lastspent->total_spent;
        }
        $Pocketspent = new Pocketspent();
        $Pocketspent->user_id = $user_id;
        $Pocketspent->event_id = $event_id;
        $Pocketspent->total_spent = $spent_amount + $lastspent_total;
        $Pocketspent->spent = $spent_amount;
        $Pocketspent->spent_note = $spent_note;
        $Pocketspent->spent_mode = $spent_mode;
        $Pocketspent->save();
        $lastspent_added =  $Pocketspent->id;
        $res=['error' => false,'message' => 'Amount Added'];
        return response()->json($res, 201);
    }
    public function editpocketnote( Request $request ) {
        // $user_id = $request->userid;
        $dataid = $request->dataid;
        $type = $request->type;
        $note = $request->note;
        $mode = $request->mode;

        if (empty($note)) {
            $res=['error' => true,'message' => 'Error'];
            return response()->json($res, 400);
            die;
        }

        DB::table($type)
                ->where('id', $dataid)
                ->update([$type.'_note' => $note,$type.'_mode' =>  $mode]);
        $res=['error' => false,'message' => 'Note Updated'];
        return response()->json($res, 201);
    }
    public function deletepocketnote( Request $request ) {
        $dataid = $request->dataid;
        $type = $request->type;

        $delid=DB::table( $type)->where('id', '=', $dataid )->delete();
        if ($delid) {
            return response()->json(null, 204);
        } else {
           return response()->json(null, 500);
        }
    }

    public function getsavedlinks(Request $request)
    {
        $posts = Post::where( 'user_id', $request->userid )->orderBy('created_at', 'DESC')->get();
        return response()->json($posts, 201);
    }
    public function addlink(Request $request)
    {
         if (empty( $request->title)) {
            $res=['error' => true,'link_id' => ''];
            return response()->json($res, 400);
            die;
        }
        $user_id = $request->userid;
        $post = new Post();
        $post->user_id = $user_id;
        $post->title =$request->title;
        $post->description =$request->description;
        $post->sitelink =$request->sitelink;
        $post->save();
        $lastlink =  $post->id;
        if ($lastlink) {
            $res=['error' => false,'link_id' => $lastlink];
            return response()->json($res, 201);
        } else {
            $res=['error' => true,'link_id' => ''];
            return response()->json($res, 201);
        }
    }
    public function deletelink(Post $link)
    {
        $delid=$link->delete();
        if ($delid) {
            return response()->json(null, 204);
        } else {
           return response()->json(null, 500);
        }
    }
}
