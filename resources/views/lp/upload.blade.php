@extends('layouts.lp.main')

@section('title', 'Upload bukti pembayaran')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Upload Bukti Pembayaran</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{route('beranda')}}">Beranda</a></li>
                        <li>Upload bukti pembayaran</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->
<!-- Shop details Area start -->
<section class="product-details-area mb-5">
    <div class="container">
        <div class="row">
            @if (Session::has('error'))
            <div class="col-12">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif

            <div class="col-md-6 mb-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">No. Invoice</div>
                            <div class="col-md-8 font-weight-bold">{{$data->cart->no_invoice}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">Jumlah Produk</div>
                            <div class="col-md-8 font-weight-bold">{{$data->cart->detail->count()}} Produk</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4">TOTAL</div>
                            <div class="col-md-8 font-weight-bold">Rp {{ number_format($data->cart->total, 0, ',', '.')}}</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Form Upload Bukti Pembayaran
                    </div>
                    <div class="card-body">
                        <form action="{{route('uploadBukti') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <div class="form-group">
                                <label for="bukti_transfer">Upload File</label>
                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror" name="bukti_transfer" id="bukti_transfer">
                                @error('bukti_transfer')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop details Area End -->

@endsection
