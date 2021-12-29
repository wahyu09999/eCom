@extends('layouts.dashboard.main')

@section('title', 'Data Produk')

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
                        <li class="breadcrumb-item active" aria-current="page">Data produk</li>
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
                            <h4 class="card-title">Data Produk</h4>
                            <a href="{{route('produk.create')}}" class="btn btn-sm btn-warning">
                                <i class="material-icons">
                                    add_circle_outline
                                </i>
                                Tambah Produk
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-12">
                                <table id="table-produk" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar</th>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Harga<sub>/pcs</sub></th>
                                            <th>Stok</th>
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
<div class="modal fade" id="deleteProdukModal" tabindex="-1" role="dialog" aria-labelledby="deleteProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProdukModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-1" data-dismiss="modal">Close</button>
                <form id="form-delete-produk" class="m-1">
                    @csrf
                    <button type="submit" class="btn btn-danger m-1">Hapus</button>
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
<script src="{{ asset('js/produk.js')}}"></script>
@endsection
