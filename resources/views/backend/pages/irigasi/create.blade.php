@extends('backend.layouts.master')

@section('title')
    <title>Sistem Informasi Data Jalan - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
    <style>
        td {
            font-size:12px;
        }
    </style>
@endsection

@section('content-head')
    <div id="for-alert"></div>

    @if (Session::has('message'))
        <div class='alert alert-success alert-style'>
            <strong>Ou yeah,</strong> {{ Session::get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class='alert alert-danger alert-style'>
            <strong>Oops,</strong> Terjadi Kesalahan: <br>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </div>
    @endif
    

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Data Irigasi</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Irigasi</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Input Data Irigasi</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('all-irigasi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="custom-form">

                                <label>Kecamatan<i class="fa fa-arrow-right"></i>  </label>
                                <select name="id_kecamatan" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->nama_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>

                                <label>Daerah Irigasi<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="daerah_irigasi">

                                <label>Areal<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="areal">

                                <label>Panjang Saluran (Primer)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="panjang_saluran_primer">

                                <label>Panjang Saluran (Sekunder)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="panjang_saluran_sekunder">

                                <label>Panjang Saluran (Tersier)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="panjang_saluran_tersier">

                                <label>Bangunan Utama (Gedung)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="bangunan_utama_gedung">

                                <label>Bangunan Utama (Pintu Air)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="bangunan_utama_pintu_air">

                                <label>Bangunan Utama (Intake)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="bangunan_utama_intake">

                                <label>Pelengkap (Box Tersier)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="pelengkap_box_tersier">

                                <label>Pelengkap (Gorong)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="pelengkap_gorong">

                                <label>Pelengkap (Jembatan)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="pelengkap_jembatan">

                                <label>Sumber Air<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="sumber_air">

                                <legend>
                                    Foto Irigasi <i>(opsional)</i>
                                </legend>

                                <label>Foto Irigasi 1</i>  </label>
                                <input type="file" name="foto_1" class="form-control">

                                <label>Foto Irigasi 2</i>  </label>
                                <input type="file" name="foto_2" class="form-control">

                                <label>Foto Irigasi 3</label>
                                <input type="file" name="foto_3" class="form-control">

                                <input type="submit" class="btn big-btn color-bg flat-btn" style="margin:20px 0;" value="Simpan Data">
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