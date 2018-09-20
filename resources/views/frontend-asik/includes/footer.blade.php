<footer class="main-footer dark-footer  ">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-widget fl-wrap">
                    <h3>Tentang Kami</h3>
                    <div class="footer-contacts-widget fl-wrap">
                        <p>Aplikasi Survey Identifikasi Kekumuhan</p>
                        <ul  class="footer-contacts fl-wrap">
                            <li><span><i class="fa fa-envelope-o"></i> Mail :</span><a href="#" target="_blank">yourmail@domain.com</a></li>
                            <li> <span><i class="fa fa-map-marker"></i> Adress :</span><a href="#" target="_blank">USA 27TH Brooklyn NY</a></li>
                            <li><span><i class="fa fa-phone"></i> Phone :</span><a href="#">+7(111)123456789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $berita=\App\Models\TrxBerita::orderByRaw('RAND()')->orderBy('created_at','desc')->limit(3)->get();
            @endphp
            <div class="col-md-4">
                <div class="footer-widget fl-wrap">
                    <h3>Berita Terbaru</h3>
                    <div class="widget-posts fl-wrap">
                        <ul>
                        @foreach ($berita as $index=>$item)
                        
                            <li class="clearfix">
                                <a href="#"  class="widget-posts-img">
                                    <img src="{{$item->file != '' ? asset($item->file) : asset('theme/images/all/1.jpg')}}"   alt="" class="respimg"></a>
                                <div class="widget-posts-descr">
                                    <a href="{{url('show/'.str_slug($item->title))}}" title="">{{$item->title}}</a>
                                    <span class="widget-posts-date"> {{tgl_indo2($item->created_at)}} </span> 
                                </div>
                            </li>
                        @endforeach    
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-widget fl-wrap">
                    <h3>Kritik & Saran</h3>
                    <div class="subscribe-widget fl-wrap">
                        <p>Berikan kritik dan saran anda untuk aplikasi ini:</p>
                        <div class="subcribe-form">
                            <form id="subscribe">
                                <input class="enteremail" name="email" id="subscribe-email" placeholder="Email" spellcheck="false" type="text">
                                <input class="enteremail" name="pesan" id="subscribe-kritik" placeholder="Kritik & Saran" spellcheck="false" type="text" style="margin-top:10px;">
                                <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fa fa-envelope-o"></i> Kirim</button>
                                <label for="subscribe-email" class="subscribe-message"></label>
                            </form>
                        </div>
                    </div>
                    <div class="footer-widget fl-wrap">
                        <div class="footer-menu fl-wrap">
                            <ul>
                                <li><a href="#">Beranda </a></li>
                                <li><a href="#">Gebrak Pakumis</a></li>
                                <li><a href="#">Berita</a></li>
                                <li><a href="#">Data</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer fl-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="copyright"> &#169; Pemerintahan Kabupaten Tangerang 2018.  All rights reserved.</div>
                </div>
                <div class="col-md-7">
                    <div class="footer-social">
                        <ul>
                            <li><a href="#" target="_blank" ><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank" ><i class="fa fa-chrome"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>