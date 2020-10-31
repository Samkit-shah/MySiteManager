<?php

namespace App\Http\Controllers;
use App\Pocketearned;
use App\Pocketspent;
use App\Pocketsevent;
use Illuminate\Support\Facades\DB;

use Auth;
use Illuminate\Http\Request;

class PocketController extends Controller {
    public function __construct() {
        $this->middleware( ['auth', 'verified'] );
    }

    public function addevent( Request $request ) {
        $this->validate( $request, [
            'event_name' => ['required', 'string'],
        ] );

        $user_id = Auth::id();
        $Pocketsevent = new Pocketsevent();

        $Pocketsevent->user_id = $user_id;
        $Pocketsevent->event_name = request( 'event_name' );
        $Pocketsevent->save();


   $lastevent = Pocketsevent::where(
   'user_id', '=', $user_id
   )->get()->last();




 $Pocketspent = new Pocketspent();
 $Pocketspent->user_id = $user_id;
 $Pocketspent->event_id = $lastevent->id;
 $Pocketspent->total_spent = '0';
 $Pocketspent->spent = '0';
 $Pocketspent->save();


$Pocketearned = new Pocketearned();
$Pocketearned->user_id = $user_id;
$Pocketearned->event_id = $lastevent->id;
$Pocketearned->total_earned = '0';
$Pocketearned->earned = '0';
$Pocketearned->save();



        return redirect()->route( 'showpocket' );
    }

    public function showpocket( Request $request ) {
        $user_id = Auth::id();

        $events = Pocketsevent::where( 'user_id', $user_id )->get();
        $earned = Pocketearned::where( 'user_id', $user_id )->get();
        $spent = Pocketearned::where( 'user_id', $user_id )->get();

        // echo $earned;
        return view( 'pocket.pockethome', compact( 'events', 'earned', 'spent' ) );
    }

    public function eventdetails( Request $request, $eventid ) {
        $user_id = Auth::id();

// echo $eventid;
        $events = Pocketsevent::where( 'user_id', $user_id )->get();
        $earned = Pocketearned::where(
            [
                ['user_id', $user_id],
                ['event_id', $eventid],
            ]

        )->get();


        $spent = Pocketspent::where( [
        ['user_id', $user_id],
        ['event_id', $eventid],
        ] )->get();
// echo $spent;
        return view( 'pocket.eventdetails', compact( 'events', 'earned', 'spent' ) );

    }

    public function addearned( Request $request, $eventid ) {
        $user_id = Auth::id();
        $lastearned = Pocketearned::where(
            'user_id', '=', $user_id, 'and', 'event_id', $eventid
        )->get()->last();
        // echo $lastearned->total_earned;
        $this->validate( $request, [
            'earned' => ['required', 'integer'],
        ] );

        $user_id = Auth::id();
        $Pocketearned = new Pocketearned();
        $Pocketearned->user_id = $user_id;
        $Pocketearned->event_id = $lastearned->event_id;
        $Pocketearned->total_earned = request( 'earned' ) + $lastearned->total_earned;
        $Pocketearned->earned = request( 'earned' );
        $Pocketearned->save();

        return  redirect()->back()->with( 'success', 'Amount Added' );

    }
    public function addspent( Request $request, $eventid ) {
    $user_id = Auth::id();
    $lastspent = Pocketspent::where(
    'user_id', '=', $user_id, 'and', 'event_id', $eventid
    )->get()->last();
    // echo $lastspent->total_spent;
    $this->validate( $request, [
    'spent' => ['required', 'integer'],
    ] );

    $user_id = Auth::id();
    $Pocketspent = new Pocketspent();
    $Pocketspent->user_id = $user_id;
    $Pocketspent->event_id = $lastspent->event_id;
    $Pocketspent->total_spent = request( 'spent' ) + $lastspent->total_spent;
    $Pocketspent->spent = request( 'spent' );
    $Pocketspent->save();

    return redirect()->back()->with( 'success', 'Amount Added' );

    }


      public function deleteevent( $eventid ) {
      DB::delete( 'delete from events where id = ?', [$eventid] );
      return redirect()->back()->with( 'success', 'Event Deleted' );
      }

}
