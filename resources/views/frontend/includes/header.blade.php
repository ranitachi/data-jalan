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
            <div id="legend">
                <h4>Info</h4>
                <label class="container-custom">Data Wilayah Kecamatan
                <input type="checkbox" checked="checked" onclick="show_wilayah()" id="show_wilayah">
                <span class="checkmark"></span>
                </label>

                <label class="container-custom">Data Ruas Jalan
                <input type="checkbox" id="show_ruas_jalan" onclick="show_ruas_jalan()">
                <span class="checkmark"></span>
                </label>
            </div>
        </section><!-- /.header-video-->
        
    </div>
</header><!-- /.header--> 
<style>
    #legend {
        font-family: Arial, sans-serif;
        background: #def;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
        margin-top: -150px;
        z-index:1000000;
        position:absolute
      }
      #legend h3 {
        margin-top: 0;
      }
      #legend img {
        vertical-align: middle;
      }
      .container-custom {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 13px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container-custom input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            background-color: #fff;
            border:1px solid #111
        }

        /* On mouse-over, add a grey background color */
        .container-custom:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container-custom input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .container-custom input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .container-custom .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        }
</style>
<script>
var defaulColor ='';
function show_wilayah()
{
    // LoadMap_main(defaulColor,true,true);
    var cek = $('#show_wilayah:checkbox:checked').length;
    var cekjalan = $('#show_ruas_jalan:checkbox:checked').length;
    // alert(cek);
    if(cek==0)
    {
        if(cekjalan==0)
            LoadMap_main(defaulColor,false,false);
        else
            LoadMap_main(defaulColor,false,true);
    }  
    else
    {
        if(cekjalan==0)
            LoadMap_main(defaulColor,true,false);
        else
            LoadMap_main(defaulColor,true,true);
    } 
}
function show_ruas_jalan()
{
    // LoadMap_main(defaulColor,true,true);
    var cek = $('#show_wilayah:checkbox:checked').length;
    var cekjalan = $('#show_ruas_jalan:checkbox:checked').length;
    // alert(cek);
    if(cekjalan==0)
    {
        if(cek==0)
            LoadMap_main(defaulColor,false,false);
        else
            LoadMap_main(defaulColor,true,false);
    }  
    else
    {
        if(cek==0)
            LoadMap_main(defaulColor,false,true);
        else
            LoadMap_main(defaulColor,true,true);
    } 
}
</script>