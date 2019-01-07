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
            <li class="item"> Data Irigasi </li>
        </ul>
        <h1 class="top-title-t">Data Irigasi</h1> 
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
                                            <th rowspan="2">Daerah Irigasi</th>
                                            <th rowspan="2">Areal</th>
                                            <th colspan="3">Panjang Saluran</th>
                                            <th colspan="3">Bangunan Utama</th>
                                            <th colspan="3">Bangunan Pelengkap</th>
                                            <th rowspan="2">Sumber Air</th>
                                        </tr>
                                        <tr>
                                            <th>Primer</th>
                                            <th>Sekunder</th>
                                            <th>Tersier</th>
                                            <th>Gedung</th>
                                            <th>Pintu Air</th>
                                            <th>Intake</th>
                                            <th>Box Tersier</th>
                                            <th>Pelengkap Gorong</th>
                                            <th>Pelengkap Jembatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key = $key + 1 }}</td>
                                                <td>{{ $item->id_kecamatan }}</td>
                                                <td>{{ $item->daerah_irigasi }}</td>
                                                <td>{{ $item->areal }} Ha</td>
                                                <td>{{ !is_null($item->panjang_saluran_primer) ? $item->panjang_saluran_primer : '0' }} m</td>
                                                <td>{{ $item->panjang_saluran_sekunder }} m</td>
                                                <td>{{ !is_null($item->panjang_saluran_tersier) ? $item->panjang_saluran_tersier : '0' }} m</td>
                                                <td>{{ $item->bangunan_utama_gedung }} Bh</td>
                                                <td>{{ $item->bangunan_utama_pintu_air }} Bh</td>
                                                <td>{{ $item->bangunan_utama_intake }} Bh</td>
                                                <td>{{ $item->pelengkap_box_tersier }} Bh</td>
                                                <td>{{ $item->pelengkap_gorong }} Bh</td>
                                                <td>{{ $item->pelengkap_jembatan }} Bh</td>
                                                <td>{{ $item->sumber_air }}</td>
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