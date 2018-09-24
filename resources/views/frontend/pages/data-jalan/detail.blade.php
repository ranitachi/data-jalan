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
                                    <h2 class="h-side-title page-title text-color-primary">Ruas Jalan Kecamatan {{$kec}}</h2> <span class='h-side-additional'></span>
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
    $dt[0]=array(
        'label'=> 'Beton',
        'backgroundColor'=>('lightblue'),
        'data'=>[number_format(array_sum($grafik['beton']),2)]
    );
    $dt[1]=array(
        'label'=> 'Aspal',
        'backgroundColor'=>('yellow'),
        'data'=>[number_format(array_sum($grafik['aspal']),2)]
    );
    $dt[2]=array(
        'label'=> 'Lain-lain',
        'backgroundColor'=>('red'),
        'data'=>[number_format(array_sum($grafik['dll']),2)]
    );

    $total=array_sum($grafik['beton'])+array_sum($grafik['aspal'])+array_sum($grafik['dll']);
    $dt[3]=array(
        'label'=> 'Total',
        'backgroundColor'=>('gray'),
        'data'=>[number_format($total,2)]
    );
    
@endphp
@section('footscript')
<script src="{{asset('assets/js/kecamatan.js')}}"></script>
<script>
    LoadMap_main_detail('blue','{{strtolower(str_slug($kec))}}','{{$kecm->lat}}','{{$kecm->lng}}');

    function pindahdetail(val)
    {
        location.href='{{url("detail-data")}}/'+val;
    }
</script>
<script type="text/javascript" src="{{asset('chart/chart.min.js') }}"></script>
<script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>    
<script>
        
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ruas Jalan'],
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
                            align: 'middle',
                            anchor: 'end',
                            color: "#000000",
                            formatter: function(value, context) {
                                // return value.toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1.2');
                                // return parseFloat(Math.round(value * 100) / 100).toFixed(2);
                                return value+' km';
                            }
                        }
                    }
            }
        });
</script>
@endsection