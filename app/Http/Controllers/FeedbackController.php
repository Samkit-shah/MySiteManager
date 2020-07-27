<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Feedback;

class FeedbackController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth']);
    }

    public function submitfeedback(Request $request)
    {
$this->validate($request, [
'feedback' => ['required',],

]);
// $this->validate()

$user_id = Auth::id();
$feedback = new Feedback();
$feedback->user_id = $user_id;
$feedback->feedback = request('feedback');



$feedback->save();

  return redirect()->back()->with('success', 'Thank You for your valuable feedback');
    }
}
