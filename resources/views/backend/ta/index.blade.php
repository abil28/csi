@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tugas Akhir' => route('admin.ta.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('user.ta.create'), 'icon-plus', 'Tambah Log Tugas Akhir') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-book"></i> Tugas Akhir</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <th width="20%">NIM</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ ucwords(strtolower(Auth::user()->student->name)) }}</td>
                        </tr>
                        <tr>
                            <th width="20%">Judul</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->thesis->title }}</td>
                        </tr>
                        <tr>
                            <th>Abstrak</th>
                            <td>:</td>
                            <td>{{ ucwords(strtolower(Auth::user()->student->thesis->abstract)) }}</td>
                        </tr>

                    <table class="table table-striped">
                        <thead>
                        <br>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Files Progress</th>
                            <th class="text-center">File Notes</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tass as $ta)
                            <tr>
                                <td>{{ $ta->id }}</td>
                                <td class="text-center">{{ $ta->thesis_id }}</td>
                                <td class="text-center">
                                    {!! cui_btn_edit(route('admin.ta.edit', [$ta->id])) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row justify-content-end">
                        <div class="col-md-6 text-right">

                        </div>
                        <div class="col-md-6 justify-content-end">
                            <div class="row justify-content-end">
                                {{ $tass->links() }}
                            </div>
                        </div>
                    </div>

                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
