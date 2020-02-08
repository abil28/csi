<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ThesisTrial as Thesis;

class ThesisTrialController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	// dd('a');
    	// dd(Auth::user()->student->theses->thesistrial);
    	return view('backend.thesistrials.index');
    }

    public function create()
    {
    	return view('backend.thesistrials.create');
    }

    public function store(Request $request)
    {
		// dd(::all());
		// dd(Auth::user()->student->theses->id);

    	$file = $request->file('file');
    	$tujuan_upload = 'file_upload';
    	$nama_file = Auth::user()->username.".".$file->getClientOriginalExtension();
		$file->move($tujuan_upload,$nama_file);


		Thesis::create([
			'thesis_id' => Auth::user()->student->theses->id,
			'status' => 0,
			'registered_at' => now(),
			'file_report' => $nama_file,
		]);
			 return view('backend.thesistrials.index');
    	// dd($request->all());
    }
    public function delete($id)
	{
		// DB::table('thesis_trials')->where('id',$id)->delete();
		$data = Thesis::findOrFail($id);
		$data->delete();
		return view('backend.thesistrials.index');
	}
	public function show()
	{
		return view('backend.thesistrials.show');
	}
	public function update(Request $request){
		// dd($request->file('file_report'));
		$abil = Thesis::findOrFail($request->id);

		if(\Auth::user()->type == 2){
			$file = $request->file('file_report');
	    	$tujuan_upload = 'file_upload';
	    	$nama_file = Auth::user()->username.".".$file->getClientOriginalExtension();
			$file->move($tujuan_upload,$nama_file);

			$abil->update([
				'file_report' => $nama_file,
			]);

			return view('backend.thesistrials.index');
		}else{
			$abil->score = $request->score;
			$abil->grade = $request->grade;
			$abil->save();
			// $abil->update([
			// 	'score' => $request->score,
			// 	'grade' => $request->grade,
			// ]);
			// dd($abil);

			return redirect(route('sidang.index'));
		}
		
	}

	public function nilai($id)
	{
		$thesistrial = Thesis::findOrFail($id);
		return view('backend.thesistrials.setnilai', compact('thesistrial'));
	}

	public function setNilai(Request $request)
	{
		
	}
}
