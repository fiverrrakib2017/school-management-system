@php

   $prefix= Request::route()->getPrefix();
   $route=Route::current()->getname();

@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>  @yield('title')</title>

    <!-- vendor css -->
    <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
     <link href="{{asset('Backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet"> 
    <link href="{{asset('Backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/css/toastr.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
    @yield('style')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
        @include('Backend.Include.Left_panel')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
        @include('Backend.Include.Header')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
        @include('Backend.Include.Right_Panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <!-- <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
          <h4>Dashboard</h4>
          <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
        </div>
      </div> -->

      <div class="br-pagebody">
        @yield('content')

      </div><!-- br-pagebody -->
       <!-- @include('Backend.Include.Footer')  -->
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{asset('Backend/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Backend/lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('Backend/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Backend/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('Backend/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('Backend/lib/peity/jquery.peity.min.js')}}"></script>

    <script src="{{asset('Backend/lib/rickshaw/vendor/d3.min.js')}}"></script>
    <script src="{{asset('Backend/lib/rickshaw/vendor/d3.layout.min.js')}}"></script>
    <script src="{{asset('Backend/lib/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('Backend/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('Backend/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('Backend/lib/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('Backend/lib/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('Backend/lib/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('Backend/lib/select2/js/select2.full.min.js')}}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script>
    <script src="{{asset('Backend/lib/gmaps/gmaps.min.js')}}"></script>

    
    <script src="{{asset('Backend/js/map.shiftworker.js')}}"></script>
    <script src="{{asset('Backend/js/ResizeSensor.js')}}"></script>
     <script src="{{asset('Backend/js/dashboard.js')}}"></script>
    <script src="{{asset('Backend/js/bracket.js')}}"></script>
    <script src="{{asset('Backend/js/toastr.min.js')}}"></script>
    @yield('script')
    <!-- <script>
      $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }
      });
    </script> -->
    
  </body>
</html>
