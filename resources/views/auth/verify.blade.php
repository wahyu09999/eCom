@extends('layouts.app')

@section('title', 'Email verifikasi')

@section('content')
<div class="card-container">
    <div class="card-verify text-center">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
        </div>
        @endif
        <p>Sebelum melanjutkan, <br> harap periksa email Anda untuk tautan verifikasi.</p>
        <p>Jika Anda tidak menerima email,</p>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('Kirim ulang tautan.') }}</button>.
        </form>
    </div>
</div>
@endsection
