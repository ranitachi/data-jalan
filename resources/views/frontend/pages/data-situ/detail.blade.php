@extends('frontend.layouts.pages')
@section('title')
    <title>Data Sungai {{$kec}} : Kabupaten Tangerang</title>
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
                                    <h2 class="h-side-title page-title text-color-primary">Data Jembatan Kecamatan {{$kec}}</h2> <span class='h-side-additional'></span>
                                </div>
                                <div class="pull-right">
                                    
                                </div>
                            </div> <!-- /. content-header --> 
                            <div class="properties">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12" style="height:400px;overflow-y: auto;white-space: nowrap;">
                                        <table class="table table-stripped table-bordered table-hovered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">No</th>
                                                    <th class="text-center" rowspan="2">Nama Situ</th>
                                                    <th class="text-center" rowspan="2">DAS</th>
                                                    <th class="text-center" colspan="2">Luas</th>
                                                    <th class="text-center" rowspan="2">Pengelolaan</th>
                                                    <th class="text-center" rowspan="2">Kondisi</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Asal(Ha)</th>
                                                    <th class="text-center">Sekarang(Ha)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($datasitu as $item)
                                                    
                                                        <tr>
                                                            <td class="text-center">{{$no}}</td>
                                                            <td class="text-left">{{$item->nama_situ}}</td>
                                                            <td class="text-center">{{$item->das}}</td>
                                                            <td class="text-center">{{number_format($item->luas_asal,2,',','.')}}</td>
                                                            <td class="text-center">{{number_format($item->luas_sekarang,2,',','.')}}</td>
                                                            <td class="text-center">
                                                                @if ($item->pengelolaan_pusat==1)
                                                                    PUSAT
                                                                @elseif($item->pengelolaan_provinsi==1)
                                                                    PROVINSI
                                                                @elseif($item->pengelolaan_kabupaten==1)
                                                                    KABUPATEN
                                                                @endif
                                                            </td>
                                                            <td class="text-center">{{$item->kondisi}}</td>
                                                        </tr>
                                                    @php
                                                        $no++;
                                                    @endphp
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div><!-- /.properties -->
                               
                            </div> <!-- /.properties--> 
                           
                            <div class="properties">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <canvas id="myChart2" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.center-content -->
                    </div>
                </div>
            </main>
    @include('frontend.pages.dashboard.modal-register')
@endsection
@section('footscript')
    <style>
    .components-examples ul, .box-container-title .sub-title, body p
    {
        max-width: unset !important;
    }
    .table th
    {
        background:#0f7ad5;
        font-size:10px;
        color:white;
    }
    .table td{
        font-size:10px;
        font-weight: 500;
    }
    </style>
    @php
        
        
    @endphp
<script src="{{asset('assets/js/kecamatan.js')}}"></script>
<script>
    LoadMap_main_detail('blue','{{strtolower(str_slug($kec))}}','{{$kecm->lat}}','{{$kecm->lng}}');

    function pindahdetail(val)
    {
        location.href='{{url("detail-data-sungai")}}/'+val;
    }
</script>
<script type="text/javascript" src="{{asset('chart/chart.min.js') }}"></script>
<script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>    
<script>
        
        
</script>
@endsection