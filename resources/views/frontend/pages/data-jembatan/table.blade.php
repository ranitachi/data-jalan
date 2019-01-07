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
                                            <th rowspan="2">Kecamatan</th>
                                            <th rowspan="2">Nomor Jembatan</th>
                                            <th rowspan="2">Nomor Ruas Jalan</th>
                                            <th colspan="2">Volume</th>
                                            <th rowspan="2">STA Jembatan</th>
                                            <th colspan="2">Volume</th>
                                            <th rowspan="2">Kondisi Jembatan</th>
                                        </tr>
                                        <tr>
                                            <th>Panjang (KM)</th>
                                            <th>Lebar (M)</th>
                                            <th>Bentang (M)</th>
                                            <th>Lebar (M)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key = $key + 1 }}</td>
                                                <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                                                <td>{{ $item->no_jembatan }}</td>
                                                <td>{{ $item->no_ruas_jalan }} Km</td>
                                                <td>{{ $item->vol_panjang_m }} Km</td>
                                                <td>{{ $item->vol_lebar_m }} m<sup>2</sup></td>
                                                <td>{{ $item->sta_jembatan }}</td>
                                                <td>{{ $item->vol_bentang }} m</td>
                                                <td>{{ $item->vol_leb }} m</td>
                                                <td>
                                                    @if ($item->kondisi_b=="x")
                                                        Baik
                                                    @elseif ($item->kondisi_s=="x")
                                                        Sedang
                                                    @elseif ($item->kondisi_r=="x")
                                                        Rusak
                                                    @elseif ($item->kondisi_rb=="x")
                                                        Rusak Berat
                                                    @else
                                                        -
                                                    @endif
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