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
            <span>Form Verifikasi</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Verifikasi</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('verifikasi.store') }}" method="post">
                            @csrf
                            <div class="custom-form">
                                <label>Nomor BNBA<i class="fa fa-list"></i>  </label>
                                <input type="text" name="no_bnba" id="no_bnba">
                                <label>Penerima<i class="fa fa-user"></i>  </label>
                                <input type="text" name="penerima" readonly id="penerima">
                                <label>Alamat Penerima<i class="fa fa-user"></i>  </label>
                                <input type="text" name="alamat" readonly id="alamat">
                                <label>Enumerator<i class="fa fa-user"></i>  </label>
                                <input type="text" name="enumerator">
                                <label>Tanggal Verifikasi<i class="fa fa-user"></i>  </label>
                                <input type="text" name="tanggal_submit" placeholder="YYYY-MM-DD">
                                <label>Jenis Atap<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_atap">
                                <label>Kondisi Atap<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_atap">
                                <label>Jenis Bangunan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_bangunan">
                                <label>Kondisi Bangunan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_bangunan">
                                <label>Jenis Dinding<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_dinding">
                                <label>Kondisi Dinding<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_dinding">
                                <label>Jenis Kakus<i class="fa fa-home"></i>  </label>
                                <input type="text" name="jenis_kakus">
                                <label>Kondisi Kakus<i class="fa fa-home"></i>  </label>
                                <input type="text" name="kondisi_kakus">
                                <label>Luas Lahan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="luas_lahan">
                                <label>Status Lahan<i class="fa fa-home"></i>  </label>
                                <input type="text" name="status_lahan">
                                <label>Link Foto Rumah<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_rumah">
                                <label>Link Foto Bangunan 1<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_fisik_bangunan_1">
                                <label>Link Foto Bangunan 2<i class="fa fa-home"></i>  </label>
                                <input type="text" name="foto_fisik_bangunan_2">
                                <label>Latitude<i class="fa fa-home"></i>  </label>
                                <input type="text" name="latitude">
                                <label>Longtitude<i class="fa fa-home"></i>  </label>
                                <input type="text" name="longtitude">

                                <button class="btn big-btn color-bg flat-btn">Simpan Data<i class="fa fa-angle-right"></i></button>
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
        $('#no_bnba').change(function(){
            var id = $(this).val()
            $.ajax({
                url: "{{ url('api/usulan-api') }}/"+id,
                success: function(res) {
                    if (res.data==null) {
                        alert('Nomor BNBA tidak terdaftar pada data usulan.')
                        $('#no_bnba').val('').focus()
                        $('#penerima').val('')
                        $('#alamat').val('')
                    } else {
                        $('#penerima').val(res.data.penerima)
                        $('#alamat').val(res.data.alamat)
                    }
                }
            })
        })
    </script>
@endsection