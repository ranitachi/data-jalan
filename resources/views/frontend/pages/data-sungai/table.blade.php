@extends('frontend.layouts.pages')
@section('title')
    <title>Berita : Kabupaten Tangerang</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
    <style>
        td {
            font-size:12px;
        }
    </style>
@endsection

@section('judul')
<section class="top-title-widget color-primary">
    <div class="container">
        <div  style="width:85%;margin:0 auto;">
        <ul class="breadcrumb top-title-breadcrumb">
            <li class="item"><a href="{{url('/')}}"> Beranda </a></li>
            <li class="item"> Data Sungai </li>
        </ul>
        <h1 class="top-title-t">Data Sungai</h1> 
        </div>
    </div>
</section>
@endsection

@section('konten')
    <main class="main main-container section-color-primary"  style="width:85%;margin:0 auto;padding-top:10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-list-box fl-wrap">
                        <div class="col-md-12 table-responsive" style="text-align:left;">
                            <br>
                            <table id="user-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width:15px;">#</th>
                                            <th rowspan="2">Nama Sungai</th>
                                            <th rowspan="2">Kecamatan</th>
                                            <th rowspan="2">Areal (Ha)</th>
                                            <th colspan="3">Panjang Sungai</th>
                                        </tr>
                                        <tr>
                                            <th>Primer</th>
                                            <th>Sekunder</th>
                                            <th>Tersier</th>
                                        </tr>
                                       
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key = $key + 1 }}</td>
                                                <td>{{ $item->nama_sungai }}</td>
                                                <td>{{ $item->kecamatan }}</td>
                                                <td class="text-center"><span class="label font100 label-info">{{ number_format($item->areal,0,',','.') }}</span></td>
                                                <td style="width:130px">
                                                    <span class="label font100 label-success">{{number_format($item->panjang_sungai_primer,0,',','.')}} m</span>
                                                </td>
                                                <td style="width:130px">    
                                                    <span class="label font100 label-warning">{{number_format($item->panjang_sungai_sekunder,0,',','.')}} m</span>
                                                </td>
                                                <td style="width:130px">    
                                                    <span class="label font100 label-info">{{number_format($item->panjang_sungai_tersier,0,',','.')}} m</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection