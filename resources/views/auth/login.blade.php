@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="registration-form">
    <form action="{{route('login')}}" method="POST">
        @csrf
        <div class="form-icon">
            <span><i class="icon icon-user"></i></span>
        </div>
        <div class="form-group">
            <input type="email" class="form-control item mb-2 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            @error('email')
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
            <button type="submit" class="btn btn-block create-account">Login</button>
        </div>
    </form>
    <div class="social-media">
        <h5>Belum punya akun?
            <a href="{{route('register')}}">Register Sekarang!</a>
        </h5>
        <a href="{{route('beranda')}}">Kembali ke beranda</a>
    </div>
</div>

@endsection
