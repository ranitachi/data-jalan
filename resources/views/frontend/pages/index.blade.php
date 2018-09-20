@extends('frontend.layouts.master')
@section('title')
    <title>Sistem Informasi Data Jalan : Kabupaten Tangerang</title>
@endsection

@section('konten')
    @include('frontend.pages.dashboard.index')
    
    @include('frontend.pages.dashboard.modal-register')
@endsection