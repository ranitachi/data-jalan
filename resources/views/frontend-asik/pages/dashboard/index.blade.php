<!--section -->
<section>
    <div class="container">
        <div class="section-title">
            <h2>Berita Terbaru</h2>
            <div class="section-subtitle">Gebrak Pakumis</div>
            <span class="section-separator"></span>
            <p>Browse the latest articles from our blog.</p>
        </div>
        <div class="row home-posts">
            @php
                $berita=\App\Models\TrxBerita::orderByRaw('RAND()')->orderBy('created_at','desc')->limit(3)->get();
            @endphp
            @foreach ($berita as $idx=>$item)     
                <div class="col-md-4">
                    <article class="card-post">
                        <div class="card-post-img fl-wrap" style="height:257px;border:1px solid #eee;">
                            <a href="{{url('show/'.str_slug($item->title))}}"><img src="{{$item->file != '' ? asset($item->file) : asset('theme/images/all/1.jpg')}}"   alt=""></a>
                        </div>
                        <div class="card-post-content fl-wrap">
                            <h3><a href="{{url('show/'.str_slug($item->title))}}">{{$item->title}}</a></h3>
                            <p>{{substr(strip_tags($item->desc),0,150)}} ...</p>
                            <div class="post-opt">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"></i> <span>{{tgl_indo($item->created_at)}}</span></li>
                                    <li><i class="fa fa-eye"></i> <span>{{$item->view}}</span></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
           @endforeach
        </div>
        <a href="{{url('berita')}}" class="btn  big-btn circle-btn  dec-btn color-bg flat-btn">Read All<i class="fa fa-eye"></i></a>
    </div>
</section>
<!-- section end -->

<!--section -->
{{-- <section class="gray-section">
    <div class="container">
        <div class="fl-wrap spons-list">
            <ul class="client-carousel">
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
                <li><a href="#" target="_blank"><img src="{{asset('theme/images/clients/1.png')}}" alt=""></a></li>
            </ul>
            <div class="sp-cont sp-cont-prev"><i class="fa fa-angle-left"></i></div>
            <div class="sp-cont sp-cont-next"><i class="fa fa-angle-right"></i></div>
        </div>
    </div>
</section> --}}
<!-- section end -->
