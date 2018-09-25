@extends('backend.layouts.master')

@section('title')
    <title>Sistem Informasi Data Jalan - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
    <style>
        .fa {
            margin-top: 5px;
        }

        .big-btn {
            margin-top: 10px !important;
            margin-bottom: 20px;
        }

        .big-btn:hover {
            color: #fff;
        }
    </style>
@endsection

@section('content-head')
    <div id="for-alert"></div>

    <div class="profile-edit-page-header" style="margin-bottom:10px;">
        <h2>Manajemen Data Berita</h2>
        <div class="breadcrumbs">
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ url('berita-admin') }}">Manajemen Data Berita</a>
            <span>Form Tambah Data Berita</span>
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
            </div>
            <div class="col-md-12" style="text-align:left;">
                <br>
                    <div class="profile-edit-container">
                        <form action="{{ url('api/berita-management') }}" method="post" id="simpan-berita">
                            @csrf
                            <div class="custom-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kategori <i class="fa fa-user-o"></i></label>
                                        <select name="id_kategori" id="id_kategori" class="chosen-select">
                                            <option selected value="-1">-- Kategori --</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Judul <i class="fa fa-list"></i>  </label>
                                        <input type="text" name="title" id="title">
                                    </div>
                                </div>
                                <input type="hidden" name="id_user" id="user_id" value="{{Auth::user()->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Cover <i class="fa fa-image"></i>  </label>
                                        <input type="text" name="file" id="thumbnail" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <label>&nbsp;</label>
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn big-btn color-bg flat-btn" style="margin-top:0px !important;">
                                            <i class="fa fa-search"></i> Choose
                                        </a>
                                    </div>
                                    <div class="col-md-1">&nbsp;</div>
                                    <div class="col-md-6">
                                        <label>Status <i class="fa fa-user-o"></i></label>
                                        <select name="flag" id="flag" class="chosen-select">
                                            <option selected value="-1">-- Status Berita --</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img id="holder" style="margin-top:15px;max-height:100px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Isi Berita</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea type="text" name="desc" id="desc"></textarea>
                                    </div>
                                </div>
                                

                                <button class="btn big-btn color-bg flat-btn" type="button" id="simpan">Save Changes<i class="fa fa-angle-right"></i></button>
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
<div class="main-register-wrap modal-kesalahan">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times" style="margin-top:10px !important;"></i></div>
                <h3>Kesalahan</h3>
                <p style="font-size:25px;" id="pesan"></p>
                <a class="btn btn-default close-modal">OK</a>
            </div>
        </div>
    </div>
<div class="main-register-wrap modal-simpan">
        <div class="main-overlay"></div>
        <div class="main-register-holder">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times" style="margin-top:10px !important"></i></div>
                <h3>Konfirmasi Simpan Data</h3>
                <p style="font-size:15px;">Apakah anda yakin akan menyimpan data ini?</p>
                <a class="btn btn-success" id="btn-simpan">Ya, saya yakin.</a>
                <a class="btn btn-default close-modal">Tidak</a>
            </div>
        </div>
    </div>
@section('foot-script')
    <script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.close-modal').on('click',function(){
                $('.modal-kesalahan').fadeOut();
                $('.modal-simpan').fadeOut();
            });
            $('#lfm').filemanager('image', {prefix: '{{url("/")}}/laravel-filemanager'});
      
			var options = {
				filebrowserImageBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Images',
				filebrowserImageUploadUrl: '{{url("/")}}/laravel-filemanager/upload?type=Images&_token=',
				filebrowserBrowseUrl: '{{url("/")}}/laravel-filemanager?type=Files',
				filebrowserUploadUrl: 	'{{url("/")}}/laravel-filemanager/upload?type=Files&_token='
			};
            CKEDITOR.replace('desc', options);
            
            
        });
        $('#simpan').on('click',function(e){
                var id_kategori=$('#id_kategori').val();
                var title=$('#title').val();
                var thumbnail=$('#thumbnail').val();
                var desc = CKEDITOR.instances['desc'].getData();
                // var desc=$('#desc').val();
                var user_id=$('#user_id').val();
                if(id_kategori=='-1')
                {
                    $('#pesan').text('Anda Belum Memilih Kategori');
                    $('.modal-kesalahan').fadeIn();
                }
                else if(title=='')
                {
                    $('#pesan').text('Anda Belum Mengisi Judul');
                    $('.modal-kesalahan').fadeIn();
                }
                else
                {
                    //e.preventDefault();
                    $('.modal-simpan').fadeIn();
                    // $("html, body").addClass("hid-body");
                }
                    
            });

            $('#btn-simpan').on('click',function(){
                // $('.modal-simpan').fadeOut();
                $('#simpan-berita').submit();
            });
    </script>
@endsection