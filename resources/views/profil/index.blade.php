@extends('layouts.dashboard.main')

@section('title', 'Profil')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Profil</li>
                    </ol>
                </nav>
            </div>
            @if (Session::has('success'))
            <div class="col-md-6">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="col-md-6">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Profil</h4>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editProfilModal">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row p-4">
                            <div class="col-md-4 font-weight-bold my-2">Nama Lengkap</div>
                            <div class="col-md-6 my-2">{{Auth::user()->nama}}</div>
                            <div class="col-md-4 font-weight-bold my-2">Email</div>
                            <div class="col-md-6 my-2">{{Auth::user()->email}}</div>
                            <div class="col-md-4 font-weight-bold my-2">Nomor HP</div>
                            <div class="col-md-6 my-2">{{Auth::user()->no_hp}}</div>
                            <div class="col-md-4 font-weight-bold my-2">Alamat</div>
                            <div class="col-md-6 my-2">{{Auth::user()->alamat}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="editProfilModal" tabindex="-1" role="dialog" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.update', Auth::user()->id)}}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label class="bmd-label-floating">Nama</label>
                        <input type="text" class="form-control" value="{{Auth::user()->nama}}" id="nama" name="nama">
                        @error('nama')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" value="{{Auth::user()->email}}" id="email" name="email">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="bmd-label-floating">Nomor HP</label>
                        <input type="number" class="form-control" value="{{Auth::user()->no_hp}}" id="no_hp" name="no_hp">
                        @error('no_hp')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="bmd-label-floating">Adress</label>
                        <input type="text" class="form-control" value="{{Auth::user()->alamat}}" id="alamat" name="alamat">
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

@endsection
