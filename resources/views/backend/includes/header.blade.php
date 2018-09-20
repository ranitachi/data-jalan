<header class="main-header dark-header fs-header sticky">
    <div class="header-inner">
        <div class="logo-holder">
            <div class="home-logo">
                <img src="{{ asset('theme') }}/images/homeicon.png">
            </div>
            <div class="text-logo">
                <a href="#">
                    <h3>
                        <span>Aplikasi <strong>Survey</strong> Identifikasi <strong>Kekumuhan</strong></span>
                    </h3>
                    <span class="logo-white">
                        Pemerintahan Kabupaten Tangerang
                    </span>
                </a>
            </div>
        </div>
        
        <div class="header-user-menu">
            <div class="header-user-name">
                <span><img src="{{ asset('theme') }}/images/avatar/avatar-bg.png" alt=""></span>
                Hello, {{ Auth::user()->name }}
            </div>
            <ul>
                <li><a class="modal-open-cp" style="cursor:pointer;">Ganti Password</a></li>
                <li><a href="{{ route('user.management') }}">Pengguna Sistem</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- nav-button-wrap--> 
        <div class="nav-button-wrap color-bg">
            <div class="nav-button">
                <span></span><span></span><span></span>
            </div>
        </div>
        <!-- nav-button-wrap end-->
        <!--  navigation --> 
        <div class="nav-holder main-menu">
            <nav>
                <ul>
                    <li>
                        <a href="#" class="act-link">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">Berita<i class="fa fa-caret-down"></i></a>
                        <!--second level -->   
                        <ul>
                            <li><a href="{{ url('kategori-admin') }}">Kategori</a></li>
                            <li><a href="{{ url('berita-admin') }}">Data Berita</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Data Rumah <i class="fa fa-caret-down"></i></a>
                        <!--second level -->   
                        <ul>
                            <li><a href="{{ route('usulan.index') }}">Usulan</a></li>
                            <li><a href="{{ route('verifikasi.index') }}">Verifikasi</a></li>
                        </ul>
                        <!--second level end-->        
                    </li>
                </ul>
            </nav>
        </div>
        <!-- navigation  end -->
    </div>
</header>