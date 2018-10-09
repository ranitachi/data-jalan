@extends('backend.layouts.master')

@section('title')
    <title>Sistem Informasi Data Jalan - Admin Dashboard</title>
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
        <h2>Manajemen Data Berita</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Berita</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Data Berita</h3>
                </div>
                <div style="float:right;width:100px;">
                    <a href="{{ route('berita-admin.create') }}" class="btn btn-success btn-sm">+ Tambah Data</a>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:15px;">#</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
            $('#btn-delete').data('value', id)
        })

        // delete data
        $("#btn-delete").on('click', function(){
            var id = $(this).data('value')
            
            $.ajax({
                url: "{{ url('api/berita-management') }}/" + id,
                type: "DELETE",
                dataType: 'json',
                success: function(res){
                    populateTable();
                    
                    $('#for-alert').html(
                        "<div class='alert alert-success alert-style'>" +
                            "<strong>Ou yeah,</strong> " + res.message +
                        "</div>"
                    )

                    closeAlert();
                }
            })
        })

        // populate table funciton
        function populateTable() {
            var no = 1;
            var url_edit='{{url("berita-admin")}}/';
            $.ajax({
                url: "{{ url('api/berita-management') }}" ,
                success: function(res) {
                    $('#user-table').dataTable({
                        "aaData": res.data,
                        "bDestroy": true,
                        "columns": [
                            { "data" : "id" },
                            { "data" : "cat_berita.nama_kategori" },
                            { "data" : "title" },
                            { "data" : "desc" },
                            { "data" : "flag" }
                           
                        ],
                        "columnDefs": [ {
                            "targets"   : 0,
                            "render"    : function () {
                                return no++;
                            }
                        },{
                            "targets"   : 5,
                            "data"      : "id",
                            "render"    : function (item) {
                                return  "<a class='btn btn-xs btn-warning' href='"+ url_edit+item +"/edit'>" +
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