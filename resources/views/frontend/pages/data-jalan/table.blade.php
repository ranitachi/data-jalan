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
            <li class="item"> Data Ruas Jalan </li>
        </ul>
        <h1 class="top-title-t">Data Ruas Jalan</h1> 
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
                                        <th rowspan="2">Nama Jalan</th>
                                        <th rowspan="2">Vol Panjang</th>
                                        <th rowspan="2">Vol Lebar</th>
                                        <th rowspan="2">Luas Jalan</th>
                                        <th colspan="3">Tipe Konstruksi</th>
                                        <th rowspan="2">Persentase Kerusakan</th>
                                        <th rowspan="2">Keterangan</th>
                                    </tr>
                                    <tr>
                                        <th>Beton</th>
                                        <th>Aspan</th>
                                        <th>Lain<sup>2</sup></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $key = $key + 1 }}</td>
                                            <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                                            <td>{{ $item->nama_jalan }}</td>
                                            <td>{{ $item->vol_panjang_km }} Km</td>
                                            <td>{{ $item->vol_lebar_m }} m</td>
                                            <td>{{ $item->luas_jalan_m_2 }} m<sup>2</sup></td>
                                            <td>{{ $item->type_kons_beton }} Km</td>
                                            <td>{{ $item->type_kons_aspal }} Km</td>
                                            <td>{{ $item->type_kons_dll }} Km</td>
                                            <td>
                                                @if ($item->kondisi_jalan[0]->persentase_rusak==0)
                                                    <span style="color:green;"><i>Tidak ada kerusakan</i></span>
                                                @else
                                                    {{ $item->kondisi_jalan[0]->persentase_rusak }} %
                                                @endif
                                            </td>
                                            
                                            @php
                                                if ($item->keterangan=='PR')
                                                    $label='label label-warning';
                                                elseif($item->keterangan=='PKT')
                                                    $label='label label-info';
                                                elseif($item->keterangan=='REHAB')
                                                    $label='label label-lightblue';
                                                elseif($item->keterangan=='PP')
                                                    $label='label label-success';
                                                elseif($data->keterangan=='Pemb')
                                                    $label='label label-danger';
                                            @endphp

                                            <td class="text-center"><span class="{{$label}}">{{ $item->keterangan }}</span></td>
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