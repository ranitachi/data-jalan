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
        <h2>Manajemen Data Jalan</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Jalan</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Edit Data Jalan</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('all-data-jalan.update', $data->id) }}" method="post" enctype="multipart/form-data">
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

                                <label>Nomor Ruas<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="no_ruas" value="{{ $data->no_ruas }}">

                                <label>Nama Jalan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="nama_jalan" value="{{ $data->nama_jalan }}">

                                <label>Volume Panjang (KM)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_panjang_km" value="{{ $data->vol_panjang_km }}">

                                <label>Volume Lebar (M)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="vol_lebar_m" value="{{ $data->vol_lebar_m }}">

                                <label>Luas Jalan (M<sup>2</sup>)<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="luas_jalan_m_2" value="{{ $data->luas_jalan_m_2 }}">

                                <label>Konstruksi Beton<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="type_kons_beton" value="{{ $data->type_kons_beton }}">

                                <label>Konstruksi Aspal<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="type_kons_aspal" value="{{ $data->type_kons_aspal }}">

                                <label>Konstruksi Lainnya<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="type_kons_dll" value="{{ $data->type_kons_dll }}">

                                <label>Keterangan<i class="fa fa-arrow-right"></i>  </label>
                                <select name="keterangan" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="PR" {{ $data->keterangan=="PR" ? 'selected' : '' }}>PR</option>
                                    <option value="PKT" {{ $data->keterangan=="PKT" ? 'selected' : '' }}>PKT</option>
                                    <option value="REHAB" {{ $data->keterangan=="REHAB" ? 'selected' : '' }}>REHAB</option>
                                    <option value="PP" {{ $data->keterangan=="PP" ? 'selected' : '' }}>PP</option>
                                </select>

                                <legend>
                                    Kondisi Jalan
                                </legend>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Baik</td>
                                            <td>Sedang</td>
                                            <td>Rusak</td>
                                            <td>Rusak Berat</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Beton</td>
                                            <td>
                                                <input type="text" name="kondisi_beton_b" style="padding-left:20px;" value="{{ $beton['baik'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_beton_s" style="padding-left:20px;" value="{{ $beton['sedang'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_beton_r" style="padding-left:20px;" value="{{ $beton['rusak'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_beton_rb" style="padding-left:20px;" value="{{ $beton['rusak_berat'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aspal</td>
                                            <td>
                                                <input type="text" name="kondisi_aspal_b" style="padding-left:20px;" value="{{ $aspal['baik'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_aspal_s" style="padding-left:20px;" value="{{ $aspal['sedang'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_aspal_r" style="padding-left:20px;" value="{{ $aspal['rusak'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_aspal_rb" style="padding-left:20px;" value="{{ $aspal['rusak_berat'] }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lainnya</td>
                                            <td>
                                                <input type="text" name="kondisi_lainnya_b" style="padding-left:20px;" value="{{ $lainnya['baik'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_lainnya_s" style="padding-left:20px;" value="{{ $lainnya['sedang'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_lainnya_r" style="padding-left:20px;" value="{{ $lainnya['rusak'] }}">
                                            </td>
                                            <td>
                                                <input type="text" name="kondisi_lainnya_rb" style="padding-left:20px;" value="{{ $lainnya['rusak_berat'] }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <label>Persentase Kerusakan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="persentase_rusak" value="{{ $beton['persen'] }}">

                                <legend>
                                    Foto Ruas Jalan <i>(kosongkan jika tidak ingin diganti)</i>
                                </legend>

                                <label>Foto Ruas Jalan 1</i>  </label>
                                <img src="{{ asset('foto/jalan/') }}/{{ $data->foto_1 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
                                <input type="file" name="foto_1" class="form-control">

                                <label>Foto Ruas Jalan 2</i>  </label>
                                <img src="{{ asset('foto/jalan/') }}/{{ $data->foto_2 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
                                <input type="file" name="foto_2" class="form-control">

                                <label>Foto Ruas Jalan 3</label>
                                <img src="{{ asset('foto/jalan/') }}/{{ $data->foto_3 }}" alt="Foto tidak ditemukan." style="height:150px;margin-bottom:10px;">
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