@extends('frontend.layouts.pages')
@section('title')
    <title>Data Ruas Jalan : Kabupaten Tangerang</title>
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
                                    <h2 class="search-title">Ruas Jalan Pada Kecamatan</h2>
                                    <form action="#" class="form-horisontal form-primary">
                                        <div class="row-fluid clearfix">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control color-secondary" readonly style="background:#004790;" value="{{$kec}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker color-secondary" name="kecamatan" id="kecamatan" onchange="pindahdetail(this.value)">
                                                        <option value='-'>Pilih Ruas Jalan</option>
                                                        @foreach ($djalan as $item)
                                                                <option value="Ruas{{$item->no_ruas}}">{{$item->no_ruas}} : {{$item->nama_jalan}}</option>
                                                            
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
                                <h2 class="h-side-title page-title text-color-primary">Detail Ruas Jalan {{$datajalan->nama_jalan}}</h2> <span class='h-side-additional'></span>
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
                                                    <th class="text-center" rowspan="2">No Ruas Jalan</th>
                                                    <th class="text-center" rowspan="2">Nama Ruas</th>
                                                    <th class="text-center" rowspan="2">Kecamatan</th>
                                                    <th class="text-center" colspan="2">Volume</th>
                                                    <th class="text-center" rowspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Panjang (m)</th>
                                                    <th class="text-center">Lebar (m)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td class="text-center">{{$datajalan->no_ruas}}</td>
                                                <td class="text-center">{{$datajalan->nama_jalan}}</td>
                                                <td class="text-center">{{$kec}}</td>
                                                <td class="text-center">{{$datajalan->vol_panjang_km}}</td>
                                                <td class="text-center">{{$datajalan->vol_lebar_m}}</td>
                                                <td class="text-center">
                                                    @if ($datajalan->keterangan=='PR')
                                                        <span class="label label-warning">{{$datajalan->keterangan}}</span>
                                                    @elseif ($datajalan->keterangan=='PP')
                                                        <span class="label label-success">{{$datajalan->keterangan}}</span>
                                                    @elseif ($datajalan->keterangan=='REHB')
                                                        <span class="label label-default">{{$datajalan->keterangan}}</span>
                                                    @elseif ($datajalan->keterangan=='PKT')
                                                        <span class="label label-info">{{$datajalan->keterangan}}</span>   
                                                    @elseif ($datajalan->keterangan=='Pemb')
                                                        <span class="label label-danger">{{$datajalan->keterangan}}</span>
                                                    @endif
                                                </td>
                                            </tbody>
                                        </table>
                                        <ul>
                                            <li><span class="label label-warning">PR   : Pemeliharaan Rutin</span></li>
                                            <li><span class="label label-success">PP   : Pemeliharaan Periodik</span></li>
                                            <li><span class="label label-default">REHB : Rehabilitas</span></li>
                                            <li><span class="label label-info">PKT  : Peningkatan</span></li>
                                            <li><span class="label label-danger">Pemb : Pembangunan</span></li>
                                        </ul>
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
</style>
<script src="{{asset('assets/js/kecamatan.js')}}"></script>
<script>
    LoadMap_main_detail('blue','{{strtolower(str_slug($kec))}}','{{$kecm->lat}}','{{$kecm->lng}}');

    function pindahdetail(val)
    {
        location.href='{{url("detail-ruas-jalan")}}/'+val;
    }
</script>
<script type="text/javascript" src="{{asset('chart/chart.min.js') }}"></script>
<script src="{{asset('chart/datalabel.js')}}" type="text/javascript"></script>    
<script>
        
       
</script>
@endsection