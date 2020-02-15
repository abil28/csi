@extends('backend.layouts.app')

@section('breadcrumb')
    {!! cui_breadcrumb([
        'Home' => route('home'),
        'Logbook' => route('logbook.index'),
        'Index' => '#'
    ]) !!}
@endsection

@section('toolbar')
        {!! buttonModal('modalTambah', 'icon-plus', 'Tambah Logbook TA') !!}
@endsection

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('logbook.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Logbook TA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supervisor_id" class="form-label">Pembimbing</label>
                        <select name="supervisor_id" id="supervisor_id" class="form-control">
                            @foreach(Auth::user()->student->thesis->thesisSupervisor as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->lecturer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress" class="form-label">Progress</label>
                        <textarea required name="progress" id="progress" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_progress" class="form-label">File Progress</label>
                        <input type="file" name="file_progress" id="file_progress" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('logbook.update') }}" method="post" id="formEdit">
                @csrf
                @method('patch')
                <input type="hidden" name="id_edit" id="id_edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Logbook TA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supervisor_id_edit" class="form-label">Pembimbing</label>
                        <select name="supervisor_id_edit" id="supervisor_id_edit" class="form-control">
                            @foreach(Auth::user()->student->thesis->thesisSupervisor as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->lecturer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="progress_edit" class="form-label">Progress</label>
                        <textarea required name="progress_edit" id="progress_edit" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_progress_edit" class="form-label">File Progress</label>
                        <input type="file" name="file_progress_edit" id="file_progress_edit" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Info -->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalInfoText">
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">

                {{-- CARD HEADER--}}
                <div class="card-header">
                    <strong><i class="fa fa-book"></i> Logbook Tugas Akhir</strong>
                </div>

                {{-- CARD BODY--}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 ml-3">
                            <table width="100%" class="table table-striped" id="tabelLogbook">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Progress</th>
                                        <th>Supervisor</th>
                                        <th>Supervised at</th>
                                        <th class="text-center">Note</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->student->thesis->thesisLogbook as $logbook)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $logbook->date }}</td>
                                            <td class="text-center">
                                                <button class="popup btn btn-info" data-toggle="modal" data-target="#modalInfo" data-label="Progress Logbook TA">
                                                    <i class="fa fa-info"></i>
                                                    <span class="popuptext">
                                                        {{ $logbook->progress }}
                                                    </span>
                                                </button>
                                            </td>
                                            <td>{{ $logbook->supervisor->lecturer->name }}</td>
                                            <td>{{ $logbook->supervised_at }}</td>
                                            <td class="text-center">
                                                @if($logbook->notes)
                                                <button class="popup btn btn-info" data-toggle="modal" data-target="#modalInfo" data-label="Note Logbook TA">
                                                    <i class="fa fa-info"></i>
                                                    <span class="popuptext">
                                                        {{ $logbook->notes }}
                                                    </span>
                                                </button>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                @if($logbook->status == 1)
                                                    <span class="badge badge-primary">Submitted</span>
                                                @elseif($logbook->status == 2)
                                                    <span class="badge badge-success">Accepted</span>
                                                @elseif($logbook->status == 3)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($logbook->files_progress)
                                                <a href="{{ url('/file/'.$logbook->files_progress) }}" download class="btn btn-success btn-sm"><i class="fa fa-file"></i> Progress</a>
                                                @endif
                                                @if($logbook->file_notes)
                                                <a href="{{ url('/file/'.$logbook->file_notes) }}" download class="btn btn-success btn-sm"><i class="fa fa-file"></i> Note</a>
                                                @endif
                                                @if($loop->last)
                                                <button class="btn btn-info editLogbook btn-sm" data-toggle="modal" data-target="#modalEdit" data-id="{{ $logbook->id }}" data-progress="{{ $logbook->progress }}" data-supervisor="{{ $logbook->supervisor_id }}" id="editLogbook-{{ $logbook->id }}"><i class="fa fa-edit"></i> Edit</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--card-body-->


            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

@endsection

@section('javascript')
    <script>
        $(document).ready(function(){
            $("#tabelLogbook").DataTable();

            // When the user clicks on div, open the popup
            $(".popup").click(function(){
                var popup = $(this).children("span")[0];
                var label = $(this).data('label');
                
                $("#modalInfoLabel").html(label);
                $("#modalInfoText").html(popup);
                // popup.classList.toggle("show");
            });
        });

        $(".editLogbook").click(function(){
            $("#id_edit").val($(this).data("id"));
            $("#progress_edit").html($(this).data("progress"));
            $("#supervisor_id_edit").val($(this).data("supervisor"));
        });
    </script>
@endsection