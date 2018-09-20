@extends('frontend.layouts.master')
@section('title')
    <title>Gebrak-Pakumis : Kabupaten Tangerang</title>
@endsection

@section('konten')
    @include('frontend.pages.dashboard.index')
    
    @include('frontend.pages.dashboard.modal-register')
@endsection