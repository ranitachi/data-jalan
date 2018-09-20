@extends('frontend.layouts.pages')
@section('title')
    <title>Gebrak-Pakumis : Kabupaten Tangerang</title>
    <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dataTables.bootstrap.min.css">
@endsection

@section('konten')
    <!--section -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Hasil Usulan Survey Rumah Kumuh</h2>
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
                                <th style="width:15px;" rowspan="2">#</th>
                                <th rowspan="2">Kecamatan</th>
                                <th rowspan="2">BNBA</th>
                                <th rowspan="2">Penerima</th>
                                <th rowspan="2">Alamat</th>
                                <th rowspan="2">Kegiatan</th>
                                <th colspan="3">Alokasi Dana</th>
                                <th rowspan="2">Total</th>
                            </tr>
                            <tr>
                                <td>Rumah</td>
                                <td>WC</td>
                                <td>BOP</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key=$key+1 }}</td>
                                    <td>{{ $item->kecamatan->nama_kecamatan }}</td>
                                    <td>{{ $item->no_bnba }}</td>
                                    <td>{{ $item->penerima }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->jenis_kegiatan }}</td>
                                    <td>{{ $item->dana_pk_rumah }}</td>
                                    <td>{{ $item->dana_pemb_wc }}</td>
                                    <td>{{ $item->dana_bop_keg }}</td>
                                    <td>{{ $item->dana_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

@endsection

@section('footscript')
    <script src="{{ asset('theme') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('theme') }}/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(function() {
            $('#user-table').DataTable();
        });
    </script>
@endsection