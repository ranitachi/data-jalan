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
                    <h3>Data Jalanan</h3>
                </div>
                <div style="float:right;width:100px;">
                    <a href="{{ route('all-data-jalan.create') }}" class="btn btn-success btn-sm">+ Tambah Data</a>
                </div>
            </div>
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
                            <th rowspan="2">Aksi</th>
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
                                    <a href="{{ route('all-data-jalan.edit', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-xs btn-danger modal-open-delete" data-value="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    <script src="{{ asset('theme') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('theme') }}/js/dataTables.bootstrap.min.js"></script>
    
    <script>
        $('#user-table').DataTable()
        
        // show confirmation modal delete
        $('#user-table').on('click', '.modal-open-delete', function(e){
            e.preventDefault();
            $('.modal-delete').fadeIn();
            $("html, body").addClass("hid-body");

            var id = $(this).data('value')
            $('#btn-delete').attr('href', "{{ url('all-data-jalan/delete') }}/" + id);
        })

        // delete data
        $("#btn-delete").on('click', function(){
            populateTable();
            
            $('#for-alert').html(
                "<div class='alert alert-success alert-style'>" +
                    "<strong>Ou yeah,</strong> " + res.message +
                "</div>"
            )

            closeAlert();
        })
    </script>
@endsection