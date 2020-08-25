<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notes;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function addnotespage()
    {
        return view('notes.addnote');
    }

    public function addnotetodb(Request $request)
    {
        $user = Auth::user();
        $attributes = [
            'checkforlist' => 'Check Box of List',
            'checkforpara' => 'Check Box of Paragrph',
        ];
        $rules = [
            'checkforlist' => 'required_without:checkforpara',
            'notedata.*' => 'required_with:checkforlist|max:100',
            'paranotedata' => 'required_with:checkforpara|max:255',
            'checkforpara' => 'required_without:checkforlist',
            'topic' => 'required',
        ];
        $messages = [
            'topic.required' => 'field is ss required.',
            'paranotedata.max' => 'Word Limit Exceeded',

        ];

        $request->validate($rules, $messages, $attributes);

        if ($request->input('checkforlist') == '1') {
            $string = serialize($request['notedata']);

            $post = new Notes();
            $post->user_id = $user->id;
            $post->topic = request('topic');
            $post->typeofnote = 'list';
            $post->note_data = $string;

            $post->save();

            return redirect()->route('addnotes')->with('success', 'Note Added,You can see your saved notes in <a
                 href="/shownotes" style="color:darkblue">MyNotes</a> Section.');
        } else if ($request->input('checkforpara') == '0') {

            $post = new Notes();
            $post->user_id = $user->id;
            $post->topic = request('topic');
            $post->typeofnote = 'para';
            $post->note_data = request('paranotedata');

            $post->save();

            return redirect()->route('addnotes')->with('success', 'Note Added,You can see your saved notes in <a
                href="/shownotes" style="color:darkblue">MyNotes</a> Section.');
        }
    }

    public function shownotes(Request $request)
    {
        $user = Auth::user();
        $search = $request->get('search');
        // $posts = Post::all();
        $notes = Notes::where('user_id', $user->id)->where('topic', 'like', '%' . $search .
            '%')->get()->sortByDesc('created_at');

        return view('notes.shownotes', compact('notes', 'user'));
    }




    public function deletenote($id)
    {
        DB::delete('delete from notes where id = ?', [$id]);
        return redirect()->back()->with('success', 'Note Deleted');
    }

    public function downloadPDFofnotes($user)
    {

        $user = Auth::user();
        $note_details = Notes::where('user_id', $user->id)->get();
        $pdf = PDF::loadView('notes.notespdf', compact('note_details'));
        return $pdf->download('mysitemanager(notes).pdf');
    }
    public function editnotedata($id)
    {
        $notedata = Notes::findOrFail($id);
        // echo $notedata;
        return view('notes.editnote', compact('notedata'));
    }
    public function updatenotedata(Request $request, $id)
    {
                 $attributes = [
                'notedata' => 'Check Box of List',
                'checkforpara' => 'Check Box of Paragrph',
                ];
            $validatedData = $request->validate([

          'notedata.*' => 'required_with:checkforlist|max:100',
          'paranotedata' => 'required_with:checkforpara|max:255',

          'topic' => 'required',
            ]);
           $notetype= Notes::where('id',$id)->get()->first();
           echo $notetype;
           if($notetype->typeofnote == 'list'){
$updateddata = array('topic' =>$request->topic,
'note_data' => serialize($request['notedata']), );
            Notes::whereId($id)->update($updateddata);
           }
           else {
               $updateddata = array('topic' =>$request->topic,
               'note_data' => $request->paranotedata, );
               Notes::whereId($id)->update($updateddata);
           }

            return redirect('/shownotes')->with('success', 'Your note is successfully updated.');

    }
}
