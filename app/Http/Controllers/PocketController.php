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

        $attributes = [
            'event_name' => 'Name of the Event',

        ];
        $rules = [
            'event_name' => 'required',
        ];
        $messages = [
            'event_name.*' => 'Please check ',

        ];
        $request->validate( $rules, $messages, $attributes );

        $user_id = Auth::id();
        $Pocketsevent = new Pocketsevent();

        $Pocketsevent->user_id = $user_id;
        $Pocketsevent->event_name = request( 'event_name' );
        $Pocketsevent->save();

        $lastevent =  $Pocketsevent->id;
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
        $events = Pocketsevent::where( [
            ['user_id', $user_id],
            ['id', $eventid],
        ] )->get();
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
        $total_spent = DB::table('spent')
        ->where([
            ['user_id', $user_id],
            ['event_id', $eventid],
        ])
        ->sum('spent');
        $total_earned = DB::table('earned')
        ->where([
            ['user_id', $user_id],
            ['event_id', $eventid],
        ])
        ->sum('earned');

        // echo $spent;
        // echo $earned;
        // echo $events;
        return view('pocket.eventdetails', compact('events', 'earned', 'spent', 'total_spent', 'total_earned'));


    }

    public function addearned( Request $request, $eventid ) {
        $user_id = Auth::id();
        // echo = request( 'earned' ) ;
        $lastearned = Pocketearned::where(

            [
                ['user_id', $user_id],
                ['event_id', $eventid],
            ]

        )->get()->last();
        if (empty($lastearned)) {
            $lastearned_total=0;
        } else {
            $lastearned_total=$lastearned->total_earned;
        }
        $this->validate( $request, [
            'earned' => ['required', 'integer'],
            'earned_note' => ['required'],
        ] );
        $Pocketearned = new Pocketearned();
        $Pocketearned->user_id = $user_id;
        $Pocketearned->event_id = $eventid;
        $Pocketearned->total_earned = request( 'earned' ) + $lastearned_total;
        $Pocketearned->earned = request( 'earned' );
        $Pocketearned->earned_note = request( 'earned_note' );
        $Pocketearned->save();
        return redirect()->back()->with( 'success', 'Amount Added' );
    }

    public function addspent( Request $request, $eventid ) {
        $user_id = Auth::id();
        $lastspent = Pocketspent::where(
            [
                ['user_id', $user_id],
                ['event_id', $eventid],
            ]

        )->get()->last();
        if (empty($lastspent)) {
            $lastspent_total=0;
        } else {
            $lastspent_total=$lastspent->total_earned;
        }
        // echo $lastspent->total_spent;
        $this->validate( $request, [
            'spent' => ['required', 'integer'],
            'spent_note' => ['required'],
        ] );

        $user_id = Auth::id();
        $Pocketspent = new Pocketspent();
        $Pocketspent->user_id = $user_id;
        $Pocketspent->event_id = $eventid;
        $Pocketspent->total_spent = request( 'spent' ) + $lastspent_total;
        $Pocketspent->spent = request( 'spent' );
        $Pocketspent->spent_note = request( 'spent_note' );
        $Pocketspent->save();

        return redirect()->back()->with( 'success', 'Amount Added' );

    }

 public function addearnednote( Request $request, $earnedid ) {

        $this->validate( $request, [
            'earned_note' => ['required'],
        ] );
        DB::table('earned')
                ->where('id', $earnedid)
                ->update(['earned_note' => request( 'earned_note' )]);

        return redirect()->back()->with( 'success', 'Earned Note Updated' );
    }

     public function addspentnote( Request $request, $spentid ) {
        $this->validate( $request, [
            'spent_note' => ['required'],
        ] );
        DB::table('spent')
                ->where('id', $spentid)
                ->update(['spent_note' => request( 'spent_note' )]);
        return redirect()->back()->with( 'success', 'Spent Note Updated' );
    }


    public function deleteevent( $eventid ) {
        DB::delete( 'delete from events where id = ?', [$eventid] );
        return redirect()->back()->with( 'success', 'Event Deleted' );
    }

}
