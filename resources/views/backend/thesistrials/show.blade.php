@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('home'),
        'Sidang' => route('sidang.index')
    ]) !!}
@endsection

@section('toolbar')
    {{-- {!! cui_toolbar_btn(route('admin.students.create'), 'icon-plus', 'Tambah Mahasiswa') !!} --}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-info-circle"></i> Informasi Sidang</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    @if(Auth::user()->student->theses->thesisTrial == null)
                     Anda belum mengajukan sidang.  
                    <div class="row justify-content-end">
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                    <a class="btn btn-primary mr-4" href="{{ route('sidang.create') }}"><i class="fa fa-file"></i> Ajukan</a>
                            </div>
                        </div>
                    </div>
                                     
                    @endif

                    @if(Auth::user()->student->theses->thesisTrial != null)
                     <style type="text/css">
                                .jarak, tr, td{
                                    padding-bottom: 14px;
                                }
                            </style>
                    <table width="100%" class="jarak">
                        <tr>
                            <td width="14%"><b>Nama</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->name }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>NIM</b></td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->nim }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Judul</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->title }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Status</b> </td>
                            <td width="2%">:</td>
                            <td>
                                @if(Auth::user()->student->theses->thesisTrial->status == 0)
                                    Submit
                                @elseif(Auth::user()->student->theses->thesisTrial->status == 1)
                                    Dijadwal
                                @elseif(Auth::user()->student->theses->thesisTrial->status == 2)
                                    Selesai
                                @elseif(Auth::user()->student->theses->thesisTrial->status == 3)
                                    Gagal
                                @endif
                            </td>

                        </tr>
                             <td width="14%"><b>Tanggal Pengajuan</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->registered_at }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Tanggal sidang </b></td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->trial_at }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Mulai</b></td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->start_at }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Selesai</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->start_at }}</td>
                                 </tr>
                        <tr>
                            <td width="14%"><b>Ruangan</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->room_id }}</td>
                        </tr>
                        <tr>
                            <td width="14%"><b>Nilai</b> </td>
                            <td width="2%">:</td>
                             <td>{{ Auth::user()->student->theses->thesisTrial->score }}</td>
                        <tr>
                            <td width="14%"><b>Grade</b> </td>
                            <td width="2%">:</td>
                            <td>{{ Auth::user()->student->theses->thesisTrial->grade }}</td>
                        </tr>
                    </table>
                    @endif
@endsection