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
        <h2>Manajemen Data Jembatan</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Jembatan</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Edit Data Jembatan</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('all-jembatan.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="custom-form">

                                <label>Kecamatan<i class="fa fa-arrow-right"></i>  </label>
                                <select name="id_kecamatan" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($kecamatan as $item)
                                        @if ($data->id_kecamatan==$item->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama_kecamatan }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <label>Nomor Jembatan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="no_jembatan" value="{{ $data->no_jembatan }}">

                                <label>Nomor Ruas Jalan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="no_ruas_jalan" value="{{ $data->no_ruas_jalan }}">

                                <label>Volume Panjang (KM)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_panjang_m" value="{{ $data->vol_panjang_m }}">

                                <label>Volume Lebar (M)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_lebar_m" value="{{ $data->vol_lebar_m }}">

                                <label>STA Jembatan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="sta_jembatan" value="{{ $data->sta_jembatan }}">

                                <label>Volume Bentang (M)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_bentang" value="{{ $data->vol_bentang }}">

                                <label>Volume Lebar (M)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_leb" value="{{ $data->vol_leb }}">

                                <label>Kondisi<i class="fa fa-arrow-right"></i>  </label>
                                <select name="kondisi" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Baik" {{ $data->kondisi_b=="x" ? 'selected' : '' }}>Baik</option>
                                    <option value="Sedang" {{ $data->kondisi_s=="x" ? 'selected' : '' }}>Sedang</option>
                                    <option value="Rusak" {{ $data->kondisi_r=="x" ? 'selected' : '' }}>Rusak</option>
                                    <option value="Rusak Berat" {{ $data->kondisi_rb=="x" ? 'selected' : '' }}>Rusak Berat</option>
                                </select>

                                <label>Penanganan<i class="fa fa-arrow-right"></i>  </label>
                                <select name="penanganan" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="PR" {{ $data->penanganan=="PR" ? 'selected' : '' }}>PR</option>
                                    <option value="PP" {{ $data->penanganan=="PP" ? 'selected' : '' }}>PP</option>
                                    <option value="PKT" {{ $data->penanganan=="PKT" ? 'selected' : '' }}>PKT</option>
                                    <option value="REHB" {{ $data->penanganan=="REHB" ? 'selected' : '' }}>REHAB</option>
                                    <option value="PEMB" {{ $data->penanganan=="PEMB" ? 'selected' : '' }}>PEMBANGUNAN</option>
                                </select>

                                <legend>
                                    Biaya Penanganan
                                </legend>

                                <label>Volume (m<sup>2</sup>) <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="volume" value="{{ $data->volume }}">

                                <label>Pemeliharaan Runtin <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="biaya_pr" value="{{ $data->biaya_pr }}">

                                <label>Pemeliharaan Periodik <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="biaya_pp" value="{{ $data->biaya_pp }}">

                                <label>Rehabilitasi <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="biaya_rehab" value="{{ $data->biaya_rehab }}">

                                <label>Peningkatan <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="biaya_pkt" value="{{ $data->biaya_pkt }}">

                                <label>Keterangan <i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="keterangan" value="{{ $data->keterangan }}">

                                <legend>
                                    Foto Jembatan <i>(kosongkan jika tidak ingin diganti)</i>
                                </legend>

                                <label>Foto Jembatan 1</i>  </label>
                                <img src="{{ asset('foto/jembatan/') }}/{{ $data->foto_1 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
                                <input type="file" name="foto_1" class="form-control">

                                <label>Foto Jembatan 2</i>  </label>
                                <img src="{{ asset('foto/jembatan/') }}/{{ $data->foto_2 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
                                <input type="file" name="foto_2" class="form-control">

                                <label>Foto Jembatan 3</label>
                                <img src="{{ asset('foto/jembatan/') }}/{{ $data->foto_3 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
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