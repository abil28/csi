@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('home'),
        'Sidang' => route('sidang.index')
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('sidang.create'), 'icon-plus', 'Ajukan Sidang') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        {{ html()->form('POST', route('sidang.store'))->acceptsFiles()->open() }}

                        {{-- CARD HEADER--}}
                        <div class="card-header">
                            <i class="fa fa-edit"></i> <strong>Ajukan Sidang</strong>
                        </div>

                        {{-- CARD BODY--}}
                        <div class="card-body">
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
                                    <td width="9%">File </td>
                                    <td width="1%">:</td>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                            @include('backend.thesistrials._form')           
                        </div>

                        {{--CARD FOOTER--}}
                        <div class="card-footer">
                            <input type="submit" value="Simpan" class="btn btn-primary"/>
                        </div>

                        {{ html()->form()->close() }}
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
