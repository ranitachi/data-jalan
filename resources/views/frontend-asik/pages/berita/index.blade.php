@extends('frontend.layouts.pages')
@section('title')
    <title>Gebrak-Pakumis : Kabupaten Tangerang</title>
@endsection

@section('konten')

<section class="gray-section" id="sec1">
    <div class="container">
        <div class="row">
            @foreach ($berita as $index=> $item) 
                <div class="col-md-6" style="margin-bottom:20px;">
                    <div class="list-single-main-wrapper fl-wrap" id="sec2">
                <!-- article> --> 
                        <article>
                            <div class="list-single-main-media fl-wrap">
                                <div class="single-slider-wrapper fl-wrap">
                                    <div class="single-slider fl-wrap"  style="height:300px;border:1px solid #eee;">
                                        <div class="slick-slide-item"><img src="{{$item->file != '' ? asset($item->file) : asset('theme/images/all/1.jpg')}}"   alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-single-main-item fl-wrap">
                                <div class="list-single-main-item-title fl-wrap">
                                    <h3><a href="{{url('show/'.str_slug($item->title))}}">{{$item->title}}</a></h3>
                                </div>
                                <p>{{substr(strip_tags($item->desc),0,200)}} ...</p>
                                
                                <div class="post-opt">
                                    <ul>
                                        <li><i class="fa fa-calendar-check-o"></i> <span>{{tgl_indo($item->created_at)}}</span></li>
                                        <li><i class="fa fa-eye"></i> <span>{{$item->view}}</span></li>
                                    </ul>
                                </div>
                            
                                <span class="fw-separator"></span>
                                <a href="{{url('show/'.str_slug($item->title))}}" class="btn transparent-btn float-btn">Read more<i class="fa fa-eye"></i></a>
                            </div>
                        </article>
                        <!-- article end -->       
                        
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <span class="section-separator"></span>

                    <!-- article end -->           
                    <div class="pagination">
                        <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                        <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                    </div>
            </div>
        </div>
    </div>
</section>
    @include('frontend.pages.dashboard.modal-register')
@endsection