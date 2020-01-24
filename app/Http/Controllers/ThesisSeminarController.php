<?php

namespace App\Http\Controllers;
use App\ThesisSeminar;
use App\ThesisSemAudience;
use Auth;
use DB;
use Illuminate\Http\Request;

class ThesisSeminarController extends Controller
{
    public function index()
    {
        $thesisseminars = DB::table('thesis_seminars')
                          ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                          ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                          ->select('thesis_seminars.id', 'thesis_seminars.registered_at', 'thesis_seminars.seminar_at', 'thesis_seminars.status', DB::raw('(CASE WHEN thesis_seminars.status = 10 THEN '. "'Submitted'".' 
                            WHEN thesis_seminars.status = 20 THEN '."'Scheduled'".' WHEN thesis_seminars.status = 30 THEN '."'Finished'".' WHEN thesis_seminars.status = 40 THEN '."'Failed'".' END) AS status_semhas'))
                          ->paginate(5);

        return view('backend.thesis_seminar.index', compact('thesisseminars'));
    }
    
    public function create()
    {
        $nim = Auth::user()->username;
        $statuss = DB::table('thesis_proposals') 
                ->join('theses', 'thesis_proposals.thesis_id', '=', 'theses.id')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('thesis_proposals.status')->where('students.nim', '=', $nim)
                ->get();

        $count = DB::table('thesis_sem_audiences')
                ->join('students','thesis_sem_audiences.student_id','=','students.id')
                ->select('student_id')->where('students.nim', '=', $nim)
                ->count();

        //var_dump($count);
    
        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 30 && $count >= 7)
                {
                    $student = DB::table('theses')
                            ->join('students', 'theses.student_id', '=', 'students.id')
                            ->select('theses.id')->where('students.nim', '=', $nim)
                            ->get();
      
                    return view('backend.thesis_seminar.create', compact('student'));
                }
                elseif($st != 30)
                {
                    session()->flash('flash_success', 'Gagal membuat pengajuan. Anda belum melaksanakan seminar proposal.');
                    return redirect()->route('admin.semhas.index');
                }
                elseif($count < 7)
                {
                    session()->flash('flash_success', 'Gagal membuat pengajuan. Anda belum melaksanakan seminar proposal.');
                    return redirect()->route('admin.semhas.index');
                }
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'thesis_id'=>'required',
            'status' => 'required',
            'file_report' =>'file|mimes:pdf, required'
        ]);
    	    $semhas = new ThesisSeminar;
            $semhas->thesis_id = $request->thesis_id;
            $semhas->status = $request->status;
      
            if($request->hasFile('file_report') && $request->file('file_report')->isValid())
            {
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_report')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_report->storeAs('public/laporan_ta',$filenameext);
                $semhas->file_report = $filepath;
            }
            $semhas->save();
            return redirect()->route('admin.semhas.show', [$semhas->id]);
            // if($semhas->save()) {
            //     session()->flash('flash_success', 'Berhasil menambahkan pengajuan semhas baru');
                
            //     return redirect()->route('admin.semhas.show', [$semhas->id]);
            // }
            // return redirect()->back()->withErrors();
    }

    public function show($id)
    {
        $thesisseminars = DB::table('thesis_seminars')
                ->join('theses', 'thesis_seminars.thesis_id', '=', 'theses.thesis_id')
                ->join('thesis_proposals', 'theses.thesis_id', '=', 'thesis_proposals.thesis_id')
                ->join('students', 'theses.student_id', '=', 'students.id')
                ->select('thesis_proposals.id','students.name AS student_name','thesis_seminars.registered_at AS registered_time','thesis_seminars.seminar_at AS seminar_time','thesis_seminars.status','thesis_seminars.recommendation','thesis_seminars.file_report AS file_reports', 
                  DB::raw('(CASE WHEN thesis_seminars.status = 10 THEN '. "'Submitted'".' 
                  WHEN thesis_seminars.status = 20 THEN '."'Scheduled'".' WHEN thesis_seminars.status = 30 THEN '."'Finished'".' WHEN thesis_seminars.status = 40 THEN '."'Failed'".' END) AS status_semhas'))
                ->where('thesis_seminars.id','=',$id)
                ->get();

        $reviewer = DB::table('thesis_seminars')
                    ->join('thesis_sem_reviewers', 'thesis_seminars.id', '=', 'thesis_sem_reviewers.thesis_seminar_id')
                    ->join('lecturers', 'thesis_sem_reviewers.reviewer_id', '=', 'lecturers.id')
                    ->select('lecturers.name AS reviewer_name')
                    ->where('thesis_seminars.id','=',$id)
                    ->get();
      
        $thesisseminars = $thesisseminars[0];
  
        return view('backend.thesis_seminar.show', compact('thesisseminars', 'reviewer'));
    }

    public function destroy($id)
    {
        $statuss = DB::table('thesis_seminars') 
                  ->select('thesis_seminars.status')
                  ->where('thesis_seminars.id','=', $id)
                  ->get();
        //echo $status;
        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 10)
                {
                    $a = DB::table('thesis_sem_audiences')->where('thesis_seminar_id','=',$id);
                    $a->delete();
                    $b = DB::table('thesis_sem_reviewers')->where('thesis_seminar_id','=',$id);
                    $b->delete();
                    $thesisseminars = DB::table('thesis_seminars')->where('thesis_seminars.id','=',$id);
                    $thesisseminars->delete();
                    session()->flash('flash_success', 'Berhasil membatalkan pengajuan semhas');
                    return redirect()->route('admin.semhas.index');
            }
                elseif($st != 10)
                {
                    session()->flash('flash_success', 'Gagal membatalkan pengajuan. Pengajuan telah disetujui.');
                    return redirect()->route('admin.semhas.index');
                }
            }
        }
    }

    public function edit($id)
    {
        //Cek status persetujuan admin 
        $statuss = DB::table('thesis_seminars') 
                  ->select('thesis_seminars.status')
                  ->where('thesis_seminars.id','=', $id)
                  ->get();
        //echo $status;
        foreach($statuss as $status)
        {
            foreach($status as $st)
            {
                if($st == 10)
                {
                    $semhas = ThesisSeminar::findOrFail($id);
                    $nim = Auth::user()->username;
                    $student = DB::table('theses')
                            ->join('thesis_seminars', 'thesis_seminars.thesis_id', '=', 'theses.id')
                            //->join('thesis_proposals', 'theses.id', '=', 'thesis_proposals.thesis_id')
                            //->join('students', 'theses.student_id', '=', 'students.id')
                            ->select('theses.id')->where('thesis_seminars.id', '=', $id)
                            ->get();
        
                    return view ('backend.thesis_seminar.edit', compact('semhas', 'student', 'id'));
                }
                elseif($st != 10)
                {
                    session()->flash('flash_success', 'Gagal mengubah data pengajuan. Pengajuan telah disetujui.');
                    return redirect()->route('admin.semhas.index');
                }
            }
        }
        
    }

    public function update (Request $request, $id) {
        $semhas = ThesisSeminar::findOrFail($id);
            
        $request->validate([
            'thesis_id'=>'required',
            'file_report' =>'file|mimes:pdf, required'
        ]);

        $semhas->thesis_id = $request->thesis_id;
      
            if($request->hasFile('file_report') && $request->file('file_report')->isValid())
            {
                if (\Storage::exists($semhas->file_report)) 
                {
                         \Storage::delete($semhas->file_report);
                }
                $filename = uniqid('laporan-');
                $fileext = $request->file('file_report')->extension();
                $filenameext = $filename.'.'.$fileext;
                $filepath = $request->file_report->storeAs('public/laporan_ta',$filenameext);
                $semhas->file_report = $filepath;
            }
            $semhas->save();
            return redirect()->route('admin.semhas.show', [$semhas->id]);
            // if ($thesisseminars->save()) {
            //     session()->flash('flash_success','Berhasil memperbaharui data semhas');
            //     return redirect()->route('admin.semhas.show', [$semhas->id]);
            //     }
            // return redirect()->route('admin.semhas.show');
        }
}
