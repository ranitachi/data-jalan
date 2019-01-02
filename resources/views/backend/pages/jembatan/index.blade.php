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
                    <h3>Data Jembatan</h3>
                </div>
                <div style="float:right;width:100px;">
                    <a href="{{ route('all-jembatan.create') }}" class="btn btn-success btn-sm">+ Tambah Data</a>
                </div>
            </div>
            <div class="col-md-12 table-responsive" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:15px;">#</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">Nomor Jembatan</th>
                            <th rowspan="2">Nomor Ruas Jalan</th>
                            <th colspan="2">Volume</th>
                            <th rowspan="2">STA Jembatan</th>
                            <th colspan="2">Volume</th>
                            <th rowspan="2">Kondisi Jembatan</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Panjang (KM)</th>
                            <th>Lebar (M)</th>
                            <th>Bentang (M)</th>
                            <th>Lebar (M)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                                <td>{{ $item->no_jembatan }}</td>
                                <td>{{ $item->no_ruas_jalan }} Km</td>
                                <td>{{ $item->vol_panjang_m }} Km</td>
                                <td>{{ $item->vol_lebar_m }} m<sup>2</sup></td>
                                <td>{{ $item->sta_jembatan }}</td>
                                <td>{{ $item->vol_bentang }} m</td>
                                <td>{{ $item->vol_leb }} m</td>
                                <td>
                                    @if ($item->kondisi_b=="x")
                                        Baik
                                    @elseif ($item->kondisi_s=="x")
                                        Sedang
                                    @elseif ($item->kondisi_r=="x")
                                        Rusak
                                    @elseif ($item->kondisi_rb=="x")
                                        Rusak Berat
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('all-jembatan.edit', $item->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
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
            $('#btn-delete').attr('href', "{{ url('all-jembatan/delete') }}/" + id);
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