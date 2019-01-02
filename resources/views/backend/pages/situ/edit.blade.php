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
        <h2>Manajemen Data Situ</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Situ</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Formulir Edit Data Situ</h3>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ route('all-situ.update', $data->id) }}" method="post">
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

                                <label>Nama Situ<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="nama_situ" value="{{ $data->nama_situ }}">

                                <label>DAS<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="das" value="{{ $data->das }}">

                                <label>Luas Asal<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="luas_asal" value="{{ $data->luas_asal }}">

                                <label>Luas Sekarang<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="luas_sekarang" value="{{ $data->luas_sekarang }}">

                                <label>Pengelolaan Pusat<i class="fa fa-arrow-right"></i>  </label>
                                <select name="pengelolaan_pusat" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ $data->pengelolaan_pusat==1 ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ $data->pengelolaan_pusat==0 ? 'selected' : '' }}>Tidak</option>
                                </select>

                                <label>Pengelolaan Provinsi<i class="fa fa-arrow-right"></i>  </label>
                                <select name="pengelolaan_provinsi" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ $data->pengelolaan_provinsi==1 ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ $data->pengelolaan_provinsi==0 ? 'selected' : '' }}>Tidak</option>
                                </select>

                                <label>Pengelolaan Kabupaten<i class="fa fa-arrow-right"></i>  </label>
                                <select name="pengelolaan_kabupaten" class="chosen-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="1" {{ $data->pengelolaan_kabupaten==1 ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ $data->pengelolaan_kabupaten==0 ? 'selected' : '' }}>Tidak</option>
                                </select>

                                <label>Kondisi<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="kondisi" value="{{ $data->kondisi }}">

                                <label>Keterangan<i class="fa fa-arrow-right"></i>  </label>
                                <input type="text" name="keterangan" value="{{ $data->keterangan }}">

                                <input type="submit" class="btn big-btn color-bg flat-btn" style="margin:20px 0;" value="Simpan Data">
                            </div>
                        </form>
                    </div>
                <br>
            </div>
        </div>
    </div>
@endsection