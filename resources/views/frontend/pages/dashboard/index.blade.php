
            <section class="section section-slim agencies" style="background:#0f7ad5">
                <div class="container">
                    <h2 class="section-title text-center"><span>Galeri Foto Jalan</span></h2>
                    <div class="row-fluid clearfix">
                        <div class="col-md-12 col-md-offset-0 owl-corousel-box agencies-corousel">
                            <div class="owl-carousel">
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
                                </div>
                                <div class="item">
                                    <a href="profile.html"><img src="assets/img/placeholders/300x60.png" alt="" /></a>
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
                    <h2 class="section-title text-center"><span>Berita</span></h2>
                    <div class="row-fluid clearfix">
                        <div class="col-md-12 col-md-offset-0 owl-corousel-box agents-corousel agents-corousel-big" id="agents-corousel-big">
                            
                            <div class="owl-carousel">
                                @php
                                    $berita=\App\Models\TrxBerita::where('flag',1)->with('cat_berita')->orderBy('created_at','desc')->limit(6)->get();
                                @endphp
                                @foreach ($berita as $item)
                                    <div class="item agents-corousel-item">
                                        <div class="box-container media">
                                            <div class="agent-logo media-left media-top">
                                                <a href="{{url('show/'.$item->slug)}}" class='img-circle-cover'>
                                                    @if (is_null($item->file))
                                                        <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                                    @else
                                                        <img src="{{asset($item->file)}}" alt="" class="img-circle" style="height:90;width:90;" />
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="agent-details media-right media-top">
                                                <a href="{{url('show/'.$item->slug)}}" class="agent-name text-color-primary">{{substr($item->title,0,25)}} ...</a>
                                                <span class="phone"><i class="fa fa-calendar"></i> {{tgl_indo($item->created_at)}}</span>
                                                <a href="#" class="mail"><i class="fa fa-eye"></i> {{($item->view)}}</a>
                                            </div>
                                        </div><!-- /.agent-card--> 
                                        <div class="row" style="background:#fff;padding-bottom:10px;">
                                            <div class="col-md-12">
                                                <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr">{{substr(strip_tags($item->desc),0,200)}}</div>
                                                    <a href="{{url('show/'.$item->slug)}}" class="btn btn-primary btn-xs pull-right">Selengkapnya <i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div class="owl-carousel">
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Grace Aitken </a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:grace@estatepoint.com" class="mail">grace@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                    <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Sophia Beckett</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:sophia@estatepoint.com" class="mail">sophia@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Lazo Bikup</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:lazo@estatepoint.com" class="mail">lazo@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Pero Petric</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:pero@estatepoint.com" class="mail">pero@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Alicia Bell</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:alicia@estatepoint.com" class="mail">alicia@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Holly Crouch</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:holly@estatepoint.com" class="mail">holly@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="#" class="agent-name text-color-primary">Isabel Lea</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:isabel@estatepoint.com" class="mail">isabel@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Kety York</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:kety@estatepoint.com" class="mail">kety@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item agents-corousel-item">
                                    <div class="box-container media">
                                        <div class="agent-logo media-left media-top">
                                            <a href="profile.html" class='img-circle-cover'>
                                                <img src="assets/img/placeholders/90x90.png" alt="" class="img-circle" />
                                            </a>
                                        </div>
                                        <div class="agent-details media-right media-top">
                                            <a href="profile.html" class="agent-name text-color-primary">Sara Perry</a>
                                            <span class="phone">+385 (0)92 12 3 321</span>
                                            <a href="mailto:sara@estatepoint.com" class="mail">sara@estatepoint.com</a>
                                        </div>
                                    </div><!-- /.agent-card--> 
                                     <div class="row" style="background:#fff;">
                                        <div class="col-md-12">
                                            <div class="property-card-box card-box card-block">
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <a href="#" class="owl-btn customPrevBtn"></a>
                            <a href="#" class="owl-btn customNextBtn"></a>
                        </div>     
                    </div>
                </div>
            </section><!-- /.agencies -->