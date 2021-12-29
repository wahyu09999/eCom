@extends('layouts.dashboard.main')

@section('title', 'Data User')

@section('css')
<link rel="stylesheet" href="{{ asset('templates/dashboard/vendor') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('templates/dashboard/vendor') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data User</li>
                    </ol>
                </nav>
            </div>
            @if (Session::has('success'))
            <div class="col">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="col">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data User</h4>
                            {{-- <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editProfilModal">
                                <i class="material-icons">
                                    add_circle_outline
                                </i>
                                Tambah Data
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-12">
                                <table id="table-users" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>No. HP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                <form id="form-delete-user" class="m-1">
                    @csrf
                    <button type="submit" class="btn btn-danger m-1">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="loading">
                <div class="modal-body">
                    <p class="text-primary">
                        Loading...
                    </p>
                </div>
            </div>
            <div id="body-modal-edit">
                <form method="POST" id="form-edit-user">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            @error('nama')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Nomor HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp">
                            @error('no_hp')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label>Adress</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                            @error('alamat')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('templates/dashboard/vendor') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('js/user.js')}}"></script>
@endsection
