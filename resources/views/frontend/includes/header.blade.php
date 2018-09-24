<header class="header">
                <div class="top-box" data-toggle="sticky-onscroll" style="border-bottom:5px solid #0f7ad5">
                    <div class="container">
                       
                        <section class="header-inner">
                            <div class="container">
                                <div class="pull-left pull-sm-up col-sm-12 col-xs-12 text-left" style="margin-top:8px;">
                                    <a href="index.html">
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
                                                    <a class="nav-link" href="{{url('/')}}" role="button" aria-haspopup="true">
                                                        Beranda
                                                    </a>
                                                </li>

                                                {{-- <li class="nav-item dropdown dropdown-mega">
                                                    <a class="nav-link dropdown-toggle {{strpos($url,'berita')!==false ? 'active' : ''}}" data-toggle="dropdown" href="{{url('berita')}}" role="button" aria-haspopup="true" aria-expanded="false" onclick='location.href="{{url("berita")}}"'>
                                                        Berita 
                                                        <i class="icon-dropdown"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-property">
                                                        <div class="container">
                                                            <div class="row">
                                                            @php
                                                                $berita=\App\Models\TrxBerita::where('flag',1)->with('cat_berita')->orderBy('created_at','desc')->limit(4)->get();
                                                            @endphp
                                                            @foreach ($berita as $item)
                                                                <div class="col-md-3">
                                                                    <div class="property-card card">
                                                                        <div class="property-card-header image-box">
                                                                            @if (is_null($item->file))
                                                                                <img src="assets/img/placeholders/395x250.png" alt="" class="" />
                                                                            @else
                                                                                <img src="{{asset($item->file)}}" alt="" class="" style="height:250px;width:395px;" />
                                                                            @endif
                                                                            <a href="listing.html" class="property-card-hover">
                                                                                <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                                                <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                                                <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                                            </a>
                                                                        </div>
                                                                        <div class="property-card-tags">
                                                                            <span class="label label-default label-tag-primary">{{$item->cat_berita->nama_kategori}}</span>
                                                                        </div>
                                                                        <div class="property-card-box card-box card-block" >
                                                                            <h3 class="property-card-title"><a href="{{url('show/'.$item->slug)}}">{{$item->title}}</a></h3>
                                                                            <div class="property-card-descr">{{substr(strip_tags($item->desc),0,100)}} ...</div>
                                                                            <div class="property-preview-footer pull-left clearfix" style="padding-bottom:20px;font-size:11px;">
                                                                                <div class="property-preview-f-left text-color-primary">
                                                                                    <span class="property-card-value">
                                                                                        <i class="fa fa-calendar"></i>{{tgl_indo2($item->created_at)}}
                                                                                    </span>
                                                                                    
                                                                                    <span class="property-card-value">
                                                                                        <i class="fa fa-eye"></i> {{$item->view}}
                                                                                    </span>
                                                                                    <span class="property-card-value">
                                                                                        &nbsp;
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> --}}

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="#" role="button" aria-haspopup="true">
                                                        Berita
                                                    </a>
                                                </li>

                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="#" role="button" aria-haspopup="true">
                                                        Data Jalan
                                                    </a>
                                                </li>
                                                
                                            </ul>
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