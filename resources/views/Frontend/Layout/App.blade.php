@php

    $website_info=App\Models\Website_information::first();
@endphp

<!-- === BEGIN HEADER === -->
<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->

<head>
    <!-- Title -->
    <title> সবাইকে স্বাগতম</title>
    <!-- Meta -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="খুব শিঘ্রই এই অংশটি আপডেট করা হবে। ">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('Frontend.Include.Style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
        new WOW().init();
    </script>
</head>

<body>
    <div id="body_bg">

        <div id="pre_header" class="container">
            <div class="row margin-top-10 visible-lg">
                <div class="col-md-6">
                    <p>
                        <strong>Phone :</strong>&nbsp; {{ $website_info->phone_number ?? '+88 01XXX XXXXX' }}
                    </p>
                </div><!-- col-md-6 end -->

                <div class="col-md-6 text-right"><!-- col-md-6 text-right start -->
                    <p style="display: inline-block; margin-right: 20px;">
                        <strong>Email :</strong>&nbsp;  {{ $website_info->email ?? 'info@yourwebsite.com' }}
                    </p>
                    <a href="{{ route('admin.login') }}" class="btn btn-primary btn-sm">Login</a>
                </div><!-- col-md-6 text-right end -->
            </div><!-- row margin-top-10 visible-lg end -->
        </div><!-- pre_header end -->

        <div class="primary-container-group">
            <!-- Background -->
            <div class="primary-container-background">
                <div class="primary-container"></div>
                <div class="clearfix"></div>
            </div>
            <!--End Background -->
            <div class="primary-container">
               @include('Frontend.Include.Header')
                <!-- Top Menu -->
                @include('Frontend.Include.Menu')
                <!-- End Top Menu -->
                <!-- === END HEADER === -->
                <!-- === BEGIN CONTENT === -->
                <div id="content">

                  <!-- Marquee Notice Start -->

					<!-- Marquee Notice End -->

                <!-- Marque notice end -->



                    @yield('content')
                </div>
            </div>
        </div>
        <!-- === END CONTENT === -->
        <!-- === BEGIN FOOTER === -->
        <div id="base">
            <div class="container padding-vert-30 margin-top-40">
                <div class="row">
                    <!-- Important Links -->
                    <div class="col-md-3 margin-bottom-20">
                        <h3 class="margin-bottom-15 text-primary">Important Links</h3>
                        <ul class="menu">
                            <li><a class="fa-link" href="http://bangladesh.gov.bd/" target="_blank">National Portal (BD)</a></li>
                            <li><a class="fa-link" href="http://www.dshe.gov.bd/" target="_blank">DSHE</a></li>
                            <li><a class="fa-link" href="http://www.nctb.gov.bd/" target="_blank">NCTB</a></li>
                            <li><a class="fa-link" href="http://emis.gov.bd/main/App_Pages/Client/Default.aspx" target="_blank">EMIS</a></li>
                            <li><a class="fa-link" href="http://www.ictd.gov.bd/" target="_blank">ICT Department</a></li>
                            <li><a class="fa-link" href="http://ntrca.gov.bd/">NTRCA</a></li>
                        </ul>
                    </div>

                    <!-- Additional Important Links -->
                    <div class="col-md-3 margin-bottom-20">
                        <h3 class="margin-bottom-15 text-primary">Additional Links</h3>
                        <ul class="menu">
                            <li><a class="fa-link" href="http://www.ebook.gov.bd/page.php?section=general&class=1">E-book</a></li>
                            <li><a class="fa-link" href="http://www.moedu.gov.bd/" target="_blank">Education Ministry</a></li>
                            <li><a class="fa-link" href="https://www.teachers.gov.bd/" target="_blank">Teachers Portal</a></li>
                            <li><a class="fa-link" href="http://www.dainikshiksha.com/">Dainikshiksha.com</a></li>
                            <li><a class="fa-link" href="all_board_result.php">Result of SSC & JSC</a></li>
                            <li><a class="fa-link" href="http://bangladesh.gov.bd/site/view/all_eservices/%E0%A6%B8%E0%A6%95%E0%A6%B2-%E0%A6%87-%E0%A6%B8%E0%A7%87%E0%A6%AC%E0%A6%BE" target="_blank">All e-services</a></li>
                        </ul>
                    </div>

                    <!-- Attendance Info -->
                    <div class="col-md-3 margin-bottom-20">
                        <h3 class="margin-bottom-15 text-primary">Attendance</h3>
                        <ul class="menu">
                            <li><a class="fa-angle-double-right" href="#">Total Students: 500</a></li>
                            <li><a class="fa-angle-double-right" href="#">Present: 450</a></li>
                            <li><a class="fa-angle-double-right" href="#">Absent: 50</a></li>
                            <li><a class="fa-angle-double-right" href="#">Total Teachers/Staff: 22</a></li>
                            <li><a class="fa-angle-double-right" href="#">Present: 21</a></li>
                            <li><a class="fa-angle-double-right" href="#">Absent: 1</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-md-3 margin-bottom-20">
                        <h3 class="margin-bottom-15 text-primary">Contact Us</h3>
                        <p><strong>{{ $website_info->name ?? 'Your Website' }}</strong><br> Address: {{ $website_info->address ?? 'Your Address' }}</p>
                        <p>
                            <span class="fa-phone">:</span> <a href="http://it-fast.com/education_management.html">{{ $website_info->phone_number ?? '+88 01XXX XXXXX' }}</a><br>
                            <span class="fa-envelope">:</span> <a href="mailto:info@yourwebsite.com">{{
                                $website_info->email ?? 'info@yourwebsite.com' }}</a>
                        </p>

                        <br />
                        <a class="fa-users" href="#">Total Visitors: 58</a><br />
                        <a class="fa-user" href="#">Visitor Today: 0</a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>


        <!-- Footer Menu -->
        @include('Frontend.Include.Footer')
        <!-- JS -->
       @include('Frontend.Include.Script')
       @yield('script')
    </div> <!-- End JS -->
</body>

</html>
