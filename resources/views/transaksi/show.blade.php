@extends('layouts.dashboard.main')

@section('title', 'Detail Transaksi')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Transaksi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-md-6 mb-2">No. Invoice</div>
                            <div class="col-md-6 mb-2 font-weight-bold">{{$data->cart->no_invoice}}</div>
                            <div class="col-md-6 mb-2">Jumlah Produk</div>
                            <div class="col-md-6 mb-2 font-weight-bold">{{$data->cart->detail->count()}} produk</div>
                            <div class="col-md-6 mb-2">Total</div>
                            <div class="col-md-6 mb-2 font-weight-bold">Rp {{number_format($data->cart->total, 0,',', '.')}}</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Status Transaksi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            @if ($data->bukti_transfer)
                            <div class="col-12 mb-3">
                                Bukti Pembayaran <br>
                                <img src="{{asset('storage/bukti_transfer/'.$data->bukti_transfer)}}" class="img-thumbnail my-2 w-50" alt="">
                            </div>
                            @endif
                            <div class="col-md-6 mb-2">Status Pembayaran</div>
                            <div class="col-md-6 mb-2 font-weight-bold text-uppercase">{{$data->cart->status_pembayaran}}</div>
                            <div class="col-md-6 mb-2">Status Pengiriman</div>
                            <div class="col-md-6 mb-2 font-weight-bold text-uppercase">{{$data->cart->status_pengiriman}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Produk</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-repsonsive">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <th>#</th>
                                        <th>Gambar Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->cart->detail as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                <img src="{{asset('storage/produk/'. $item->produk->gambar)}}" class="img-thumbnail" width="100" alt="">
                                            </td>
                                            <td>
                                                <span class="badge badge-info py-2 px-3">{{$item->produk->kategori->nama}}</span> <br>
                                                {{$item->produk->nama}}
                                            </td>
                                            <td>{{$item->qty}}</td>
                                            <td>Rp {{number_format($item->subtotal, 0, ',', '.')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
