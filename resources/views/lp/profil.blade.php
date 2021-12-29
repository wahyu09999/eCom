@extends('layouts.lp.main')

@section('title', 'Profil')

@section('content')
<!-- Breadcrumb Area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Data Profil</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{route('beranda')}}">Home</a></li>
                        <li>Profil</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<!-- About Area Start -->
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col text-right">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#editUserModal"><i class="fas fa-fw fa-edit"></i>Edit Profil</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-4 font-weight-bold">{{$user->nama}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Email</div>
                            <div class="col-md-4 font-weight-bold">{{$user->email}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Nomor HP</div>
                            <div class="col-md-4 font-weight-bold">{{$user->no_hp}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Alamat</div>
                            <div class="col-md-4 font-weight-bold">{{$user->alamat}}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('beranda.updateprofil', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nama</label>
                                <input type="text" class="px-2 @error('nama') border-danger @enderror" name="nama" placeholder="Masukkan Nama" value="{{ $user->nama}}" />
                                @error('nama')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Email</label>
                                <input type="email" class="px-2 @error('email') border-danger @enderror" name="email" placeholder="Masukkan email" value="{{ $user->email}}" />
                                @error('email')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Alamat</label>
                                <input type="text" class="px-2 @error('alamat') border-danger @enderror" name="alamat" placeholder="Masukkan alamat" value="{{ $user->alamat}}" />
                                @error('alamat')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nomor HP</label>
                                <input type="number" class="px-2 @error('no_hp') border-danger @enderror" name="no_hp" placeholder="Masukkan no_hp" value="{{ $user->no_hp}}" />
                                @error('no_hp')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
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
