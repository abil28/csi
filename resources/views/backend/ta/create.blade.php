@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('admin.home'),
        'Tugas Akhir' => route('admin.ta.index'),
        'Edit' => '#'
    ]) !!}
@endsection

@section('toolbar')
    {!! cui_toolbar_btn(route('admin.ta.index'), 'icon-list', 'Tugas Akhir') !!}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        {{ html()->form('POST', route('admin.ta.store'))->acceptsFiles()->open() }}

                        {{-- CARD BODY--}}



                        @foreach($bta as $ta)
                            <tr>
                                <td>{{ $ta->name }}</td>
                                <td>{{ $ta->nim }}</td>
                                <td>{{ $ta->topic }}</td>
                            </tr>
                        @endforeach

                        <div class="card-body">
                            @include('backend.ta._form')
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
