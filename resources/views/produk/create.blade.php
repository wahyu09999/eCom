@extends('layouts.dashboard.main')

@section('title', 'Tambah Produk')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                    </ol>
                </nav>
            </div>
            @if (Session::has('success'))
            <div class="col-md-8">
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="col-md-8">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Produk</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-4">
                            <div class="col-12">
                                <form action="{{route('produk.store')}}" method="POST" enctype="multipart/form-data" id="form-create-produk">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>Kategori</label>
                                        <select class="form-control" id="kategori_id" name="kategori_id">
                                            <option selected hidden disabled>-- Pilih Kategori Produk --</option>
                                            @foreach ($kategori as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Nama Produk</label>
                                        <input type="text" class="form-control" id="nama" name="nama">
                                        @error('nama')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Harga Produk</label>
                                        <input type="number" min="0" class="form-control" id="harga" name="harga">
                                        @error('harga')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Stok Produk</label>
                                        <input type="number" min="0" class="form-control" id="stok" name="stok">
                                        @error('stok')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
                                        @error('deskripsi')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    {{-- <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div> --}}

                                    <div class="form-group mb-3">
                                        <label>Gambar Produk</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                            <label class="custom-file-label" for="gambar">Choose file</label>
                                        </div>
                                        @error('gambar')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    $(document).ready(function() {
        $('#gambar').on("change", function(e) {
            e.preventDefault()
            if (this.files && this.files[0]) {
                var name = this.files[0]["name"]
                console.log(this.files[0])
                $("#form-create-produk label[for='gambar']").text(name)
            }
        })

    });

</script>
@endsection
