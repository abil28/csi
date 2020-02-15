@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Profile' => '#'
    ]) !!}
@endsection

@section('toolbar')
    
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
                    </div>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nim" class="form-label">NIM</label>
                            <input class="form-control" type="text" name="nim" id="nim" readonly value="{{ Auth::user()->student->nim }}">
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Nama</label>
                            <input class="form-control" type="text" name="name" id="name" readonly value="{{ Auth::user()->student->name }}">
                        </div>
                        <div class="form-group">
                            <label for="year" class="form-label">Angkatan</label>
                            <input class="form-control" type="text" name="year" id="year" readonly value="{{ Auth::user()->student->year }}">
                        </div>
                        <div class="form-group">
                            <label for="birthday" class="form-label">Tanggal Lahir</label>
                            <input class="form-control" type="date" name="birthday" id="birthday" value="{{ Auth::user()->student->birthday }}">
                        </div>
                        <div class="form-group">
                            <label for="birthplace" class="form-label">Tempat Lahir</label>
                            <input class="form-control" type="text" name="birthplace" id="birthplace" value="{{ Auth::user()->student->birthplace }}">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="2">{{ Auth::user()->student->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input class="form-control" type="text" name="phone" id="phone" value="{{ Auth::user()->student->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="photo" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="photo" id="photo" value="{{ Auth::user()->student->photo }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection
