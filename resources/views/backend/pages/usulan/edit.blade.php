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
        <h2>Manajemen Data Usulan</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('usulan.index') }}">Manajemen Data Usulan</a>
            <span>Edit Data Usulan</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Data Usulan</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('usulan.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="custom-form">
                                <label>Kecamatan <i class="fa fa-user-o"></i></label>
                                <select name="id_kecamatan" class="chosen-select">
                                    <option disabled selected>-- Seluruh Kecamatan --</option>
                                    @foreach ($kecamatan as $item)
                                        @if ($data->id_kecamatan==$item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama_kecamatan }}</option>
                                        @endif
                                        <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                                <label>UPK BKAD<i class="fa fa-user-o"></i></label>
                                <select name="id_upk_bkad" class="chosen-select">
                                    <option disabled selected>-- Seluruh UPK BKAD --</option>
                                    @foreach ($upk as $item)
                                        @if ($data->id_upk_bkad==$item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                        @endif
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <label>KPM RT<i class="fa fa-user-o"></i></label>
                                <select name="id_kpm" class="chosen-select">
                                    <option disabled selected>-- Seluruh KPM RT --</option>
                                    @foreach ($kpm as $item)
                                        @if ($data->id_kpm==$item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                        @endif
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                <label>Nomor BNBA<i class="fa fa-list"></i>  </label>
                                <input type="text" name="no_bnba" value="{{ $data->no_bnba }}">
                                <label>Penerima<i class="fa fa-user"></i>  </label>
                                <input type="text" name="penerima" value="{{ $data->penerima }}">
                                <label>Alamat<i class="fa fa-map-marker"></i>  </label>
                                <input type="text" name="alamat" value="{{ $data->alamat }}">
                                <label>Jenis Kegiatan<i class="fa fa-globe"></i>  </label>
                                <input type="text" name="jenis_kegiatan" value="{{ $data->jenis_kegiatan }}">
                                <label>Dana PK Rumah<i class="fa fa-home"></i>  </label>
                                <input type="text" name="dana_pk_rumah" value="{{ $data->dana_pk_rumah }}">
                                <label>Dana Pembangunan WC<i class="fa fa-home"></i>  </label>
                                <input type="text" name="dana_pemb_wc" value="{{ $data->dana_pemb_wc }}">
                                <label>Dana BOP Kegiatan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="dana_bop_keg" value="{{ $data->dana_bop_keg }}">

                                <button class="btn big-btn color-bg flat-btn">Save Changes<i class="fa fa-angle-right"></i></button>
                            </div>
                        </form>
                    </div>
                <br>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{-- modal delete --}}
    <div class="main-register-wrap modal-delete">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Konfirmasi Penghapusan Data</h3>
                <p style="font-size:15px;">Apakah anda yakin akan menghapus data tersebut?</p>
                <a class="btn btn-danger close-modal" id="btn-delete">Ya, saya yakin.</a>
                <a class="btn btn-default close-modal">Tidak</a>
            </div>
        </div>
    </div>
@endsection

@section('foot-script')
    <script>
        
    </script>
@endsection