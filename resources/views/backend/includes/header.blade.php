<header class="main-header dark-header fs-header sticky">
    <div class="header-inner">
        <div class="logo-holder">
            <style>
                .custom-title-logo {
                    font-size: 22px;
                    font-family: 'Arial';
                    font-weight: bold;
                    color: #fff;
                    margin-right: 20px;
                }
            </style>
            <div class="text-logo" style="text-align:left;margin-top:-5px;">
                <div class="custom-title-logo">Sistem Informasi Data Jalan</div>
                <div style="color:#fff;">Pemerintah Kabupaten Tangerang</div>
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
                        <a href="#">Dashboard</a>
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
                        <a href="#">Data Jalan</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- navigation  end -->
    </div>
</header>