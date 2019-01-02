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
                            <th rowspan="2">Kondisi Jalan</th>
                            <th rowspan="2">Keterangan</th>
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
                                <td class="text-center">
                                    <a href="javascript:lihatkondisi({{$item->id}})" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>    
                                </td>
                                
                                @php
                                    if ($item->keterangan=='PR')
                                        $label='label label-warning';
                                    elseif($item->keterangan=='PKT')
                                        $label='label label-info';
                                    elseif($item->keterangan=='REHAB')
                                        $label='label label-lightblue';
                                    elseif($item->keterangan=='PP')
                                        $label='label label-success';
                                    elseif($data->keterangan=='Pemb')
                                        $label='label label-danger';
                                @endphp

                                <td class="text-center"><span class="{{$label}}">{{ $item->keterangan }}</span></td>
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
    <div class="main-register-wrap modal-kondisi">
        <div class="main-overlay"></div>
        <div class="main-register-holder" style="max-width:700px !important">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Detail Kondisi Jalan</h3>
                <div id="kondisi" style='padding:10px;'></div>
                <a class="btn btn-default close-modal">Tutup</a>
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
        $('.close-modal').on("click", function () {
            $('.modal-delete').fadeOut();
            $('.modal-kondisi').fadeOut();
        });
        function lihatkondisi(id)
        {
            $('#kondisi').load('{{url("data-jalan-kondisi")}}/'+id);
            $('.modal-kondisi').fadeIn();
        }
    </script>
<style>
.btn i {
    padding-left: unset !important;
}
.pagination>li>a, .pagination>li>span
{
    padding:12px !important;
}
li.previous, li.next
{
    text-align:center !important;
}
.font100
{
    font-weight: 400;
    font-size: 100% !important;
}
.bottom-10
{
    padding-bottom:10px;
}
#kondisi-table th{
    background-color: #4DB7FE !important;
    color:white;
    font-weight: 550;
}
#kondisi-table td{
    font-weight: 600;
}
.label-lightblue
{
    background:lightblue;
}
</style>
@endsection