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
                    @if(Auth::user()->type==2)
                        @if(Auth::user()->student->theses != null)
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
                            <table width="100%">
                                <tr>
                                    <td width="9%">Nama </td>
                                    <td width="1%">:</td>
                                    <td>{{ Auth::user()->student->name }}</td>
                                </tr>
                                <tr>
                                    <td width="9%">NIM </td>
                                    <td width="1%">:</td>
                                    <td>{{ Auth::user()->student->nim }}</td>
                                </tr>
                                <tr>
                                    <td width="9%">Judul </td>
                                    <td width="1%">:</td>
                                    <td>{{ Auth::user()->student->theses->title }}</td>
                                </tr>
                                <tr>
                                    <td width="9%">Status </td>
                                    <td width="1%">:</td>
                                    <td>
                                        @if(Auth::user()->student->theses->thesisTrial->status == 0)
                                            Sedang Diajukan
                                        @elseif(Auth::user()->student->theses->thesisTrial->status == 1)
                                            Dijadwal
                                        @elseif(Auth::user()->student->theses->thesisTrial->status == 2)
                                            Selesai
                                        @elseif(Auth::user()->student->theses->thesisTrial->status == 3)
                                            Gagal
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            <div class="text-right">
                                <a class="btn btn-success" href="{{ route('sidang.detail' ) }}"><i class="fa fa-eye"></i> Detail</a>
                                @if(Auth::user()->student->theses->thesisTrial->status == 0)
                                <form action="{{ route('sidang.update') }}" method="post" class="form-inline btn" id="form_file" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{ Auth::user()->student->theses->thesisTrial->id }}">
                                    <input type="file" name="file_report" id="file_report">
                                </form>
                                <button class="btn btn-warning mr-2" id="editfile"><i class="fa fa-edit"></i> Edit</button>
                                <form method="post" action="{{ route('sidang.delete', Auth::user()->student->theses->thesisTrial->id) }}" class="form-inline btn">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('Yakin Mau Hapus Nih?')"><i class="fa fa-trash"></i> Cancel</button>
                                </form>
                                @endif
                            </div>
                            @endif

                            <div class="row justify-content-end">
                                <div class="col-md-6 text-right">

                                </div>
                                <div class="col-md-6 justify-content-end">
                                    <div class="row justify-content-end">
                                        
                                    </div>
                                </div>
                            </div>
                        @else
                            Anda Belum Mengajukan TA
                        @endif
                    @else
                        @if(Auth::user()->type==3)
                         <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">Judul</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Tanggal Sidang</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->lecturer->thesisTrial as $thesisTrial)
                                    @if($thesisTrial->status == 2)
                                        <tr class="text-center">
                                            <td class="text-left">{{ $thesisTrial->theses->student->name }}</td>
                                            <td>{{ $thesisTrial->theses->student->nim }}</td>
                                            <td>{{ $thesisTrial->theses->title }}</td>
                                            <td>{{ $thesisTrial->score }}</td>
                                            <td>{{ $thesisTrial->trial_at }}</td>
                                            <td><a class="btn btn-success" href="{{ route('sidang.nilai', ['id' => $thesisTrial->id]) }}">Nilai</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    @endif

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
