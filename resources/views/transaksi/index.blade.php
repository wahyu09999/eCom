@extends('layouts.dashboard.main')

@section('title', 'Data Transaksi')

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
                        <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
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
            <div class="col mb-2 font-weight-bold">
                <a class="btn btn-danger" href="{{ route('transaksi.cetak')}}" target="_blank"><i class="fa fa-print mr-3"></i>Cetak Laporan Transaksi</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Transaksi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-12">
                                <table id="table-transaksi" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pembeli</th>
                                            <th>No. Invoice</th>
                                            <th>Jumlah Produk</th>
                                            <th>Total</th>
                                            <th>Status Pembayaran</th>
                                            <th>Status Pengiriman</th>
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
<div class="modal fade" id="deleteTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="deleteTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTransaksiModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                <form id="form-delete-transaksi" class="m-1">
                    @csrf
                    <button type="submit" class="btn btn-danger m-1">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStatusTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="editStatusTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusTransaksiModalLabel">Edit Status Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-status-transaksi"></div>
        </div>
    </div>
</div>


@endsection



@section('script')
<script src="{{ asset('templates/dashboard/vendor') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/dashboard/vendor') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('js/transaksi.js')}}"></script>
@endsection
