<footer class="footer">
                <div class="container footer-mask">
                    <div class="container footer-contant">
                        <div class="row">
                            <div class="col-md-4 hidden-sm hidden-xs">
                                <div class="logo">
                                    <div class="custom-title-logo" style="color:#fff;">Sistem Informasi Data Jalan</div>
                                    <div>Pemerintah Kabupaten Tangerang</div>
                                </div>
                                <div class="social">
                                    <ul style="text-align:left;">
                                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="title">
                                    <h4>Kontak</h4>
                                </div>
                                <ul class="list list-contact  list-news">
                                    <li>Dinas Perhubungan Kabupaten Tangerang</li>
                                    <li><i class="fa fa-phone"></i> (021) 81 123 321</li>
                                    <li><i class="fa fa-phone"></i>  (021) 91 123 322</li>
                                    <li><i class="fa fa-envelope"></i>  info@email.go.id</li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6  hidden-sm hidden-xs">
                                <div class="title">
                                    <h4>Berita</h4>
                                </div>
                                <ul class="list list-news">
                                    @php
                                        $berita=\App\Models\TrxBerita::where('flag',1)->with('cat_berita')->orderBy('created_at','desc')->limit(5)->get();
                                    @endphp
                                    @foreach ($berita as $item) 
                                    <li>
                                        <a href="{{url('show/'.$item->slug)}}" class="title" style="line-height:18px !important;">{{$item->title}}</a><br>
                                        <span class="description"> 
                                            {{tgl_indo2($item->created_at)}}
                                        </span>
                                    </li>                       
                                    @endforeach                     
                                </ul>
                            </div>
                        </div>
                    </div><!-- /.footer-content -->
                    <div class="footer-bottom">
                        <div class="container text-right">
                            <span class=""><a href="#">Pemerintah Kabupaten Tangerang &#169; 2018</a></span>
                        </div>
                    </div><!-- /.footer-bottom --> 
                </div>
            </footer>