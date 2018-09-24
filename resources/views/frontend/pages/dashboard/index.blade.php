
            <section class="section section-slim agencies" style="background:#0f7ad5">
                <div class="container">
                    <h2 class="section-title text-center" style="font-weight:bold;color:#fff;"><span>Galeri Foto</span></h2>
                    <div class="row-fluid clearfix">
                        <div class="col-md-12 col-md-offset-0 owl-corousel-box agencies-corousel">
                            <div class="owl-carousel">
                                <div class="item">
                                    <a href="#"><img src="{{ asset('/') }}/galeri/jalan1.jpg" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('/') }}/galeri/jalan2.jpg" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('/') }}/galeri/jalan3.jpg" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('/') }}/galeri/jalan4.jpg" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img src="{{ asset('/') }}/galeri/jalan5.jpg" alt="" /></a>
                                </div>
                            </div>
                            <a href="#" class="owl-btn customPrevBtn"></a>
                            <a href="#" class="owl-btn customNextBtn"></a>
                        </div>     
                    </div>
                </div>
            </section><!-- /.agencies -->  
          
            <section class="section section-slim agents section-color-secondary">
                <div class="container">
                    <h2 class="section-title text-center" style="font-weight:bold;"><span>Berita Terbaru</span></h2>
                    <div class="row-fluid clearfix">
                        <div class="col-md-12 col-md-offset-0 owl-corousel-box agents-corousel agents-corousel-big" id="agents-corousel-big">
                            
                            <div class="owl-carousel">
                                @php
                                    $berita=\App\Models\TrxBerita::where('flag',1)->with('cat_berita')->orderBy('created_at','desc')->limit(6)->get();
                                @endphp
                                @foreach ($berita as $item)
                                    <div class="item agents-corousel-item">
                                        <div class="box-container media">
                                            <div class="agent-details media-right media-top">
                                                <a href="{{url('show/'.$item->slug)}}" class="agent-name text-color-primary">{{ $item->title }}</a>
                                                <span class="phone"><i class="fa fa-calendar"></i> {{tgl_indo($item->created_at)}}</span>
                                                <a href="#" class="mail"><i class="fa fa-eye"></i> {{($item->view)}}</a>
                                            </div>
                                        </div><!-- /.agent-card--> 
                                        <div class="row" style="background:#fff;padding-bottom:10px;">
                                            <div class="col-md-12" style="margin-top:10px;">
                                                <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr">{{substr(strip_tags($item->desc),0,200)}}</div>
                                                    <a href="{{url('show/'.$item->slug)}}" class="btn btn-primary btn-xs pull-right">Selengkapnya <i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="#" class="owl-btn customPrevBtn"></a>
                            <a href="#" class="owl-btn customNextBtn"></a>
                        </div>     
                    </div>
                </div>
            </section><!-- /.agencies -->