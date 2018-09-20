@extends('backend.layouts.master')

@section('title')
    <title>ASIK - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
@endsection

@section('content-head')
    <div id="for-alert"></div>

    @if (Session::has('message'))
        <div class='alert alert-success alert-style'>
            <strong>Ou yeah,</strong> {{ Session::get('message') }}
        </div>
    @endif

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Data Usulan</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Usulan</span>
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
                <div style="float:right;width:100px;">
                    <a href="{{ route('usulan.create') }}" class="btn btn-success btn-sm">+ Tambah Data</a>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:15px;" rowspan="2">#</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">BNBA</th>
                            <th rowspan="2">Penerima</th>
                            <th rowspan="2">Alamat</th>
                            <th rowspan="2">Kegiatan</th>
                            <th colspan="3">Alokasi Dana</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <td>Rumah</td>
                            <td>WC</td>
                            <td>BOP</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
        $(function() {
            $('#user-table').DataTable();
            populateTable()
        });

        // show confirmation modal delete
        $('#user-table').on('click', '.modal-open-delete', function(e){
            e.preventDefault();
            $('.modal-delete').fadeIn();
            $("html, body").addClass("hid-body");

            var id = $(this).data('value')
            $('#btn-delete').attr('href', "{{ url('usulan') }}/"+id+"/delete")
        })

        // populate table funciton
        function populateTable() {
            var no = 1;
            $.ajax({
                url: "{{ url('api/usulan-api') }}" ,
                success: function(res) {
                    $('#user-table').dataTable({
                        "aaData": res.data,
                        "bDestroy": true,
                        "columns": [
                            { "data" : "id" },
                            { "data" : "kecamatan.nama_kecamatan" },
                            { "data" : "no_bnba" },
                            { "data" : "penerima" },
                            { "data" : "alamat" },
                            { "data" : "jenis_kegiatan" },
                            { "data" : "dana_pk_rumah" },
                            { "data" : "dana_pemb_wc" },
                            { "data" : "dana_bop_keg" },
                        ],
                        "columnDefs": [ {
                            "targets"   : 9,
                            "data"      : "id",
                            "render"    : function (item) {
                                return  "<a class='btn btn-xs btn-warning' href='{{ url('usulan') }}/"+item+"/edit'>" +
                                            "<span class='fa fa-edit'></span>" +
                                        "</a> " +
                                        "<a class='btn btn-xs btn-danger modal-open-delete' data-value='"+ item +"'>" +
                                            "<span class='fa fa-trash'></span>" +
                                        "</a>"
                            }
                        } ]
                    })
                }   
            })
        }
    </script>
@endsection