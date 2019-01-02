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
        <h2>Manajemen Data Sungai</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <span>Manajemen Data Sungai</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <div class="box-title">
                    <h3>Data Sungai</h3>
                </div>
                <div style="float:right;width:100px;">
                    <a href="{{route('all-sungai.create')}}" class="btn btn-info btn-sm">+ Tambah Data</a>
                </div>
                 <div style="float:right;width:100px;margin-right:20px;">
                    <a href="{{ url('download-file/sungai') }}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Download XLS</a>
                </div>
            </div>
            <div class="col-md-12 table-responsive" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:15px;">#</th>
                            <th rowspan="2">Nama Sungai</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">Areal (Ha)</th>
                            <th colspan="3">Panjang Sungai</th>
                            <th rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Primer</th>
                            <th>Sekunder</th>
                            <th>Tersier</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key = $key + 1 }}</td>
                                <td>{{ $item->nama_sungai }}</td>
                                <td>{{ $item->kecamatan }}</td>
                                <td class="text-center"><span class="label font100 label-info">{{ number_format($item->areal,0,',','.') }}</span></td>
                                <td style="width:130px">
                                    <span class="label font100 label-success">{{number_format($item->panjang_sungai_primer,0,',','.')}} m</span>
                                </td>
                                <td style="width:130px">    
                                    <span class="label font100 label-warning">{{number_format($item->panjang_sungai_sekunder,0,',','.')}} m</span>
                                </td>
                                <td style="width:130px">    
                                    <span class="label font100 label-info">{{number_format($item->panjang_sungai_tersier,0,',','.')}} m</span>
                                </td>
                                
                                <td>
                                    <a href="{{route('all-sungai.edit',$item->id)}}" class="btn btn-xs btn-warning" ><i class="fa fa-edit"></i></a>
                                    <a class='btn btn-xs btn-danger modal-open-delete' data-value="{{$item->id}}"><i class="fa fa-trash"></i></a>
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
            $('#btn-delete').data('value', id)
        })

        // delete data
        $("#btn-delete").on('click', function(){
            var id = $(this).data('value')
            
            location.href='{{url("all-sungai/delete")}}/'+id;
        })
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