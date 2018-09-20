<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        @yield('title')
        @include('frontend.includes.head')
    </head>
    <body class="full-width">
        <div id="fb-root"></div>
        <div class="container container-wrapper container-side-version">
            @include('frontend.includes.header')
            <!-- /.header--> 
            @include('frontend.includes.map')
            @yield('konten')
            @include('frontend.includes.footer')
            <a class="btn btn-scoll-up color-secondary" id="btn-scroll-up"></a>
        </div>
        <!-- Start Jquery -->
        @include('frontend.includes.script')
    </body>
</html>