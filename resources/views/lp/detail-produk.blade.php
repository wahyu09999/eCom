@extends('layouts.lp.main')

@section('title', $produk->nama)

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Detail Produk</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{route('beranda')}}">Beranda</a></li>
                        <li>{{$produk->nama}}</li>
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
            <div class="col-xl-4 col-lg-8 col-md-12">
                <div class="product-details-img product-details-tab">
                    <div class="zoompro-wrap zoompro-2">
                        <div class="zoompro-border zoompro-span">
                            <img src="{{asset('storage/produk/'. $produk->gambar)}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-4 col-md-12 ">
                <div class="product-details-content">
                    <h2>{{$produk->kategori->nama}}</h2>
                    <h1>{{$produk->nama}}</h1>
                    <div class="pricing-meta">
                        <ul>
                            <li class="old-price not-cut text-danger">Rp {{number_format($produk->harga, 0, ',', '.')}}</li>
                        </ul>
                    </div>
                    <p>Stok Produk : {{ $produk->stok}}</p>
                    <hr>
                    <p>{{$produk->deskripsi}}</p>
                    <hr>
                    <div class="pro-details-quality mt-3">
                        <div class="cart-plus-minus">
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" id="qty-produk" value="1" min="1" />
                        </div>
                        <div class="pro-details-cart btn-hover">
                            @if (Auth::user())
                            <a href="javascript:void(0)" onclick="addToCart({{$produk->id}})"> + Tambahkan Ke Keranjang</a>
                            @else
                            <a href="javascript:void(0)" onclick="showAlert()"> + Tambahkan Ke Keranjang</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger" id="alert-add-cart" style="display: none;"></div>
            </div>
        </div>
    </div>
</section>
<!-- Shop details Area End -->

@endsection

@section('script')
<script>
    function addToCart(id) {
        var qty = $('#qty-produk').val();
        $.ajax({
            type: "POST"
            , url: `${APP_URL}/detail-cart`
            , data: {
                id: id
                , qty: qty
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
            , error: function(res) {
                alert(res.responseJSON.msg)
            }
        });
    }

    function showAlert() {
        $('#alert-add-cart').show();
        $('#alert-add-cart').text('Anda harus login terlebih dahulu.')
    }

</script>
@endsection
