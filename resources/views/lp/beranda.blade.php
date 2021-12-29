@extends('layouts.lp.main')

@section('title', 'Beranda')

@section('content')
<!-- Slider Arae Start -->
<div class="slider-area">
    <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
        <!-- Slider Single Item Start -->
        <div class="slider-height-10 d-flex align-items-start justify-content-start bg-img" style="background-image: url({{asset('templates/landing-page')}}/images/slider-image/sample-22.jpg);">
            <div class="container">
                <div class="slider-content-5 slider-animated-1 text-left">
                    <span class="animated">Selamat Datang Di</span>
                    <h1 class="animated">
                        <strong>ONLINE SHOP</strong><br /> Electronic
                    </h1>
                    <p class="animated">Platform penjualan barang elektronik terbaik</p>
                    <a href="{{route('beranda.listproduk')}}" class="shop-btn animated">Shop Now</a>
                </div>
            </div>
        </div>
        <!-- Slider Single Item End -->
    </div>
</div>
<!-- Slider Arae End -->
<!-- Category Tab Area Start -->
<section class="category-tab-area mt-60px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2>Produk Terpopuler</h2>
                    <p>Tambahkan produk terpopuler ini ke keranjang kamu</p>
                </div>
                <!-- Section Title Start -->
            </div>
        </div>

        @if ($produk->isEmpty())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    Data produk masih kosong.
                </div>
            </div>
        </div>
        @else
        <div class="tab-content">
            <div id="accessories" class="tab-pane active">
                <div class="best-sell-slider owl-carousel owl-nav-style">
                    @foreach ($produk as $item)
                    <article class="list-product">
                        <div class="img-block">
                            <a href="{{route('beranda.detailproduk', $item->id)}}" class="thumbnail">
                                <img class="first-img" src="{{asset('storage/produk/' . $item->gambar)}}" alt="" />
                            </a>
                        </div>
                        <div class="product-decs">
                            <a class="inner-link" href="shop-4-column.html"><span class="text-uppercase">{{$item->kategori->nama}}</span></a>
                            <h2><a href="{{route('beranda.detailproduk', $item->id)}}" class="product-link">{{$item->nama}}</a></h2>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="current-price">Rp {{number_format($item->harga, 0, ',', '.')}}</li>
                                </ul>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Category Tab Area end -->

@endsection

@section('script')
<script>
    function addToCart(id) {
        $.ajax({
            type: "POST"
            , url: `${APP_URL}/detail-cart`
            , data: {
                id: id
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/cart`;
            }
        });
    }

</script>
@endsection
