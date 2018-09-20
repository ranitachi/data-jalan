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

        <a href="{{ route('login') }}" class="add-list">Login <span><i class="fa fa-sign-in"></i></span></a>

        <!--  navigation --> 
        <div class="nav-holder main-menu">
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('utama') }}" class="act-link">Beranda </a>
                    </li>
                    <li>
                        <a href="{{url('berita')}}">Berita </a>
                    </li>
                    <li>
                        <a href="#">Data RLTH <i class="fa fa-caret-down"></i></a>
                        <!--second level -->
                        <ul>
                            <li><a href="{{ route('hasil.usulan') }}">Hasil Usulan</a></li>
                            <li><a href="{{ route('hasil.verifikasi') }}">Hasil Verifikasi</a></li>
                        </ul>
                        <!--second level end-->
                    </li>
                </ul>
            </nav>
        </div>
        <!-- navigation  end -->
    </div>
</header>