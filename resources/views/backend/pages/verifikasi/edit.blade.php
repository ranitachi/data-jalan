@extends('backend.layouts.master')

@section('title')
    <title>ASIK - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
    <style>
        .fa {
            margin-top: 5px;
        }

        .big-btn {
            margin-top: 10px !important;
            margin-bottom: 20px;
        }

        .big-btn:hover {
            color: #fff;
        }
    </style>
@endsection

@section('content-head')
    <div id="for-alert"></div>

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Data Verifikasi</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('usulan.index') }}">Manajemen Data Verifikasi</a>
            <span>Form Edit Verifikasi</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Edit Verifikasi</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('verifikasi.update', $data->id) }}" method="post">
                            @method('put')
                            @csrf
                            <div class="custom-form">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <label>Nomor BNBA<i class="fa fa-list"></i>  </label>
                                <input type="text" name="no_bnba" value="{{ $data->no_bnba }}" readonly>
                                <label>Penerima<i class="fa fa-user"></i>  </label>
                                <input type="text" name="penerima" value="{{ $data->usulan->penerima }}" readonly>
                                <label>Alamat Penerima<i class="fa fa-user"></i>  </label>
                                <input type="text" name="penerima" value="{{ $data->usulan->alamat }}" readonly>
                                <label>Enumerator<i class="fa fa-user"></i>  </label>
                                <input type="text" name="enumerator" value="{{ $data->enumerator }}">
                                <label>Tanggal Verifikasi<i class="fa fa-user"></i>  </label>
                                <input type="text" name="tanggal_submit" placeholder="YYYY-MM-DD" value="{{ $data->tanggal_submit }}">
                                <label>Jenis Atap<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_atap" value="{{ $data->jenis_atap }}">
                                <label>Kondisi Atap<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_atap" value="{{ $data->kondisi_atap }}">
                                <label>Jenis Bangunan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_bangunan" value="{{ $data->jenis_bangunan }}">
                                <label>Kondisi Bangunan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_bangunan" value="{{ $data->kondisi_bangunan }}">
                                <label>Jenis Dinding<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_dinding" value="{{ $data->jenis_dinding }}">
                                <label>Kondisi Dinding<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_dinding" value="{{ $data->kondisi_dinding }}">
                                <label>Jenis Kakus<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_kakus" value="{{ $data->jenis_kakus }}">
                                <label>Kondisi Kakus<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_kakus" value="{{ $data->kondisi_kakus }}">
                                <label>Luas Lahan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="luas_lahan" value="{{ $data->luas_lahan }}">
                                <label>Status Lahan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="status_lahan" value="{{ $data->status_lahan }}">
                                <label>Link Foto Rumah<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_rumah" value="{{ $data->foto_rumah }}">
                                <label>Link Foto Bangunan 1<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_fisik_bangunan_1" value="{{ $data->foto_fisik_bangunan_1 }}">
                                <label>Link Foto Bangunan 2<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_fisik_bangunan_2" value="{{ $data->foto_fisik_bangunan_2 }}">
                                <label>Latitude<i class="fa fa-home"></i>  </label>
                                <input type="text" name="latitude" value="{{ $data->latitude }}">
                                <label>Longtitude<i class="fa fa-home"></i>  </label>
                                <input type="text" name="longtitude" value="{{ $data->longtitude }}">

                                <button class="btn big-btn color-bg flat-btn">Simpan Data<i class="fa fa-angle-right"></i></button>
                            </div>
                        </form>
                    </div>
                <br>
            </div>
        </div>
    </div>
@endsection