@extends('frontend.layouts.pages')
@section('title')
    <title>Data Jalan Kecamatan {{$kec}} : Kabupaten Tangerang</title>
@endsection

@section('konten')
    <main class="main section-color-primary">
                <div class="container">
                    <div class="row content-flex">
                        <div class="col-md-6 content-left"  id="main-map-detail">
                        </div>
                        <div class="col-md-6 content-right">
                            <section class="search-form color-primary">
                                <div class="">
                                    <h2 class="search-title">Kecamatan</h2>
                                    <form action="#" class="form-horisontal form-primary">
                                        <div class="row-fluid clearfix">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control color-secondary" readonly style="background:#004790;" value="Pilih Kecamatan" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker color-secondary" name="kecamatan" id="kecamatan" onchange="pindahdetail(this.value)">
                                                        @foreach ($kecamatan as $item)
                                                            @if ($item->nama_kecamatan==strtoupper($kec))
                                                                <option value="{{$item->nama_kecamatan}}" selected="selected">{{$item->nama_kecamatan}}</option>
                                                            @else
                                                                <option value="{{$item->nama_kecamatan}}">{{$item->nama_kecamatan}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section><!-- /.header-search-->
                            <div class="h-side clearfix" style="padding:20px 0 !important;">
                                <div class="pull-left">
                                    <h2 class="h-side-title page-title text-color-primary">Data Irigasi Kecil Kecamatan {{$kec}}</h2> <span class='h-side-additional'></span>
                                </div>
                                <div class="pull-right">
                                    
                                </div>
                            </div> <!-- /. content-header --> 
                            <div class="properties">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <canvas id="myChart" height="100"></canvas>
                                    </div>
                                    {{-- <div class="col-md-6 col-sm-6">
                                        <div class="property-card card">
                                            <div class="property-card-header image-box">
                                                <img src="{{asset('assets/img/placeholders/395x250.png')}}" alt="" class="" />
                                                <a href="listing.html" class="property-card-hover">
                                                    <img src="{{asset('assets/img/property-hover-arrow.png')}}" alt="" class="left-icon" />
                                                    <img src="{{asset('assets/img/plus.png')}}" alt="" class="center-icon" />
                                                    <img src="{{asset('assets/img/icon-notice.png')}}" alt="" class="right-icon" />
                                                </a>
                                            </div>
                                            <div class="property-card-tags">
                                                <span class="label label-default label-tag-primary">sale</span>
                                            </div>
                                            <div class="property-card-box card-box card-block">
                                                <h3 class="property-card-title"><a href="listing.html">Swimming pool</a></h3>
                                                <div class="property-card-descr">This is simply dummy text of the printing and typesetting industry. That has been the industry standard ...</div>
                                                <div class="property-preview-footer  clearfix">
                                                    <div class="property-preview-f-left text-color-primary">
                                                        <span class="property-card-value">
                                                            <i class="fa fa-home"></i>House
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-tint"></i>1
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-square-o"></i>200m
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-eur"></i>60 000
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6">
                                        <div class="property-card card">
                                            <div class="property-card-header image-box">
                                                <img src="{{asset('assets/img/placeholders/395x250.png')}}" alt="" class="" />
                                                <a href="listing.html" class="property-card-hover">
                                                    <img src="{{asset('assets/img/property-hover-arrow.png')}}" alt="" class="left-icon" />
                                                    <img src="{{asset('assets/img/plus.png')}}" alt="" class="center-icon" />
                                                    <img src="{{asset('assets/img/icon-notice.png')}}" alt="" class="right-icon" />
                                                </a>
                                            </div>
                                            <div class="property-card-tags">
                                                <span class="label label-default label-tag-warning">rent</span>
                                            </div>
                                            <div class="property-card-box card-box card-block">
                                                <h3 class="property-card-title"><a href="listing.html">House</a></h3>
                                                <div class="property-card-descr">This is simply dummy text of the printing and typesetting industry. That has been the industry standard ...</div>
                                                <div class="property-preview-footer  clearfix">
                                                    <div class="property-preview-f-left text-color-primary">
                                                        <span class="property-card-value">
                                                            <i class="fa fa-home"></i>House
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-tint"></i>1
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-square-o"></i>200m
                                                        </span>
                                                        <span class="property-card-value">
                                                            <i class="fa fa-eur"></i>60 000
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div><!-- /.properties -->
                               
                            </div> <!-- /.properties--> 
                            <div class="h-side clearfix" style="padding: 0 0 10px !important;">
                                <div class="pull-left">
                                    <h2 class="h-side-title page-title text-color-primary">Detail</h2> <span class='h-side-additional'></span>
                                </div>
                                <div class="pull-right">
                                    
                                </div>
                            </div> <!-- /. content-header --> 
                            <div class="properties">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#home">Panjang Saluran</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Bangunan Utama</a></li>
                                            <li><a data-toggle="tab" href="#menu2">Bangunan Pelengkap</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane fade in active">
                                                <canvas id="myChart1" height="100"></canvas>
                                            </div>
                                            <div id="menu1" class="tab-pane fade">
                                                <canvas id="myChart2" height="100"></canvas>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                                <canvas id="myChart3" height="100"></canvas>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main>
    @include('frontend.pages.dashboard.modal-register')
@endsection
<style>
.components-examples ul, .box-container-title .sub-title, body p
{
    max-width: unset !important;
}
</style>
@php
    
    $dt=array();
    $panjang=$utama=$pelengkap=array();
    $color=array('lightblue','yellow','red','gray','brown');
    $x=0;
    $dr=array();
    foreach($daerah as $k=>$v)
    {   
        $dr[]=$v;
        $dt[$x]=array(
            'label' => $v,
            'backgroundColor' => ($color[$x]),
            'data'=>[number_format($areal[$k],2)]
        );

        $y=0;
        foreach($panjang_saluran[$k] as $kk=>$vv)
        {
            
            $warna1='#'.random_color();
            $n_sekunder=$panjang_saluran[$k]['sekunder'];
            $n_tersier=$panjang_saluran[$k]['tersier'];
            $panjang[$y]=array(
                'label' => ucwords($kk),
                'backgroundColor' => $warna1,
                'data'=>[number_format($vv) , number_format($n_sekunder) , number_format($n_tersier) ]
                // 'yAxisID'=>"y-axis-".$k
            );
            $y++;
        }
        
        $y=0;
        foreach($bangunan_utama[$k] as $kk=>$vv)
        {
            
            $warna1='#'.random_color();
            $n_pintu_air=$bangunan_utama[$k]['pintu_air'];
            $n_intake=$bangunan_utama[$k]['intake'];
            $utama[$y]=array(
                'label' => ucwords($kk),
                'backgroundColor' => $warna1,
                'data'=>[number_format($vv) , number_format($n_pintu_air) , number_format($n_intake) ]
                // 'yAxisID'=>"y-axis-".$k
            );
            $y++;
        }
        
        $y=0;
        foreach($bangunan_pelengkap[$k] as $kk=>$vv)
        {     
            $warna1='#'.random_color();
            $n_gorong=$bangunan_pelengkap[$k]['gorong'];
            $n_jembatan=$bangunan_pelengkap[$k]['jembatan'];
            $pelengkap[$y]=array(
                'label' => ucwords($kk),
                'backgroundColor' => $warna1,
                'data'=>[number_format($vv) , number_format($n_gorong) , number_format($n_jembatan) ]
                // 'yAxisID'=>"y-axis-".$k
            );
            $y++;
        }

        $x++;
    }
    // echo json_encode($bangunan_pelengkap);
    // dd($utama);
@endphp
@section('footscript')
<script src="{{asset('assets/js/kecamatan.js')}}"></script>
<script>
    LoadMap_main_detail('blue','{{strtolower(str_slug($kec))}}','{{$kecm->lat}}','{{$kecm->lng}}');

    function pindahdetail(val)
    {
        location.href='{{url("detail-data-irigasi")}}/'+val;
    }
</script>
<script type="text/javascript" src="{{asset('chart/chart.min.js') }}"></script>
<script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>    
<script>
        
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Daerah Irigasi (Ha)'],
                datasets: <?php echo json_encode($dt);?>
            },

            options: {
                legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: "#000080",
                }
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                },
                plugins: {
                    datalabels: {
                            align: 'top',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                // return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.2');
                                // return parseFloat(Math.round(value * 100) / 100).toFixed(2);
                                return value+' Ha';
                            }
                        }
                    }
            }
        });
        
        var ctx = document.getElementById("myChart1").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dr);?>,
                datasets: <?php echo json_encode($panjang);?>
            },

            options: {
                legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: "#000080",
                }
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                },
                plugins: {
                    datalabels: {
                            align: 'bottom',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                // return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.2');
                                // return parseFloat(Math.round(value * 100) / 100).toFixed(2);
                                return value+' M';
                            }
                        }
                    }
            }
        });
        var ctx = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dr);?>,
                datasets: <?php echo json_encode($utama);?>
            },

            options: {
                legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: "#000080",
                }
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                },
                plugins: {
                    datalabels: {
                            align: 'bottom',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                // return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.2');
                                // return parseFloat(Math.round(value * 100) / 100).toFixed(2);
                                return value+' Bh';
                            }
                        }
                    }
            }
        });
        var ctx = document.getElementById("myChart3").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dr);?>,
                datasets: <?php echo json_encode($pelengkap);?>
            },

            options: {
                legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: "#000080",
                }
                },
                scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
                },
                plugins: {
                    datalabels: {
                            align: 'bottom',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                // return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.2');
                                // return parseFloat(Math.round(value * 100) / 100).toFixed(2);
                                return value+' Bh';
                            }
                        }
                    }
            }
        });
</script>
@endsection