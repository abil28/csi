@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tugas Akhir' => route('admin.ta.index'),
        'Detail' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn_delete(route('admin.students.destroy', [$student->id]), $student->id, 'icon-trash', 'Hapus Mahasiswa', 'Anda yakin akan menghapus mahasiswa ini?') !!}
    {!! cui_toolbar_btn(route('admin.students.edit', $student->id), 'icon-pencil', 'Edit Mahasiswa') !!}
    {!! cui_toolbar_btn(route('admin.students.index'), 'icon-list', 'List Mahasiswa') !!}
    {!! cui_toolbar_btn(route('admin.students.create'), 'icon-plus', 'Tambah Mahasiswa') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        {{ html()->modelForm($student) }}

                        {{-- CARD HEADER--}}
                        <div class="card-header">
                            <i class="fa fa-edit"></i> <strong>Detail Mahasiswa</strong>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
                            @include('backend.students._detail')
                        </div>

                        {{--CARD FOOTER--}}
                        <div class="card-footer">
                        </div>

                        {{ html()->closeModelForm() }}

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        {{-- CARD HEADER--}}
                        <div class="card-header">
                            <i class="fa fa-edit"></i> <strong>Foto Mahasiswa</strong>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset($student->getPhotoPath()) }}" class="img-fluid rounded" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
