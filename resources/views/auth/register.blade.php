@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
<div class="registration-form">
    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item mb-2 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama Lengkap">
            @error('nama')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control item mb-2 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="number" class="form-control item mb-2 @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" placeholder="Nomor HP">
            @error('no_hp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control item mb-2 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" placeholder="Alamat">
            @error('alamat')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control item mb-2 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Password">
            @error('password')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control item mb-2" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block create-account">Registrasi</button>
        </div>
    </form>
    <div class="social-media">
        <h5>Sudah punya akun?
            <a href="{{route('login')}}">Login Sekarang!</a>
        </h5>
        <a href="{{route('beranda')}}">Kembali ke beranda</a>
    </div>
</div>
</div>

@endsection
