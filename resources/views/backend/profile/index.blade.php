@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Profile' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('profile.edit'), 'icon-pencil', 'Edit Profile') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <strong><i class="fa fa-book"></i> Profil {{ ucwords(strtolower(Auth::user()->student->name)) }}</strong>
                        </div>
                        <div class="text-right col-6">
                            <!-- <a class="btn btn-warning text-right btn-sm" href="{{ route('profile.edit') }}"><strong><i class="fa fa-edit"></i></strong> Edit</a> -->
                        </div>
                    </div>
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
                            <th>Tahun Masuk</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->year }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->department ? Auth::user()->student->department->name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->gender == 0 ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>:</td>
                            <td>{{ date_format(date_create(Auth::user()->student->birthday), 'd F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->birthplace }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->address }}</td>
                        </tr>
                        <tr>
                            <th>Status Kawin</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->marital_status == 0 ? 'Sudah Menikah' : 'Belum Menikah' }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>:</td>
                            <td>{{ Auth::user()->student->phone }}</td>
                        </tr>
                    </table>
                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
