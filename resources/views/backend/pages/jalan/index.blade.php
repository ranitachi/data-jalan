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
                    <a href="{{ route('all-data-jalan.create') }}" class="btn btn-info btn-sm">+ Tambah Data</a>
                </div>
                <div style="float:right;width:100px;margin-right:20px;">
                    <a href="{{ url('download-file/jalan') }}" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Download XLS</a>
                </div>
            </div>
            <div class="col-md-12 table-responsive" style="text-align:left;">
                <br>
                <table id="user-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:15px;">#</th>
                            <th rowspan="2">Kecamatan</th>
                            <th rowspan="2">Nomor Ruas</th>
                            <th rowspan="2">Nama Jalan</th>
                            <th rowspan="2">Vol Panjang</th>
                            <th rowspan="2">Vol Lebar</th>
                            <th colspan="3">Tipe Konstruksi</th>
                            <th rowspan="2">Kondisi Jalan</th>
                            <th rowspan="2">Keterangan</th>
                            <th rowspan="2">KML File</th>
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
                                <td>{{ $item->no_ruas }}</td>
                                <td>{{ $item->nama_jalan }}</td>
                                <td>{{ $item->vol_panjang_km }} Km</td>
                                <td>{{ $item->vol_lebar_m }} m</td>
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
                                <td class="text-center">
                                    @if ($item->kml_file=='')
                                        <a href="javascript:formuploadkml({{$item->id}})" class="btn btn-primary btn-xs"><i class="fa fa-upload"></i></a>
                                    @else
                                        <a href="javascript:formuploadkml({{$item->id}})" class="btn btn-primary btn-xs"><i class="fa fa-upload"></i></a>
                                        <a href="javascript:showmap({{$item->id}})" class="btn btn-success btn-xs"><i class="fa fa-map"></i></a>
                                    @endif
                                </td>
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
    <div class="main-register-wrap modal-upload-kml">
        <div class="main-overlay"></div>
        <div class="main-register-holder" style="max-width:700px !important;text-align:center">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Upload File KML</h3>
                <form action="{{url('upload_kml')}}" method="POST" enctype="multipart/form-data" id="form-upload-kml">
                    @csrf
                    <div id="" style='padding:10px;margin-bottom:20px;'>
                        <input type="hidden" id="id_jalan" name="id_jalan">
                        <div class="col-md-12 text-left">
                            <label>Upload File KML</label>
                            <input type="file" name="file" id="file_kml" style="padding:10px;border:1px solid #ccc;">
                        </div>
                        <div class="col-md-12" style="text-left">
                            <h3>Contoh Format KML yang Dianjurkan</h3>
                            <textarea rows="20" cols="40" style="border:none;width:100%">&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;kml xmlns="http://www.opengis.net/kml/2.2" xmlns:gx="http://www.google.com/kml/ext/2.2" xmlns:kml="http://www.opengis.net/kml/2.2" xmlns:atom="http://www.w3.org/2005/Atom"&gt;
&lt;Document&gt;
    &lt;name>Nama Ruas Jalan .kml&lt;/name&gt;
    &lt;Style id="IDRUASJALAN"&gt;
        &lt;LineStyle&gt;
            &lt;color>FF000000&lt;/color&gt;&lt;!-- 000000 => Warna Hexa Decimal--&gt;
        &lt;/LineStyle&gt;
    &lt;/Style&gt;
    &lt;Placemark&gt;
        &lt;name&gt;Nama Ruas Jalan&lt;/name&gt;
        &lt;description&gt;Desksipsi Jalan&lt;/description&gt;
        &lt;styleUrl&gt;#IDRUASJALAN&lt;/styleUrl&gt;
        &lt;LineString&gt;
            &lt;coordinates&gt;
                &lt;!-- Isi Dengan Koordinat --&gt;
            &lt;/coordinates&gt;
        &lt;/LineString&gt;
    &lt;/Placemark&gt;
&lt;/Document&gt;
&lt;/kml&gt;</textarea>
                        </div>
                    </div>
                <a class="btn btn-default close-modal">Tutup</a>
                <button class="btn btn-info" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="main-register-wrap modal-maps">
        <div class="main-overlay"></div>
        <div class="main-register-holder" style="max-width:1000px !important;text-align:center">
            <div class="main-register fl-wrap">
                <div class="close-reg close-modal"><i class="fa fa-times"></i></div>
                <h3>Maps</h3>
                
                    <div id="konten-maps" style='padding:10px;margin-bottom:20px;height:650px;'></div>
                <a class="btn btn-default close-modal">Tutup</a>
                
            </div>
        </div>
    </div>
@endsection

@section('foot-script')
    <script src="{{ asset('theme') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('theme') }}/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/maps-wilayah.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAYzgG72G3M3HVGRdzkvtvO5c4N7lmIuiY&amp;&scale=2" type="text/javascript"></script>
    <script>
        var infowindow;
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
            $('.modal-upload-kml').fadeOut();
            $('.modal-maps').fadeOut();
        });

        function showmap(id)
        {
            // $('#id_jalan').val(id);
            // $('#konten-maps').load('{{url("load-map")}}/'+id,function(){
            //     // google.maps.event.trigger(map, "resize");
            // });
            $.ajax({
                url : '{{url("load-map")}}/'+id,
                dataType : 'json',
                success:function(res){
                    initializeGMap(-6.1785876, 106.4970427,res.url);
                    
                    $('.modal-maps').on('shown.bs.modal', function() {
                        google.maps.event.trigger(map, "resize");
                        map.setCenter(myLatlng);
                    });
                    $('.modal-maps').fadeIn();
                }
            });
        }
        function initializeGMap(lat, lng, url) {
            url = url+'?dummy='+(new Date()).getTime();
            infowindow = new google.maps.InfoWindow({
                pixelOffset: new google.maps.Size(300, 0),
            });


            map = new google.maps.Map(document.getElementById('konten-maps'), {
                center: new google.maps.LatLng(lat, lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 11,
                animation: google.maps.Animation.BOUNCE,
            });
            var kmlLayer = new google.maps.KmlLayer(url, {
                suppressInfoWindows: true,
                preserveViewport: false,
                screenOverlays: true,
                zIndex: 4,
            });
            kmlLayer.setMap(map);
            kmlLayer.addListener('click', info_content);
            // loadwilayah(true,true);
            function info_content(event) {
    
                    infowindow.setContent('<div class="info_content">' +
                        '<h3>London Eye</h3>' +
                        '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' + '</div>');
                    infowindow.open(map);
            }
        }
        function formuploadkml(id)
        {
            $('#id_jalan').val(id);
            $('.modal-upload-kml').fadeIn();
        }
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