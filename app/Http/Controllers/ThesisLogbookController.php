<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThesisLogbook;
use App\Student;
use App\Thesis;
use App\ThesisTopic;
use DB;
use Auth;

class ThesisLogbookController extends Controller
{
    public $validation_rules = [
        'thesis_id' => 'required|title',
    ];

    public function index(){
        $id = Auth::user()->username;
        $tass = DB::table('students')
        -> join('theses', 'theses.student_id', '=', 'students.id')
        -> select('theses.title', 'students.nim', 'students.name');
        return view('backend.ta.index', compact('tass', 'id'));
    }

    public function create()
    {
        $id = Auth::user()->username;
        $bta = DB::table('students')
        -> join('theses', 'students.id', '=', 'theses.student_id')
        -> join('thesis_topics', 'theses.thesis_id', '=', 'thesis_topics.id')
        -> select('students.name', 'students.nim', 'thesis_topics.name as topic')
        -> where('students.nim', '=', '$id')
        ->first();
        return view('backend.ta.create', compact('bta', 'id'));
    }

    public function show($id)
    {
        $bta = DB::table('students')
        -> join('theses', 'students.id', '=', 'theses.student_id')
        -> join('thesis_topics', 'theses.thesis_id', '=', 'thesis_topics.id')
        -> where('students.id', '=', '$id')
        ->select('students.nim', 'students.nim', 'thesis_topics.name as topic')
        ->get();

        return view('backend.ta.create', compact('bta', 'id'));
    }

    public function store(Request $request){
        $request->validate([
            'thesis_id' => 'required'
       ]);

        $ta= new ThesisLogbook();
        $ta->thesis_id = $request->input('dosen_id');
        $ta->thesis_logbook_id = $request->input('thesis_logbook_id');
        $ta->supervisor_id = $request->input('supervisor_id');
        $ta->progress = $request->input('progress');

        $ta->save();
        session()->flash('flash_success', 'Berhasil menambahkan Progress!');

        return view('backend.ta.index');
    }

    public function update(){
        $id = Auth::user()->username;
        $updatee = DB::table('students')
                -> join('theses', 'students.id', '=', 'theses.student_id')
                -> join('thesis_topics', 'theses.thesis_id', '=', 'thesis_topics.id')
                -> where('students.nim', '=', '$id')
                -> get();
        return view('backend.ta.create', compact('updatee'));
    }

    public function logbookIndex()
    {
        if(Auth::user()->type == 2){
            return view('backend.logbook.index');
        }else if(Auth::user()->type == 3){
            return view('backend.logbook.dosen');
        }
    }

    public function logbookCreate(Request $request)
    {
        $name = null;
        
        if($request->file('file_progress')){
            $file = $request->file('file_progress');
            $name = microtime(). '-' .$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);
        }

        ThesisLogbook::create([
            'thesis_id'     => \Auth::user()->student->thesis->id,
            'date'          => date('Y-m-d'),
            'progress'      => $request->progress,
            'status'        => 1,
            'supervisor_id' => $request->supervisor_id,
            'files_progress' => $name ? $name : null
        ]);
        
        return redirect(route('logbook.index'));
    }

    public function logbookUpdate(Request $request)
    {
        $name = null;

        if(Auth::user()->type == 3){
            if($request->file('file_notes')){
                $file = $request->file('file_notes');
                $name = microtime(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path().'/file/', $name);
            }
            // dd($request->file('file_notes'));
            $logbook = ThesisLogbook::findOrFail($request->id_edit);
            $logbook->update([
                'status' => $request->status,
                'notes' => $request->notes,
                'supervised_at' => date('Y-m-d H:i:s'),
                'file_notes' => $name ? $name : $logbook->file_notes
            ]);
        }else{
            if($request->file('file_progress_edit')){
                $file = $request->file('file_progress_edit');
                $name = microtime(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path().'/file/', $name);
            }
    
            $logbook = ThesisLogbook::findOrFail($request->id_edit);
            $logbook->update([
                'supervisor_id' => $request->supervisor_id_edit,
                'progress' => $request->progress_edit,
                'files_progress' => $name ? $name : $logbook->files_progress
            ]);
        }

        return redirect(route('logbook.index'));
    }
}
