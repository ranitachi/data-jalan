<!DOCTYPE HTML>
<html lang="en">
    <head>
        @include('backend.includes.head-tag')
        @yield('title')
    </head>
    <body>
        @include('backend.includes.loader')
        
        <!-- Main   -->
        <div id="main">

            <!-- header  -->
            @include('backend.includes.header')
            <!--  header end -->	
            
            <!-- wrapper -->	
            <div id="wrapper">
                <!--content -->  
                <div class="content">
                    <!--section --> 
                    <section id="sec1">
                        <!-- container -->
                        <div class="container">
                            <!-- profile-edit-wrap -->
                            <div class="profile-edit-wrap">
                                
                                <div id="for-alert-change-password"></div>

                                @yield('content-head')

                                <div class="row">

                                    @yield('content')

                                </div>
                            </div>
                            <!--profile-edit-wrap end -->
                        </div>
                        <!--container end -->
                    </section>
                    <!-- section end -->	

                    {{-- kode dibawah untuk sticky sidebar --}}
                    <div class="limit-box fl-wrap"></div>
                </div>
            </div>
            <!-- wrapper end -->

            @yield('modal')
            
            <!--footer -->
            @include('backend.includes.footer')
            <!--footer end  -->
            
            <a class="to-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script type="text/javascript" src="{{ asset('theme') }}/js/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('theme') }}/js/plugins.js"></script>
        <script type="text/javascript" src="{{ asset('theme') }}/js/scripts.js"></script>  

        @include('backend.includes.changepassword')        
        
        @yield('foot-script')
    </body>
</html>