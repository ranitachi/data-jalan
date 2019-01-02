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

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Data Sungai</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Sungai</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Form Data Sungai</h3>
                </div>
                <div style="float:right;width:100px;margin-right:30px;">
                    <a href="{{route('all-sungai.index')}}" class="btn btn-success btn-sm"><< Kembali Ke Data</a>
                </div>
            </div>
            <div class="col-md-12 table-responsive" style="text-align:left;">
                <br>
                <div class="profile-edit-container">
                        <form action="{{ route('all-sungai.store') }}" method="post" id="simpan-sungai">
                            @csrf
                            <div class="custom-form" style="padding-bottom:10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kecamatan <i class="fa fa-user-o"></i></label>
                                        <select name="id_kecamatan" id="id_kecamatan" class="chosen-select" required="required">
                                            <option selected value="-1">-- Kecamatan --</option>
                                            @foreach ($kecamatan as $item)
                                                <option value="{{ $item->id }}-{{$item->nama_kecamatan}}">{{ $item->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Nama Sungai <i class="fa fa-list"></i>  </label>
                                        <input type="text" name="nama_sungai" id="nama_sungai" required="required">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Luas Areal (Ha) <i class="fa fa-list"></i>  </label>
                                        <input type="text" name="areal" id="areal" required="required">
                                    </div>
                                </div>
                                <input type="hidden" name="id_user" id="user_id" value="{{Auth::user()->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Panjang Sungai Primer (m)  <i class="fa fa-list"></i></label>
                                        <input type="text" name="panjang_sungai_primer" id="panjang_sungai_primer">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Panjang Sungai Sekunder (m)  <i class="fa fa-list"></i></label>
                                        <input type="text" name="panjang_sungai_sekunder" id="panjang_sungai_sekunder">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Panjang Sungai Tersier (m)  <i class="fa fa-list"></i></label>
                                        <input type="text" name="panjang_sungai_tersier" id="panjang_sungai_tersier">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Bangunan Pelengkap Box Tersier (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="bangunan_terlengkap_box_tersier" id="bangunan_terlengkap_box_tersier">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bangunan Pelengkap Gorong-Gorong (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="bangunan_terlengkap_box_gorong" id="bangunan_terlengkap_box_gorong">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Bagunan Pelengkap Jembatan (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="bangunan_terlengkap_box_jembatan" id="bangunan_terlengkap_box_jembatan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Saluran Pasangan (m) <i class="fa fa-list"></i></label>
                                        <input type="text" name="saluran_bendung" id="saluran_bendung">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Saluran Tanah (m) <i class="fa fa-list"></i></label>
                                        <input type="text" name="saluran_tanah" id="saluran_tanah">
                                    </div>
                                </div>
                                <legend>
                                    Bangunan Sudah Di Bangun
                                </legend>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Bendung  (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_bendung" id="sudah_dibangun_bendung">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Pintu Air  (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_pintu_air" id="sudah_dibangun_pintu_air">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Bagi Sadap  <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_bagi_sadap" id="sudah_dibangun_bagi_sadap">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Box Tersier  (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_box_tersier" id="sudah_dibangun_box_tersier">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Gorong-Gorong (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_gorong" id="sudah_dibangun_gorong">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Jembatan (Bh) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_jembatan" id="sudah_dibangun_jembatan">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Saluran Pasangan (m) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_pasangan" id="sudah_dibangun_pasangan">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Saluran Tanah (m) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sudah_dibangun_tanah" id="sudah_dibangun_tanah">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Sisa Pekerjaan (m) <i class="fa fa-list"></i></label>
                                        <input type="text" name="sisa" id="sisa">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Kategori <i class="fa fa-user-o"></i></label>
                                        <select name="jenis" id="jenis" class="chosen-select">
                                            <option selected value="-1">-- Kategori --</option>
                                            <option value="pembuang">Pembuang</option>
                                            <option value="sungai">Sungai</option>
                                            <option value="kali/drainase">Kali / Drainase</option>
                                            
                                        </select>
                                    
                                    </div>
                                </div>
                                {{-- <div class="row">    
                                    <div class="col-md-6">
                                        <label>Status <i class="fa fa-user-o"></i></label>
                                        <select name="flag" id="flag" class="chosen-select">
                                            <option selected value="-1">-- Status Berita --</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                            
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <label>Keterangan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" name="keterangan" id="keterangan"></textarea>
                                    </div>
                                </div>
                                <button class="btn big-btn color-bg flat-btn pull-right" type="submit" id="simpan">Save Changes &nbsp;<i class="fa fa-save"></i></button>
                                

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
<style>
.btn i {
    padding-left: unset !important;
}
.pagination>li>a, .pagination>li>span
{
    padding:12px !important;
}
li.previous, li.next
{
    text-align:center !important;
}
.font100
{
    font-weight: 400;
    font-size: 100% !important;
}
</style>
@endsection