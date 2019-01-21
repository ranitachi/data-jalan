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
            <li class="item"> Data Situ </li>
        </ul>
        <h1 class="top-title-t">Data Situ</h1> 
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
                                            <th rowspan="2">Nama Situ</th>
                                            <th rowspan="2">DAS</th>
                                            <th colspan="2">Luas</th>
                                            <th colspan="3">Pengelolaan</th>
                                            <th rowspan="2">Kondisi</th>
                                        </tr>
                                        <tr>
                                            <th>Asal</th>
                                            <th>Sekarang</th>
                                            <th>Pusat</th>
                                            <th>Provinsi</th>
                                            <th>Kabupaten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key = $key + 1 }}</td>
                                                <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                                                <td>{{ $item->nama_situ }}</td>
                                                <td>{{ $item->das }}</td>
                                                <td>{{ !is_null($item->luas_asal) ? $item->luas_asal." Ha" : '-' }}</td>
                                                <td>{{ !is_null($item->luas_sekarang) ? $item->luas_sekarang." Ha" : '-' }}</td>
                                                <td>
                                                    @if ($item->pengelolaan_pusat==0)
                                                        -
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->pengelolaan_provinsi==0)
                                                        -
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->pengelolaan_kabupaten==0)
                                                        -
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $item->kondisi }}</td>
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