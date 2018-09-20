<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        @yield('title')
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        @include('frontend.includes.head')
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>
        <!--loader end-->
        <!-- Main  -->
        <div id="main">
            <!-- header-->
            @include('frontend.includes.header')
            <!--  header end -->	
            <!-- wrapper -->	
            <div id="wrapper">
                <!-- Content-->   
                <div class="content">
                    <!-- home-map--> 
                    @include('frontend.includes.map')
                    <!-- section end -->
                    <!--section -->
                    @yield('konten')
                </div>
                <!-- Content end -->      
            </div>
            <!-- wrapper end -->
            <!--footer -->
            @include('frontend.includes.footer')
            <!--footer end  -->
            <!--register form -->
           
            <!--register form end -->
            <a class="to-top"><i class="fa fa-angle-up"></i></a>
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        @include('frontend.includes.script')
    </body>
</html>
<script type="text/javascript">
	jQuery(function($) {
        $('#hidewhenload').hide();

		$('.menu-toggle').click(function(e){
            var idmenu=$('#menu').val();
            //alert(idmenu);
            if(idmenu==1)
            {
                $('div#class-menu').removeClass('column-map left-pos-map');
                $('div#class-menu').addClass('fw-map');
                $('#right-menu').fadeOut();
                $('#menu').val(0);
                $('#hidewhenload').hide();
            }
            else
            {
                $('div#class-menu').addClass('column-map left-pos-map');
                $('div#class-menu').removeClass('fw-map');
                $('#right-menu').fadeIn();
                $('#menu').val(1);
                $('#hidewhenload').show();
                
            }
        });

        
    });

    function detail(kecamatan)
    {
        var kec=kecamatan.replace(/ /g,'%20');
        $('div#class-menu').addClass('column-map left-pos-map');
        $('div#class-menu').removeClass('fw-map');
        $('#right-menu').fadeIn();
        $('#menu').val(1);
        $('#right-menu').load('{{url("detail-data-kumuh")}}/'+(kec.toLowerCase()),function(){
            $('.chosen-select').selectbox();
        });

        $('#hidewhenload').show();
        
    }
    function detailkelurahan(kecamatan,kel)
    {
        if(kel!=0)
        {
            var kec=kecamatan.replace(/ /g,'%20');
            var kel=kel.replace(/ /g,'%20');
            $('#right-menu').load('{{url("detail-data-kumuh-kelurahan")}}/'+(kec.toLowerCase())+'/'+kel,function(){
                $('.chosen-select').selectbox();
            });
        }
        else
        {
            var kec=kecamatan.replace(' ','%20');
            $('div#class-menu').addClass('column-map left-pos-map');
            $('div#class-menu').removeClass('fw-map');
            $('#right-menu').fadeIn();
            $('#menu').val(1);
            $('#right-menu').load('{{url("detail-data-kumuh")}}/'+(kec.toLowerCase()),function(){
                $('.chosen-select').selectbox();
            });
            
            $('#hidewhenload').show();
        }
        
    }
    var APP_URL = {!! json_encode(url('/')) !!}
</script>