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
                    </table>
                    <div class="text-right">
                        <a class="btn btn-success mr-2" href="{{ route('sidang.detail' ) }}"><i class="fa fa-eye"></i> Detail</a>
                        <a class="btn btn-warning" href="{{ route('sidang.create') }}"><i class="fa fa-edit"></i> Edit</a>
                        <form method="post" action="{{ route('sidang.delete', Auth::user()->student->theses->thesisTrial->id) }}" class="form-inline btn">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('Yakin nih?')"><i class="fa fa-trash"></i> Delete</button>
                        </form>
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

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
