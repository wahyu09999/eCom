        <!-- Header Start -->
        <header class="main-header home-10">
            <!-- Header Top Start -->
            <div class="header-top-nav">
                <div class="container">
                    <div class="row">
                        <!--Left Start-->
                        <div class="col-lg-4 col-md-4">
                            <div class="left-text">
                                <p>Selamat Datang di Website Online Shop Kami!</p>
                            </div>
                        </div>
                        <!--Left End-->
                        <!--Right Start-->
                        <div class="col-lg-8 col-md-8 text-right">
                            <div class="header-right-nav">
                                <div class="dropdown-navs">
                                    <ul>
                                        @if (Route::has('login'))
                                        @auth
                                        @if (Auth::user()->role == "adm")
                                        <li class="after-n">
                                            <a href="{{ route('dashboard.index') }}">Dashboard</a>
                                        </li>
                                        @else
                                        <li class="after-n">
                                            <a href="{{ route('beranda.profil') }}">Profil</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                        @else
                                        <li class="after-n">
                                            <a href="{{ route('login') }}">Log in</a>
                                        </li>
                                        @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">Register</a>
                                        </li>
                                        @endif
                                        @endauth
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Right End-->
                    </div>
                </div>
            </div>
            <!-- Header Top End -->
            <!-- Header Buttom Start -->
            <div class="header-navigation d-lg-block d-none">
                <div class="container">
                    <div class="row">
                        <!-- Logo Start -->
                        <div class="col-md-2 col-sm-2">
                            <div class="logo">
                                <a href="{{route('beranda')}}">
                                    <h4 class="font-weight-bold">Olshop Electronic</h4>
                                </a>
                            </div>
                        </div>
                        <!-- Logo End -->
                        <div class="col-md-10 col-sm-10">
                            <!--Header Bottom Account Start -->
                            <div class="header_account_area home-6">
                                <!--Seach Area Start -->
                                <div class="header_account_list search_list">
                                    <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                                    <div class="dropdown_search">
                                        <form action="{{route('beranda.cariProduk')}}" method="GET">
                                            <input placeholder="Cari produk ..." type="text" name="keywords" />
                                            <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!--Seach Area End -->
                                <!--Cart info Start -->
                                <style>
                                    .count-cart::after {
                                        content: attr(data-count);
                                    }

                                </style>
                                <div class="cart-info-wrap">
                                    <div class="cart-info d-flex home-9">
                                        <div class="mini-cart-warp">
                                            <a href="{{route('cart.index')}}" class="count-cart" data-count="0"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--Cart info End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Header Bottom Account End -->
            <!-- Menu Content Start -->
            <div class="header-buttom-nav sticky-nav">
                <div class="container position-relative">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <div class="d-flex align-items-start justify-content-start">
                                <!--Main Navigation Start -->
                                <div class="main-navigation d-none d-lg-block">
                                    <ul>
                                        <li><a href="{{route('beranda')}}">Beranda</a></li>
                                        <li><a href="{{route('beranda.listproduk')}}">Produk</a></li>
                                        @if (Auth::check())
                                        <li><a href="{{route('order.index')}}">Order</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <!--Main Navigation End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu Content End -->
            <!-- Header Buttom Start -->
            <div class="header-navigation sticky-nav d-lg-none">
                <div class="container position-relative">
                    <div class="row">
                        <!-- Logo Start -->
                        <div class="col-md-6 col-sm-6">
                            <div class="logo">
                                <a href="{{route('beranda')}}">
                                    <h4 class="font-weight-bold">OS Electronic</h4>
                                </a>
                            </div>
                        </div>
                        <!-- Logo End -->
                        <!-- Navigation Start -->
                        <div class="col-md-6 col-sm-6">
                            <!--Header Bottom Account Start -->
                            <div class="header_account_area">
                                <!--Seach Area Start -->
                                <div class="header_account_list search_list">
                                    <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                                    <div class="dropdown_search">
                                        <form action="{{route('beranda.cariProduk')}}" method="GET">
                                            <input placeholder="Cari produk ..." type="text" name="keywords" />
                                            <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!--Seach Area End -->
                                <!--Cart info Start -->
                                <div class="cart-info home-9 d-flex">
                                    <div class="mini-cart-warp">
                                        <a href="{{route('cart.index')}}" class="count-cart" data-count="0"></a>
                                    </div>
                                </div>
                                <!--Cart info End -->
                            </div>
                        </div>
                    </div>
                    <!-- mobile menu -->
                    <div class="mobile-menu-area">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="{{route('beranda')}}">Beranda</a></li>
                                    <li><a href="{{route('beranda.listproduk')}}">Produk</a></li>
                                    @if (Auth::check())
                                    <li><a href="{{route('order.index')}}">Order</a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- mobile menu end-->
                </div>
            </div>
            <!--Header Bottom Account End -->
        </header>
        <!-- Header End -->
