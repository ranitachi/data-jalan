<header class="header">
                <div class="top-box" data-toggle="sticky-onscroll" style="border-bottom:5px solid #0f7ad5">
                    <div class="container">
                       
                        <section class="header-inner">
                            <div class="container">
                                <div class="pull-left pull-sm-up col-sm-12 col-xs-12 text-left" style="margin-top:8px;">
                                    <a href="{{url('/')}}">
                                        <div class="custom-title-logo">Sistem Informasi Data Jalan</div>
                                        <div>Pemerintah Kabupaten Tangerang</div>
                                    </a>
                                </div>
                                <div class="pull-right pull-sm-up col-sm-6 col-xs-12 websitetitle " style="height:30px;min-width:150px;margin-top:15px;">
                                    <a href="{{url('login')}}" class="row focus-color">
                                        {{-- <div class="sub-title">join us</div> --}}
                                        <h3 class="title">Login <i class="fa fa-sign-in"></i></h3>
                                    </a>
                                </div>
                                <div class="pull-left menu" style="padding:12px 0px !important;"> 
                                    <div class="box-navigaion clearfix">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        
                                    </div>
                                    <nav class="navbar text-color-primary">
                                        <div class="text-right">
                                            <button class="navbar-toggler hidden" type="button" data-toggle="collapse" data-target="#main-menu">
                                                &#9776;
                                            </button>
                                        </div>
                                        <!-- Links -->
                                        @php
                                            $url=Request::path();
                                        @endphp
                                        <div class="collapse navbar-collapse" id="main-menu">
                                            <ul class="nav navbar-nav clearfix">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link {{$url =='/' ? 'active' : ''}}" href="{{url('/')}}" role="button" aria-haspopup="true">
                                                        Beranda
                                                    </a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link {{strpos($url,'berita') !== false ? 'active' : ''}}" href="{{url('berita')}}" role="button" aria-haspopup="true">
                                                        Berita
                                                    </a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link {{strpos($url,'detail-data') !== false ? 'active' : ''}}" href="#" role="button" aria-haspopup="true">
                                                        Jalan
                                                    </a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="#" role="button" aria-haspopup="true">
                                                        Irigasi
                                                    </a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="#" role="button" aria-haspopup="true">
                                                        Situ
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </section><!-- /.menu-->
        </div> 
    </div>
    <div class="top-box-mask"></div>
    <div class="container">
        <section class="header-slider header-map">
            <h2 class="hidden">Map</h2>
            <div class="main-map" id="main-map" style='height:600px'></div>
        </section><!-- /.header-video-->
        
    </div>
</header><!-- /.header--> 