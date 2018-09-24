@extends('frontend.layouts.pages')
@section('title')
    <title>Berita : Kabupaten Tangerang</title>
@endsection
@section('judul')
<section class="top-title-widget color-primary">
    <div class="container">
        <div  style="width:85%;margin:0 auto;">
        <ul class="breadcrumb top-title-breadcrumb">
            <li class="item"><a href="{{url('/')}}"> Beranda </a></li>
            <li class="item"> Berita </li>
        </ul>
        <h1 class="top-title-t">Berita</h1> 
        </div>
    </div>
</section>
@endsection
@section('konten')
    <main class="main main-container section-color-primary"  style="width:85%;margin:0 auto;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="widget-blog-listing">
                                <div class="properties">
                                    <div class="row">
                                        @foreach ($berita as $item)
                                            <div class="col-sm-4">
                                                <div class="property-card news-card card" style="padding-bottom:20px;">
                                                    <div class="property-card-header image-box">
                                                        @if (is_null($item->file))
                                                            <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                        @else
                                                            <img src="{{asset($item->file)}}" alt="" class="" style="height:300px;width:450px;"/>
                                                        @endif
                                                        {{-- <a href="page_gallery.html" class="property-card-hover">
                                                            <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                            <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                            <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                        </a> --}}
                                                    </div>
                                                    <div class="property-card-tasm">
                                                        <div class="pull-left item-t">
                                                            <span class="name">by <a href="#" class="text-color-primary">Admin</a></span>
                                                            <span class="date">
                                                                <i class="fa fa-calendar"></i>
                                                                {{tgl_indo($item->created_at)}}
                                                            </span>
                                                        </div>
                                                        <div class="item-tag pull-right text-color-primary">
                                                            {{$item->cat_berita->nama_kategori}}
                                                        </div>
                                                    </div>
                                                    <div class="property-card-box card-box card-block" >
                                                        <h3 class="property-card-title"><a href="{{url('show/'.$item->slug)}}">{{$item->title}}</a></h3>
                                                        <div class="property-card-descr">{{substr(strip_tags($item->desc),0,150)}} ...</div>
                                                        <a href="{{url('show/'.$item->slug)}}" class="btn btn-primary btn-xs pull-right">Selengkapnya <i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{-- <div class="col-sm-4">
                                            <div class="property-card news-card card">
                                                <div class="property-card-header image-box">
                                                    <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                    <a href="page_gallery.html" class="property-card-hover">
                                                        <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                        <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                        <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                    </a>
                                                </div>
                                                <div class="property-card-tasm">
                                                    <div class="pull-left item-t">
                                                        <a href="profile.html" class='img-circle-cover'>
                                                            <img src="assets/img/placeholders/30x30.png" alt="" class="img-circle" />
                                                        </a>
                                                        <span class="name">by <a href="profile.html" class="text-color-primary">Grace Aitken</a></span>
                                                        <span class="date">
                                                            <i class="fa fa-calendar"></i>
                                                            February 6, 2016
                                                        </span>
                                                    </div>
                                                    <div class="item-tag pull-right text-color-primary">
                                                        Run
                                                    </div>
                                                </div>
                                                <div class="property-card-box card-box card-block">
                                                    <h3 class="property-card-title"><a href="page_gallery.html">Healthy body important for success in business</a></h3>
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="property-card news-card card">
                                                <div class="property-card-header image-box">
                                                    <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                    <a href="page_gallery.html" class="property-card-hover">
                                                        <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                        <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                        <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                    </a>
                                                </div>
                                                <div class="property-card-tasm">
                                                    <div class="pull-left item-t">
                                                        <a href="profile.html" class='img-circle-cover'>
                                                            <img src="assets/img/placeholders/30x30.png" alt="" class="img-circle" />
                                                        </a>
                                                        <span class="name">by <a href="profile.html" class="text-color-primary">Lazo Bikup</a></span>
                                                        <span class="date">
                                                            <i class="fa fa-calendar"></i>
                                                            June 9, 2017
                                                        </span>
                                                    </div>
                                                    <div class="item-tag pull-right text-color-primary">
                                                        House
                                                    </div>
                                                </div>
                                                <div class="property-card-box card-box card-block">
                                                    <h3 class="property-card-title"><a href="page_gallery.html">New modern house designs</a></h3>
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="property-card news-card card">
                                                <div class="property-card-header image-box">
                                                    <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                    <a href="page_gallery.html" class="property-card-hover">
                                                        <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                        <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                        <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                    </a>
                                                </div>
                                                <div class="property-card-tasm">
                                                    <div class="pull-left item-t">
                                                        <a href="profile.html" class='img-circle-cover'>
                                                            <img src="assets/img/placeholders/30x30.png" alt="" class="img-circle" />
                                                        </a>
                                                        <span class="name">by <a href="profile.html" class="text-color-primary">Pero Petric</a></span>
                                                        <span class="date">
                                                            <i class="fa fa-calendar"></i>
                                                            February 21, 2017
                                                        </span>
                                                    </div>
                                                    <div class="item-tag pull-right text-color-primary">
                                                        City
                                                    </div>
                                                </div>
                                                <div class="property-card-box card-box card-block">
                                                    <h3 class="property-card-title"><a href="page_gallery.html">Better portal for large City</a></h3>
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="property-card news-card card">
                                                <div class="property-card-header image-box">
                                                    <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                    <a href="page_gallery.html" class="property-card-hover">
                                                        <img src="assets/img/property-hover-arrow.png" alt="" class="left-icon" />
                                                        <img src="assets/img/plus.png" alt="" class="center-icon" />
                                                        <img src="assets/img/icon-notice.png" alt="" class="right-icon" />
                                                    </a>
                                                </div>
                                                <div class="property-card-tasm">
                                                    <div class="pull-left item-t">
                                                        <a href="profile.html" class='img-circle-cover'>
                                                            <img src="assets/img/placeholders/30x30.png" alt="" class="img-circle" />
                                                        </a>
                                                        <span class="name">by <a href="profile.html" class="text-color-primary">Holly Crouch</a></span>
                                                        <span class="date">
                                                            <i class="fa fa-calendar"></i>
                                                            May 1, 2017
                                                        </span>
                                                    </div>
                                                    <div class="item-tag pull-right text-color-primary">
                                                        Speaker
                                                    </div>
                                                </div>
                                                <div class="property-card-box card-box card-block">
                                                    <h3 class="property-card-title"><a href="page_gallery.html">Become successfully speaker</a></h3>
                                                    <div class="property-card-descr"> This  is simply dummy text of the printing and typesetting industry. That m has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book...</div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <nav class="text-center">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </section>
                        </div><!-- /.center-content -->
                        
                    </div>
                </div>
            </main>
    @include('frontend.pages.dashboard.modal-register')
@endsection