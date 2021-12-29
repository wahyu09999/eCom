@extends('layouts.lp.main')

@section('title', 'Order')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <h1 class="breadcrumb-hrading">Order</h1>
                    <ul class="breadcrumb-links">
                        <li><a href="{{route('beranda')}}">Beranda</a></li>
                        <li>Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="cart-main-area mb-5">
    <div class="container">
        <h3 class="cart-page-title">Order Anda saat ini</h3>
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive cart-table-content">
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Gambar Produk</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Alamat Pengiriman</th>
                                <th>Status</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                            ad
                            @else
                            @foreach ($orders as $order)
                            <tr class="bg-dark">
                                <td class="py-2 px-5 text-white font-weight-bold">
                                    @if ($order->cart->status_pembayaran == "belum" && $order->bukti_transfer != null)
                                    <span class="badge badge-warning py-2 px-3 my-1">Proses Verifikasi Admin</span>
                                    @endif
                                    @if ($order->bukti_transfer == null)
                                    <a href="javascript:void(0)" onclick="batalOrder({{$order->id}})">
                                        <span class="badge badge-danger py-2 px-3 my-1">Batalkan Order</span>
                                    </a>
                                    @endif
                                    {{$order->cart->no_invoice}}
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="py-2 font-weight-bold text-white">
                                    @if ($order->cart->status_pembayaran == "belum")
                                    <a href="{{route('showupload', $order->id)}}">
                                        <span class="badge badge-danger py-2 px-3 my-1">Belum Bayar</span>
                                    </a>
                                    @else
                                    <span class="badge badge-success py-2 px-3 my-1">Sudah Bayar</span>
                                    @endif
                                    @if ($order->cart->status_pengiriman == "belum")
                                    <span class="badge badge-danger py-2 px-3 my-1">Belum Dikirim</span>
                                    @else
                                    <span class="badge badge-success py-2 px-3 my-1">Sudah Dikrim</span>
                                    @endif
                                </td>
                                <td class="py-2 font-weight-bold text-white">Rp {{ number_format($order->cart->total, 0, ',', '.')}}</td>
                            </tr>
                            @foreach ($order->cart->detail as $id)
                            <tr>
                                <td></td>
                                <td>
                                    <a href="{{route('beranda.detailproduk', $id->produk->id)}}"><img src="{{asset('storage/produk/' . $id->produk->gambar)}}" class="w-50" alt="" /></a>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{$id->produk->kategori->nama}}
                                    </span>
                                    <br>
                                    <a href="{{route('beranda.detailproduk', $id->produk->id)}}" class="text-dark">{{$id->produk->nama}}</a>
                                </td>
                                <td>{{$id->qty}}</td>
                                <td>Rp {{ number_format($id->subtotal, 0, ',', '.')}}</td>

                                <td>
                                    @if (isset($id->alamat))
                                    {{$id->alamat->nama_penerima}}, {{$id->alamat->alamat}}
                                    <br>
                                    {{$id->alamat->kelurahan}} - {{$id->alamat->kecamatan}} - {{$id->alamat->kota}} - {{$id->alamat->provinsi}}
                                    <br>
                                    <span>
                                        Kodepos :
                                        {{$id->alamat->kodepos}}
                                    </span>
                                    @else
                                    Pengiriman Kosong
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach

                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!$orders->isEmpty())
            <div class="col-12 mt-5">
                {{$orders->links('pagination::bootstrap-4')}}
            </div>
            @endif
        </div>
    </div>
</div>
<!-- cart area end -->
@endsection

@section('script')
<script>
    function batalOrder(id) {
        $.ajax({
            type: "DELETE"
            , url: `${APP_URL}/order/${id}`
            , data: {
                id: id
            }
            , success: function(res) {
                window.location.href = `${APP_URL}/order`;
            }
            , error: function(err) {
                alert(err.responseJSON.msg)
            }
        });
    }

</script>
@endsection
