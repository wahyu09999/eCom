    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('templates/dashboard')}}/img/sidebar-3.jpg">
        <div class="logo"><a href="{{route('beranda')}}" class="simple-text logo-normal">
                Olshop Electronic
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('dashboard.index')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" target="_blank" href="{{route('beranda')}}">
                        <i class="material-icons">home</i>
                        <p>Halaman Utama</p>
                    </a>
                </li>
                <li class="nav-item {{Request::segment(1) == 'profil' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('user.profil')}}">
                        <i class="material-icons">person</i>
                        <p>Data Profil</p>
                    </a>
                </li>
                <li class="nav-item {{Request::segment(1) == 'user' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('user.index')}}">
                        <i class="material-icons">people</i>
                        <p>Data User</p>
                    </a>
                </li>
                <li class="nav-item {{Request::segment(1) == 'kategori' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('kategori.index')}}">
                        <i class="material-icons">category</i>
                        <p>Data Kategori</p>
                    </a>
                </li>
                <li class="nav-item {{Request::segment(1) == 'produk' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('produk.index')}}">
                        <i class="material-icons">inventory_2</i>
                        <p>Data Produk</p>
                    </a>
                </li>
                <li class="nav-item {{Request::segment(1) == 'transaksi' ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('transaksi.index')}}">
                        <i class="material-icons">
                            shopping_cart
                        </i>
                        <p>Data Transaksi</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
