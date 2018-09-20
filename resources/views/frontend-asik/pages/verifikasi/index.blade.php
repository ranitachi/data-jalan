@extends('frontend.layouts.pages')
@section('title')
    <title>Gebrak-Pakumis : Kabupaten Tangerang</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    
    <style>
        .red {
            font-size:11px;
            background: #d9534f;
        }

        .orange {
            font-size:11px;
            background: #f0ad4e;
        }

        .green {
            font-size:11px;
            background: #5cb85c;
        }

        .modal-open-hasil {
            cursor: pointer;
        }

        .modal-open-dokumentasi {
            cursor: pointer;
        }

        .text-left {
            text-align: left !important;
        }
    </style>
@endsection

@section('konten')
    <!--section -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Hasil Verifikasi Survey Rumah Kumuh</h2>
                <div class="section-subtitle">Gebrak Pakumis</div>
                <span class="section-separator"></span>
                <p>Berdasarkan data yang telah masuk dalam sistem..</p>
            </div>
            <div class="row home-posts">
                <div class="col-md-12" style="text-align:left;">
                    <br>
                    <table id="user-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:15px;">BNBA</th>
                                <th>Enumerator</th>
                                <th>Tanggal Verifikasi</th>
                                <th>Penerima</th>
                                <th>Alamat</th>
                                <th>Hasil Verifikasi</th>
                                <th>Dokumentasi Foto</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

@endsection


@section('modal')
    {{-- modal hasil --}}
    <div class="main-register-wrap modal-hasil">
        <div class="main-overlay"></div>
        <div class="main-register-holder" style="max-width:700px;">
            <div class="main-register fl-wrap" style="width:700px;">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Detail Hasil Verifikasi</h3>
                <div style="padding:10px;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:40px;"><strong>#</strong></th>
                                <th><strong>Parameter</strong></th>
                                <th><strong>Hasil</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">1</td>
                                <td class="text-left">Jenis Atap</td>
                                <td class="text-left" id="jenis_atap"></td>
                            </tr>
                            <tr>
                                <td class="text-left">2</td>
                                <td class="text-left">Kondisi Atap</td>
                                <td class="text-left" id="kondisi_atap"></td>
                            </tr>
                            <tr>
                                <td class="text-left">3</td>
                                <td class="text-left">Jenis Bangunan</td>
                                <td class="text-left" id="jenis_bangunan"></td>
                            </tr>
                            <tr>
                                <td class="text-left">4</td>
                                <td class="text-left">Kondisi Bangunan</td>
                                <td class="text-left" id="kondisi_bangunan"></td>
                            </tr>
                            <tr>
                                <td class="text-left">5</td>
                                <td class="text-left">Jenis Dinding</td>
                                <td class="text-left" id="jenis_dinding"></td>
                            </tr>
                            <tr>
                                <td class="text-left">6</td>
                                <td class="text-left">Kondisi Dinding</td>
                                <td class="text-left" id="kondisi_dinding"></td>
                            </tr>
                            <tr>
                                <td class="text-left">7</td>
                                <td class="text-left">Jenis Kakus</td>
                                <td class="text-left" id="jenis_kakus"></td>
                            </tr>
                            <tr>
                                <td class="text-left">8</td>
                                <td class="text-left">Kondisi Kakus</td>
                                <td class="text-left" id="kondisi_kakus"></td>
                            </tr>
                            <tr>
                                <td class="text-left">9</td>
                                <td class="text-left">Luas Lahan</td>
                                <td class="text-left" id="luas_lahan"></td>
                            </tr>
                            <tr>
                                <td class="text-left">10</td>
                                <td class="text-left">Status Lahan</td>
                                <td class="text-left" id="status_lahan"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-default close-modal">Tutup</a>
            </div>
        </div>
    </div>

    {{-- modal dokumentasi --}}
    <div class="main-register-wrap modal-dokumentasi">
        <div class="main-overlay"></div>
        <div class="main-register-holder" style="max-width:700px;">
            <div class="main-register fl-wrap" style="width:700px;">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Detail Dokumentasi Foto</h3>
                <div style="padding:10px;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:40px;"><strong>#</strong></th>
                                <th><strong>Deskripsi</strong></th>
                                <th><strong>Foto</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">1</td>
                                <td class="text-left">Foto Rumah</td>
                                <td class="text-left" id="foto_rumah"></td>
                            </tr>
                            <tr>
                                <td class="text-left">2</td>
                                <td class="text-left">Foto Bangunan (1)</td>
                                <td class="text-left" id="foto_bangunan_1"></td>
                            </tr>
                            <tr>
                                <td class="text-left">3</td>
                                <td class="text-left">Foto Bangunan (2)</td>
                                <td class="text-left" id="foto_bangunan_2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-default close-modal">Tutup</a>
            </div>
        </div>
    </div>

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

@section('footscript')
    <script src="{{ asset('theme') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('theme') }}/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            $('#user-table').DataTable();
            populateTable()
        });

        // show modal kegiatan and bind the data
        $('#user-table').on('click', '.modal-open-hasil', function(e){
            e.preventDefault()
            $('.modal-hasil').fadeIn()
            $("html, body").addClass("hid-body")

            var id = $(this).data('value')
            $.ajax({
                url: "{{ url('api/verified-api') }}/"+id,
                success: function(res){
                    $('#jenis_atap').html(res.data.jenis_atap)
                    $('#kondisi_atap').html(res.data.kondisi_atap)
                    $('#jenis_bangunan').html(res.data.jenis_bangunan)
                    $('#kondisi_bangunan').html(res.data.kondisi_bangunan)
                    $('#jenis_dinding').html(res.data.jenis_dinding)
                    $('#kondisi_dinding').html(res.data.kondisi_dinding)
                    $('#jenis_kakus').html(res.data.jenis_kakus)
                    $('#kondisi_kakus').html("-")
                    $('#luas_lahan').html(res.data.luas_lahan + " m<sup>2</sup>")
                    $('#status_lahan').html(res.data.status_lahan)
                }
            })
        })

        // show modal dokumentasi and bind the data
        $('#user-table').on('click', '.modal-open-dokumentasi', function(e){
            e.preventDefault()
            $('.modal-dokumentasi').fadeIn()
            $("html, body").addClass("hid-body")

            var id = $(this).data('value')

            $.ajax({
                url: "{{ url('api/verified-api') }}/"+id,
                success: function(res){
                    $('#foto_rumah').html("<img src='"+res.data.foto_rumah+"?h=100'>")
                    $('#foto_bangunan_1').html("<img src='"+res.data.foto_fisik_bangunan_1+"?h=100'>")
                    $('#foto_bangunan_2').html("<img src='"+res.data.foto_fisik_bangunan_2+"?h=100'>")
                }
            })
        })

        // show confirmation modal delete
        $('#user-table').on('click', '.modal-open-delete', function(e){
            e.preventDefault();
            $('.modal-delete').fadeIn();
            $("html, body").addClass("hid-body");

            var id = $(this).data('value')
            $('#btn-delete').attr('href', "{{ url('verifikasi') }}/"+id+"/delete")
        })

        // populate table funciton
        function populateTable() {
            var no = 1;
            $.ajax({
                url: "{{ url('api/verified-api') }}" ,
                success: function(res) {
                    $('#user-table').dataTable({
                        "aaData": res.data,
                        "bDestroy": true,
                        "columns": [
                            { "data" : "no_bnba" },
                            { "data" : "enumerator" },
                            { "data" : "tanggal_submit" },
                            { "data" : "usulan.penerima" },
                            { "data" : "usulan.alamat" },
                            { "data" : "id" },
                            { "data" : "id" },
                        ],
                        "columnDefs": [ {
                            "targets"   : 5,
                            "render"    : function (item) {
                                return "<a class='modal-open-hasil' data-value='"+ item +"'><i>Lihat Detail</i></a>"
                            }
                        }, {
                            "targets"   : 6,
                            "render"    : function (item) {
                                return "<a class='modal-open-dokumentasi' data-value='"+ item +"'><i>Lihat Detail</i></a>"
                            }
                        } ]
                    })
                }   
            })
        }

        // show confirmation modal add
        $(".modal-open-cp").on('click', function(e){
            e.preventDefault();
            $('.modal-change-password').fadeIn();
            $("html, body").addClass("hid-body");
        })

        // all modal close
        $('.close-modal').on("click", function () {
            $('.modal-delete').fadeOut();
            $('.modal-add').fadeOut();
            $('.modal-edit').fadeOut();
            $('.modal-change-password').fadeOut();
            $('.modal-hasil').fadeOut();
            $('.modal-dokumentasi').fadeOut();
        });

        $('#btn-change-password').click(function(){
            var id_user = $('#id_user').val()
            var old_pass = $('#old_pass').val()
            var new_pass = $('#new_pass').val()
            var confirm_new_pass = $('#confirm_new_pass').val()

            $.ajax({
                url: "{{ url('api/change-password') }}",
                type: "POST",
                dataType: "json",
                data: {
                    id_user: id_user,
                    old_pass: old_pass,
                    new_pass: new_pass,
                    new_pass_confirmation: confirm_new_pass,
                },
                success: function(res) {
                    $('#for-alert-change-password').html(
                        "<div class='alert alert-success alert-style'>" +
                            "<strong>Ou yeah,</strong> " + res.message +
                        "</div>"
                    )

                    closeAlert()
                }
            }).fail(function(err){
                $('#for-alert-change-password').html(
                    "<div class='alert alert-danger alert-style'>" +
                        "<strong>Oops,</strong> terjadi kesalahan." +
                    "</div>"
                )

                closeAlert()
            })
        })

        // close the alert
        function closeAlert() {
            setTimeout(function() {
                $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });

                $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 3000);
        }
    </script>
@endsection