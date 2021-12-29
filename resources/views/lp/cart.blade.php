@extends('layouts.lp.main')

@section('title', 'Keranjang Belanja')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Keranjang Belanja</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{route('beranda')}}">Beranda</a></li>
                        <li>Keranjang Belanja</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="cart-main-area ">
    <div class="container">
        <h3 class="cart-page-title">Keranjang belanja Anda saat ini</h3>
        <div class="row">
            @if (Session::has('error'))
            <div class="col-12">
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            </div>
            @endif
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">
                        <table class="w-100">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$itemcart)
                                <tr>
                                    <td colspan="7">Keranjang masih kosong</td>
                                </tr>
                                @else
                                @if (!$itemcart->detail)
                                <tr>
                                    <td colspan="7">Keranjang masih kosong</td>
                                </tr>
                                @else
                                @foreach ($itemcart->detail as $item)
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="{{route('beranda.detailproduk', $item->produk->id)}}"><img src="{{asset('storage/produk/' . $item->produk->gambar)}}" class="w-50" alt="" /></a>
                                    </td>
                                    <td class="product-name text-left">
                                        <span class="badge badge-info">
                                            {{$item->produk->kategori->nama}}
                                        </span>
                                        <br>
                                        <a href="{{route('beranda.detailproduk', $item->produk->id)}}">{{$item->produk->nama}}</a>
                                    </td>

                                    <td class="product-price-cart"><span class="amount">{{number_format($item->produk->harga, 0, ',', '.')}}</span></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-dark btn-sm mx-1" onclick="decQty({{$item->id}})">-</button>
                                            <button class="btn btn-outline-dark btn-sm btn-rounded" disabled="true">
                                                {{$item->qty}}
                                            </button>
                                            <button type="button" class="btn btn-dark btn-sm mx-1" onclick="incQty({{$item->id}})">+</button>
                                        </div>

                                    </td>
                                    <td class="product-subtotal">{{number_format($item->subtotal, 0, ',', '.')}}</td>
                                    <td>
                                        @if (isset($item->alamat))
                                        {{$item->alamat->nama_penerima}}, {{$item->alamat->alamat}}
                                        <br>
                                        {{$item->alamat->kelurahan}} - {{$item->alamat->kecamatan}} - {{$item->alamat->kota}} - {{$item->alamat->provinsi}}
                                        <br>
                                        <span>
                                            Kodepos :
                                            {{$item->alamat->kodepos}}
                                        </span>

                                        @else
                                        Pilih alamat pengiriman
                                        @endif
                                    </td>
                                    <td class="product-remove">
                                        <a href="javascript:void(0)" class="text-dark btn-edit-alamat-produk" data-url="{{route('editalamatproduk', $item->id)}}" data-toggle="modal" data-target="#editAlamatProdukModal"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" data-id="{{$item->id}}" class="delete-produk-cart"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-6">
                            <a href="{{route('beranda.listproduk')}}" class="btn btn-primary">Lanjut Belanja</a>
                        </div>
                        @if ($itemcart)
                        <div class="col-6 text-right">
                            <a href="javascript:void(0)" class="btn btn-danger" id="kosong-keranjang" data-id="{{$itemcart->id}}">Kosongkan Keranjang</a>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-md-8 mb-4">
                <div class="cart-tax">
                    <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#tambahAlamatPengirimanModal">
                        Tambah Alamat Pengiriman
                    </button>
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gray">Data Alamat Pengiriman</h4>
                    </div>
                    <div class="tax-wrapper">
                        <div class="table-content table-responsive cart-table-content">
                            <table class="w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($alamatpengiriman->isEmpty())
                                    <tr>
                                        <td colspan="4">Data alamat pengiriman masih kosong</td>
                                    </tr>
                                    @else
                                    @foreach ($alamatpengiriman as $item)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">
                                                {{$item->nama_penerima}}
                                            </span>
                                            <br>
                                            <span>No. HP :
                                                {{$item->no_tlp}}
                                            </span>
                                        </td>
                                        <td>
                                            {{$item->alamat}},
                                            <br>
                                            {{$item->kelurahan}} - {{$item->kecamatan}} - {{$item->kota}} - {{$item->provinsi}}
                                            <br>
                                            <span>
                                                Kodepos :
                                                {{$item->kodepos}}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($item->status)
                                            <span class="badge badge-success px-3 py-2">Utama</span>
                                            @else
                                            <span class="badge badge-danger px-3 py-2">Opsional</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="text-dark btn-edit-alamat" data-url="{{route('alamat-pengiriman.edit', $item->id)}}" data-toggle="modal" data-target="#editAlamatPengirimanModal"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" data-id="{{$item->id}}" class="text-dark mx-2 delete-alamat-pengiriman"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="grand-totall">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title section-bg-gary-cart">Ringkasan Belanja</h4>
                    </div>
                    <h5>No. Invoice <span>{{ isset($itemcart->no_invoice) ? $itemcart->no_invoice : '0' }}</span></h5>
                    <h4 class="grand-totall-title text-success">TOTAL <span>Rp {{ isset($itemcart->total) ? number_format($itemcart->total, 0,',', '.') : '0'}}</span></h4>
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf()
                        <button type="submit" class="btn btn-success btn-block">CHECKOUT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart area end -->

<!-- Modal -->
<div class="modal fade" id="tambahAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="tambahAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAlamatPengirimanModalLabel">Tambah Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('alamat-pengiriman.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nama Penerima</label>
                                <input type="text" class="px-2 @error('nama_penerima') border-danger @enderror" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{old('nama_penerima')}}" />
                                @error('nama_penerima')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Nomor HP</label>
                                <input type="text" class="px-2 @error('no_tlp') border-danger @enderror" name="no_tlp" placeholder="Masukkan Nomor HP" value="{{old('no_tlp')}}" />
                                @error('no_tlp')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Alamat</label>
                                <input type="text" class="px-2 @error('alamat') border-danger @enderror" name="alamat" placeholder="Masukkan Alamat" value="{{old('alamat')}}" />
                                @error('alamat')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kelurahan/Desa</label>
                                <input type="text" class="px-2 @error('kelurahan') border-danger @enderror" name="kelurahan" placeholder="Masukkan Kelurahan/Desa" value="{{old('kelurahan')}}" />
                                @error('kelurahan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kecamatan</label>
                                <input type="text" class="px-2 @error('kecamatan') border-danger @enderror" name="kecamatan" placeholder="Masukkan Kecamatan" value="{{old('kecamatan')}}" />
                                @error('kecamatan')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kabupaten/Kota</label>
                                <input type="text" class="px-2 @error('kota') border-danger @enderror" name="kota" placeholder="Masukkan Kabuptae/Kota" value="{{old('kota')}}" />
                                @error('kota')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Provinsi</label>
                                <input type="text" class="px-2 @error('provinsi') border-danger @enderror" name="provinsi" placeholder="Masukkan Provinsi" value="{{old('provinsi')}}" />
                                @error('provinsi')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tax-select mb-25px">
                                <label>Kodepos</label>
                                <input type="number" class="px-2 @error('kodepos') border-danger @enderror" name="kodepos" placeholder="Masukkan Kodepos" value="{{old('kodepos')}}" />
                                @error('kodepos')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tax-select-wrapper">
                                <div class="tax-select mb-0">
                                    <label>Status Alamat Pengiriman</label>
                                    <select class="email s-email s-wid @error('status') border-danger @enderror" name="status">
                                        <option disabled selected hidden>-- Pilih status alamat pengiriman --</option>
                                        <option value="1">Utama</option>
                                        <option value="0">Opsional</option>
                                    </select>
                                </div>
                                @error('status')
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
<div class="modal fade" id="editAlamatPengirimanModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatPengirimanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatPengirimanModalLabel">Edit Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="editAlamatProdukModal" tabindex="-1" role="dialog" aria-labelledby="editAlamatProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAlamatProdukModalLabel">Edit Alamat Pengiriman Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-edit-alamat-produk"></div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $('.delete-produk-cart').on("click", function() {
        var id_detail_cart = $(this).attr('data-id');
        $.ajax({
            type: "DELETE"
            , url: `${APP_URL}/detail-cart/${id_detail_cart}`
            , data: {
                id: id_detail_cart
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
        });
    });

    $('.delete-alamat-pengiriman').on("click", function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "DELETE"
            , url: `${APP_URL}/alamat-pengiriman/${id}`
            , data: {
                id: id
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                alert(err.responseJSON.msg)
            }
        });
    });


    $('#kosong-keranjang').on("click", function() {
        var id_cart = $(this).attr('data-id');
        $.ajax({
            type: "POST"
            , url: `${APP_URL}/kosongkan-keranjang/${id_cart}`
            , data: {
                id: id_cart
                , _method: "PUT"
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
        });
    });

    function decQty(id) {
        $.ajax({
            type: "POST"
            , url: `${APP_URL}/detail-cart/${id}`
            , data: {
                id: id
                , param: 'dec'
                , _method: "PUT"
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                alert(err.responseJSON.msg)
            }
        });
    }

    function incQty(id) {
        $.ajax({
            type: "POST"
            , url: `${APP_URL}/detail-cart/${id}`
            , data: {
                id: id
                , param: 'inc'
                , _method: "PUT"
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                alert(err.responseJSON.msg)
            }
        });

    }

    $('.btn-edit-alamat').on('click', function() {
        var url = $(this).attr('data-url')
        $.ajax({
            type: "GET"
            , url: url
            , success: function(res) {
                $('#body-edit-alamat').html(res.html)
                // window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                // alert(err.responseJSON.msg)
            }
        });
    });

    $('.btn-edit-alamat-produk').on('click', function() {
        var url = $(this).attr('data-url')
        $.ajax({
            type: "GET"
            , url: url
            , success: function(res) {
                $('#body-edit-alamat-produk').html(res.html)
                // window.location.href = `${APP_URL}/cart`;
            }
            , error: function(err) {
                // alert(err.responseJSON.msg)
            }
        });
    });

</script>
@endsection
