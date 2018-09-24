@extends('frontend.layouts.pages')
@section('title')
    <title>{{$berita->title}} : Kabupaten Tangerang</title>
@endsection
@section('judul')
    <ul class="breadcrumb top-title-breadcrumb">
        <li class="item"><a href="{{url('/')}}"> Beranda </a></li>
        <li class="item"><a href="{{url('berita')}}"> Berita </a></li>
        <li class="item"> {{$berita->title}} </li>
    </ul>
    <h1 class="top-title-t">Berita</h1> 
@endsection
@section('konten')
    <main class="main main-container section-color-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <section class="widget-blog-listing">
                                <div class="properties">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="property-card news-card card">
                                                <div class="property-card-header image-box" style="height:400px;width:750px;padding:20px;">
                                                    @if (is_null($berita->file))
                                                            <img src="assets/img/placeholders/450x300.png" alt="" class="" />
                                                        @else
                                                            <img src="{{asset($berita->file)}}" alt="" class="" style="height:auto;width:100%;"/>
                                                        @endif
                                                </div>
                                               <div class="property-card-tasm" style="width:100%">
                                                        <div class="pull-left item-t">
                                                            <span class="name">by <a href="#" class="text-color-primary">Admin</a></span>
                                                            <span class="date">
                                                                <i class="fa fa-calendar"></i>
                                                                {{tgl_indo($berita->created_at)}}
                                                            </span>
                                                            <span class="date">
                                                                <i class="fa fa-eye"></i>
                                                                {{($berita->view)}}
                                                            </span>
                                                        </div>
                                                        <div class="item-tag pull-right text-color-primary">
                                                            {{$berita->cat_berita->nama_kategori}}
                                                        </div>
                                                    </div>
                                                    <div class="property-card-box card-box card-block" >
                                                        <h3 class="property-card-title"><a href="#">{{$berita->title}}</a></h3>
                                                        <div class="property-card-descr">{!!$berita->desc!!}</div>
                                                        
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </section>
                        </div><!-- /.center-content -->
                        <div class="col-md-4">
                            <div class="widget widget-box box-container widget-properties">
                                <div class="widget-header text-uppercaser">
                                    <h2>Berita Populer</h2>
                                </div>
                                <div class="properties">
                                    <div class="row">
                                        @foreach ($populer as $item) 
                                        <div class="col-md-12">
                                            <div class="property-card card">
                                                <div class="property-card-header image-box">
                                                    @if (is_null($item->file))
                                                            {{-- <img src="assets/img/placeholders/450x300.png" alt="" class="" /> --}}
                                                            <img src="{{asset('assets/img/placeholders/395x250.png')}}" alt="" class="">
                                                        @else
                                                            <img src="{{asset($item->file)}}" alt="" class="" style="height:250px;width:395px;border:1px solid #ccc"/>
                                                        @endif
                                                    
                                                    <div class="budget"><i class="fa fa-star"></i></div>
                                                </div>
                                                <div class="property-card-tags">
                                                    <span class="label label-default label-tag-warning">{{$item->cat_berita->nama_kategori}}</span>
                                                </div>
                                                <div class="property-card-box card-box card-block">
                                                    <h3 class="property-card-title"><a href="{{url('show/'.$item->slug)}}">{{$item->title}}</a></h3>
                                                    <div class="clearfix options">
                                                        <span class="property-card-title address"><i class="fa fa-calendar"></i> {{tgl_indo($item->created_at)}}</span>
                                                        <span class="property-card-title price"><i class="fa fa-eye"></i> View : {{$item->view}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.right side bar -->
                    </div>
                </div>
            </main>
    @include('frontend.pages.dashboard.modal-register')
@endsection
<style>
.components-examples ul, .box-container-title .sub-title, body p
{
    max-width: unset !important;
}
</style>