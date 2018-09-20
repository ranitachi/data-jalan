@extends('frontend.layouts.pages')
@section('title')
    <title>Gebrak-Pakumis : Kabupaten Tangerang</title>
@endsection

@section('konten')

<section class="gray-section" id="sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-single-main-wrapper fl-wrap" id="sec2">
                    <!-- article> --> 
                    <article>
                        <div class="list-single-main-media fl-wrap">
                            <div class="single-slider-wrapper fl-wrap">
                                <div class="single-slider fl-wrap"  style="height:400px;border:1px solid #eee;">
                                        <div class="slick-slide-item"><img src="{{$berita->file != '' ? asset($berita->file) : asset('theme/images/all/1.jpg')}}"   alt=""></div>
                                    </div>
                              
                            </div>
                        </div>
                        <div class="list-single-main-item fl-wrap">
                            <div class="list-single-main-item-title fl-wrap">
                                <h3><a href="#">{{$berita->title}}</a></h3>
                            </div>
                            {!!$berita->desc!!}
                            
                            <div class="post-opt">
                                <ul>
                                    <li><i class="fa fa-calendar-check-o"></i> <span>{{tgl_indo($berita->created_at)}}</span></li>
                                    <li><i class="fa fa-eye"></i> <span>{{$berita->view}}</span></li>
                                    
                                </ul>
                            </div>
                            <span class="fw-separator"></span>
                            
                        </div>
                    </article>
                    <!-- article end -->       
                    <span class="section-separator"></span>
                    <!-- article> --> 
                    
                </div>
            </div>
            <!--box-widget-wrap -->
            <div class="col-md-4">
                <div class="box-widget-item fl-wrap">
                        <div class="box-widget-item-header">
                            <h3>Berita Populer : </h3>
                        </div>
                        <div class="box-widget widget-posts blog-widgets">
                            <div class="box-widget-content">
                                <ul>
                                @foreach ($populer as $item) 
                                    <li class="clearfix">
                                        <a href="{{url('berita/'.$item->slug)}}"  class="widget-posts-img"><img src="{{$item->file != '' ? asset($item->file) : asset('theme/images/all/1.jpg')}}"   alt=""></a>
                                        <div class="widget-posts-descr">
                                            <a href="{{url('berita/'.$item->slug)}}" title="">{{$item->title}}</a>
                                            <span class="widget-posts-date"><i class="fa fa-calendar-check-o"></i> {{tgl_indo2($item->created_at)}} </span> 
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection