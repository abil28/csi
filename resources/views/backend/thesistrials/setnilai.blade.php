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
                    <strong><i class="fa fa-info-circle"></i> Input Nilai Sidang</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <form action="{{ route('sidang.update') }}" method="post">
                        @csrf
                        @method('patch')
                        <table width="100%">
                            <tr>
                                <td width="9%">Nama </td>
                                <td width="1%">:</td>
                                <td>{{ $thesistrial->theses->student->name }}</td>
                            </tr>
                            <tr>
                                <td width="9%">NIM </td>
                                <td width="1%">:</td>
                                <td>{{ $thesistrial->theses->student->nim }}</td>
                            </tr>
                            <tr>
                                <td width="9%">Judul </td>
                                <td width="1%">:</td>
                                <td>{{ $thesistrial->theses->title }}</td>
                            </tr>
                            <tr>
                                <td width="9%">Nilai </td>
                                <td width="1%">:</td>
                                <td>
                                    <div class="row">
                                        <div class="col-1"><input type="text" name="score" id="score" pattern="[0-9]+" class="form-control" value="{{ $thesistrial->score }}"></div>
                                        <div class="col-1"></div>
                                        <div class="col-3 mt-2">
                                            Grade : <span id="grade">{{ $thesistrial->grade }}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <input type="hidden" name="grade" id="grade2" value="{{ $thesistrial->grade }}">
                        <input type="hidden" name="id" value="{{ Request::segment(3) }}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $('#score').on('keyup', function(){
            if($(this).val() <45 ){
                $("#grade").html('E');
                $("#grade2").val('E');
            }else if($(this).val() <50 ){
                $("#grade").html('D');
                $("#grade2").val('D');
            }else if($(this).val() <55 ){
                $("#grade").html('C');
                $("#grade2").val('C');
            }else if($(this).val() <60 ){
                $("#grade").html('C+');
                $("#grade2").val('C+');
            }else if($(this).val() <65 ){
                $("#grade").html('B-');
                $("#grade2").val('B-');
            }else if($(this).val() <70 ){
                $("#grade").html('B');
                $("#grade2").val('B');
            }else if($(this).val() <75 ){
                $("#grade").html('B+');
                $("#grade2").val('B+');
            }else if($(this).val() <80 ){
                $("#grade").html('A-');
                $("#grade2").val('A-');
            }else if($(this).val() <100 ){
                $("#grade").html('A');
                $("#grade2").val('A');
            }
        });
    </script>
@endsection