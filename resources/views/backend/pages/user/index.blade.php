@extends('backend.layouts.master')

@section('title')
    <title>Sistem Informasi Data Jalan - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
@endsection

@section('content-head')
    <div id="for-alert"></div>

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Pengguna</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Pengguna</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Data Pengguna Sistem</h3>
                </div>
                <div style="float:right;width:100px;">
                    <button class="btn btn-success btn-sm modal-open-add">+ Tambah Data</button>
                </div>
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width:15px;">#</th>
                            <th>Nama</th>
                            <th>Email</th>
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

    {{-- modal add --}}
    <div class="main-register-wrap modal-add">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Input Pengguna Baru</h3>
                <div id="tabs-container" style="font-size:12px;margin-top:0px;">
                    <div class="custom-form">
                        <form method="post" name="registerform">
                            <label style="padding-bottom:0px;">Nama * </label>
                            <input type="text" style="margin-bottom:10px;" id="add_name">
                            <label style="padding-bottom:0px;">Email * </label>
                            <input type="email" style="margin-bottom:10px;" id="add_email">
                            <label style="padding-bottom:0px;">Password * </label>
                            <input type="password" style="margin-bottom:10px;" id="add_password">
                            <label style="padding-bottom:0px;">Konfirmasi Password * </label>
                            <input type="password" style="margin-bottom:10px;" id="add_password_confirmation">
                        </form>
                    </div>
                </div>
                <a class="btn btn-success close-modal" id="btn-add">Simpan</a>
            </div>
        </div>
    </div>

    {{-- modal add --}}
    <div class="main-register-wrap modal-edit">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Edit Data Pengguna</h3>
                <div id="tabs-container" style="font-size:12px;margin-top:0px;">
                    <div class="custom-form">
                        <form method="post" name="registerform">
                            <label style="padding-bottom:0px;">Nama * </label>
                            <input type="text" style="margin-bottom:10px;" id="edit_name">
                        </form>
                    </div>
                </div>
                <a class="btn btn-success close-modal" id="btn-update">Simpan Perubahan</a>
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

        // show confirmation modal add
        $(".modal-open-add").on('click', function(e){
            e.preventDefault();
            $('.modal-add').fadeIn();
            $("html, body").addClass("hid-body");
        })

        // show modal edit
        $('#user-table').on('click', '.modal-open-edit', function(e){
            e.preventDefault();
            $('.modal-edit').fadeIn();
            $("html, body").addClass("hid-body");

            var id = $(this).data('value')            
            $('#btn-update').data('value', id)

            $.ajax({
                url: "{{ url('api/user-management') }}/" + id,
                success: function(res) {
                    $('#edit_name').val(res.data.name)
                }
            })
        })

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
                url: "{{ url('api/user-management') }}/" + id,
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

        // execute add new data
        $("#btn-add").click(function(){
            var name = $('#add_name').val()
            var email = $('#add_email').val()
            var password = $('#add_password').val()
            var password_confirmation = $('#add_password_confirmation').val()

            $.ajax({
                url: "{{ url('api/user-management') }}",
                type: "POST",
                dataType: "json",
                data : {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: password_confirmation,
                },
                success: function(res) {
                    populateTable();
                    
                    $('#for-alert').html(
                        "<div class='alert alert-success alert-style'>" +
                            "<strong>Ou yeah,</strong> " + res.message +
                        "</div>"
                    )

                    closeAlert();
                }
            }).fail(function(err) {
                $('#for-alert').html(
                    "<div class='alert alert-danger alert-style'>" +
                        "<strong>Oops,</strong> terjadi kesalahan." +
                    "</div>"
                )

                closeAlert();
            })
        })

        // execute update data
        $("#btn-update").click(function(){
            var id = $(this).data('value')
            var name = $('#edit_name').val()

            $.ajax({
                url: "{{ url('api/user-management') }}/" + id,
                type: "PATCH",
                dataType: "json",
                data : {
                    name: name
                },
                success: function(res) {
                    populateTable();
                    
                    $('#for-alert').html(
                        "<div class='alert alert-success alert-style'>" +
                            "<strong>Ou yeah,</strong> " + res.message +
                        "</div>"
                    )

                    closeAlert();
                }
            }).fail(function(err) {
                $('#for-alert').html(
                    "<div class='alert alert-danger alert-style'>" +
                        "<strong>Oops,</strong> terjadi kesalahan." +
                    "</div>"
                )

                closeAlert();
            })
        })

        // populate table funciton
        function populateTable() {
            var no = 1;
            $.ajax({
                url: "{{ url('api/user-management') }}" ,
                success: function(res) {
                    $('#user-table').dataTable({
                        "aaData": res.data,
                        "bDestroy": true,
                        "columns": [
                            { "data" : "id" },
                            { "data" : "name" },
                            { "data" : "email" }
                        ],
                        "columnDefs": [ {
                            "targets"   : 0,
                            "render"    : function () {
                                return no++;
                            }
                        }, {
                            "targets"   : 3,
                            "data"      : "id",
                            "render"    : function (item) {
                                return  "<a class='btn btn-xs btn-warning modal-open-edit' data-value='"+ item +"'>" +
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