<footer class="footer">
                <div class="container footer-mask">
                    <div class="container footer-contant">
                        <div class="row">
                            <div class="col-md-3 hidden-sm hidden-xs">
                                <div class="logo"><a href="#"><img src="assets/img/placeholders/360x85.png" alt="" /></a></div>
                                <div class="social">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="title">
                                    <h4>Kontak</h4>
                                </div>
                                <ul class="list list-contact  list-news">
                                    <li>Lorem Ipsum</li>
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
                            <div class="col-md-3 col-sm-6">
                                <div class="title">
                                    <h4>Opening hours</h4>
                                </div>
                                <ul class="list list-hours">
                                    <li>
                                        <a href="page_gallery.html" class="title">Mon-Tues:</a>
                                        <span class="description"> 
                                            6.30 am - 18.00pm
                                        </span>
                                    </li>                       
                                    <li>
                                        <a href="page_gallery.html" class="title">Wed - Th:</a>
                                        <span class="description"> 
                                            10.00 am - 11.30pm
                                        </span>
                                    </li>                       
                                    <li>
                                        <a href="page_gallery.html" class="title">Fri:</a>
                                        <span class="description"> 
                                            2.30 pm - 10.00pm
                                        </span>
                                    </li>                       
                                    <li>
                                        <a href="page_gallery.html" class="title">Sun:</a>
                                        <span class="description"> 
                                            Closed
                                        </span>
                                    </li>                       
                                </ul>
                            </div>
                        </div>
                    </div><!-- /.footer-content -->
                    <div class="footer-bottom">
                        <div class="container text-right">
                            <span class=""><a href="#">WINTER &#169; 2016</a></span>
                        </div>
                    </div><!-- /.footer-bottom --> 
                </div>
            </footer>