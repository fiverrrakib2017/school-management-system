@extends('Frontend.Layout.App')
@section('title','Welcome Our website')
@section('content')
<div class="container no-padding">
    <div class="row">
        <!-- Carousel Slideshow -->
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Carousel Indicators -->

            <div class="clearfix"></div>
            <!-- End Carousel Indicators -->
            <!-- Carousel Images -->
            <div class="carousel-inner">
                <div class="item active"><img
                        src="https://rzasc.com/uploads/frontend/images/logo117108410850319.png"
                        width="1080" height="400"></div>
                <div class="item"><img
                        src="https://rzasc.com/uploads/frontend/images/logo117108410850319.png"
                        width="1080" height="400"></div>
                <div class="item"><img
                        src="https://rzasc.com/uploads/frontend/images/logo117108410850319.png"
                        width="1080" height="400"></div>
            </div>
            <!-- End Carousel Images -->
            <!-- Carousel Controls -->
            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            <!-- End Carousel Controls -->
        </div>
        <!-- End Carousel Slideshow -->
    </div>
</div>

{{-- <div class="container">
    <div class="row margin-vert-30">
        <!-- Main Text -->
        <div class="col-md-9">
            <h2>স্বাগতম রামনগর জেড.এ. স্কুল এন্ড কলেজের নিজস্ব ওয়েবসাইটে</h2>
            <p align="justify">২০০৭ সালে প্রতিষ্ঠিত রামনগর জেড.এ. উচ্চ বিদ্যালয় এর ধারাবাহিক সাফল্যে এলাকাবসীর দাবী ও শিক্ষার্থীদের চাহিদার প্রেক্ষিতে ডিজিটাল বাংলাদেশ গড়ার প্রত্যয়ে প্রতিষ্ঠিত করা হয়েছে। এই প্রতিষ্ঠানটি বর্তমানে কুমিল্লা জেলার অন্যতম শিক্ষা প্রতিষ্ঠানে পরিনত হয়েছে। এটি প্রতিষ্ঠানের পরিচালকবৃন্দ, শিক্ষকবৃন্দ, অভিভাবকবৃন্দ, শিক্ষার্থীদের ও সর্বোপরি এলাকাবাসীর সমন্বিত প্রচেষ্টার ফল। এলাকাবাসীর সেবার মনোভাব নিয়ে মান সম্পন্ন শিক্ষা প্রসারে এবং কৃতিত্বপূর্ণ ফল অর্জন করে এই প্রতিষ্ঠানটি ইতিমধ্যে একটি স্থান করে নিয়েছে। প্রতিষ্ঠানের সার্বিক ক্ষেত্রে সফলতার জন্য মানুষের মাঝে এক ধরনের চাহিদা সৃষ্টি হওয়ায় তাঁরা তাঁদের কোমলমতি ছেলে মেয়েদের এই প্রতিষ্ঠানে পড়াশুনা করাতে যথেষ্ট আগ্রহী হয়ে উঠেছেন। ...<a href="fullview.php?msg=5"> more..</a></p>
            <img class="visible-lg animate fadeInUp"
                style="bottom: -50px; position: relative; left: 0px; margin-top: -20px;"
                src="https://rzasc.com/uploads/frontend/home_page/wellcome116773260420225.jpeg" width="750px"
                height="350px" alt="Well come to our INSTITUTE">
        </div>
        <!-- End Main Text -->
        <!-- Side Column -->
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Important Notices</h3>
                </div>
                <div class="panel-body">

                    <marquee direction="up" scrollamount="3"
                        onmouseover="this.setAttribute('scrollamount', 0, 0);"
                        onmouseout=" this.setAttribute('scrollamount', 2, 0);">
                        <a href="full_impnotice.php?id=2">আপডেট<br><br></a>
                        <a href="full_impnotice.php?id=2">আপডেট<br><br></a>
                        <a href="full_impnotice.php?id=2">আপডেট<br><br></a>
                    </marquee>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">General Notices</h3>
                </div>

                <div class="panel-body">
                    <marquee direction="up" scrollamount="3"
                        onmouseover="this.setAttribute('scrollamount', 0, 0);"
                        onmouseout="	this.setAttribute('scrollamount', 2, 0);">
                        <a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা,
                            ২০১৫<br><br></a>
                        <a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা,
                            ২০১৫<br><br></a>
                        <a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা,
                            ২০১৫<br><br></a>
                        <a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা,
                            ২০১৫<br><br></a>
                        <a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা,
                            ২০১৫<br><br></a>
                    </marquee>

                </div>
            </div>
        </div>
        <!-- End Side Column -->
    </div>
</div> --}}

<div class="container">
    <div class="row margin-vert-30">
        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="welcome-section wow fadeInLeft" data-wow-duration="1.5s">
                <h2 class="welcome-title text-primary">
                    স্বাগতম রামনগর জেড.এ. স্কুল এন্ড কলেজের নিজস্ব ওয়েবসাইটে
                </h2>
                <p class="text-justify">
                    ২০০৭ সালে প্রতিষ্ঠিত রামনগর জেড.এ. উচ্চ বিদ্যালয় এর ধারাবাহিক সাফল্যে এলাকাবসীর দাবী ও শিক্ষার্থীদের চাহিদার প্রেক্ষিতে ডিজিটাল বাংলাদেশ গড়ার প্রত্যয়ে প্রতিষ্ঠিত করা হয়েছে।
                    <br>
                    <a href="fullview.php?msg=5" class="btn btn-primary btn-sm wow bounceIn">আরও পড়ুন</a>
                </p>
                <img class="img-responsive img-thumbnail animate fadeInUp" src="https://rzasc.com/uploads/frontend/home_page/wellcome116773260420225.jpeg" alt="Welcome Image">
            </div>
        </div>
        <!-- End Main Content Section -->

        <!-- Sidebar Section -->
        <div class="col-md-3">
            <!-- Important Notices -->
            <div class="panel panel-danger wow fadeInRight" data-wow-duration="1.5s">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-bell"></i> জরুরি বিজ্ঞপ্তি</h3>
                </div>
                <div class="panel-body notice-box">
                    <marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                        <ul class="notice-list">
                            <li><a href="full_impnotice.php?id=2">শিক্ষা কার্যক্রম সংক্রান্ত নোটিশ</a></li>
                            <li><a href="full_impnotice.php?id=3">শিক্ষার্থীদের জন্য নির্দেশনা</a></li>
                            <li><a href="full_impnotice.php?id=4">নতুন অ্যাডমিশন নোটিশ</a></li>
                        </ul>
                    </marquee>
                </div>
            </div>

            <!-- General Notices -->
            <div class="panel panel-info wow fadeInRight" data-wow-delay="0.5s">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> সাধারণ বিজ্ঞপ্তি</h3>
                </div>
                <div class="panel-body notice-box">
                    <marquee direction="up" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
                        <ul class="notice-list">
                            <li><a href="full_gnnotice.php?id=3">জাতীয় তথ্য ও যোগাযোগ প্রযুক্তি নীতিমালা</a></li>
                            <li><a href="full_gnnotice.php?id=4">নতুন শিক্ষাবর্ষের একাডেমিক ক্যালেন্ডার</a></li>
                            <li><a href="full_gnnotice.php?id=5">শিক্ষার্থীদের নতুন সময়সূচি</a></li>
                            <li><a href="full_gnnotice.php?id=5">শিক্ষার্থীদের নতুন সময়সূচি</a></li>
                            <li><a href="full_gnnotice.php?id=5">শিক্ষার্থীদের নতুন সময়সূচি</a></li>
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
        <!-- End Sidebar Section -->
    </div>
</div>

<style>
    /* Welcome Section */
.welcome-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

/* Welcome Title */
.welcome-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Notice Boxes */
.notice-box {
    max-height: 200px;
    overflow: hidden;
    padding: 10px;
    background: #fff;
    border-radius: 5px;
}

/* Notice List */
.notice-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.notice-list li {
    padding: 5px 0;
    border-bottom: 1px solid #ddd;
}

.notice-list li a {
    color: #333;
    font-weight: bold;
    text-decoration: none;
    display: block;
}

.notice-list li a:hover {
    color: #007bff;
}

/* Responsive Adjustments */
@media (max-width: 767px) {
    .welcome-section {
        padding: 15px;
    }

    .notice-box {
        max-height: 150px;
    }

    .notice-list li {
        font-size: 14px;
    }
}

</style>


<div class="container background-gray-lighter py-5">
    <div class="row">
        <ul class="portfolio-group list-unstyled d-flex flex-wrap justify-content-between">
            <!-- Portfolio Item 1 -->
            <li class="portfolio-item col-md-3 col-sm-4 col-xs-6 wow fadeInUp mb-4" data-wow-delay="0.2s">
                <h3 class="text-center text-primary">সভাপতির বাণী</h3>
                <figure class="figure position-relative">
                    <img src="https://rzasc.com/uploads/frontend/home_page/featured-parallax116773259770225.jpeg" alt="সভাপতির ছবি" class="img-fluid rounded shadow-sm">
                    <figcaption class="figcaption position-absolute bottom-0 start-0 w-100 text-white p-3 bg-dark bg-opacity-50">
                        খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে।
                        <a href="fullview.php?msg=3" class="text-warning text-decoration-none">More..</a>
                    </figcaption>
                </figure>
            </li>
            <!-- Portfolio Item 2 -->
            <li class="portfolio-item col-md-3 col-sm-4 col-xs-6 wow fadeInUp mb-4" data-wow-delay="0.4s">
                <h3 class="text-center text-primary">প্রতিষ্ঠান প্রধানের বাণী</h3>
                <figure class="figure position-relative">
                    <img src="https://rzasc.com/uploads/images/staff/975fc2f6479d89d38604565673afa5b5.jpg" alt="প্রতিষ্ঠান প্রধান" class="img-fluid rounded shadow-sm">
                    <figcaption class="figcaption position-absolute bottom-0 start-0 w-100 text-white p-3 bg-dark bg-opacity-50">
                        খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে।
                        <a href="fullview.php?msg=3" class="text-warning text-decoration-none">More..</a>
                    </figcaption>
                </figure>
            </li>
            <!-- Portfolio Item 3 -->
            <li class="portfolio-item col-md-3 col-sm-4 col-xs-6 wow fadeInUp mb-4" data-wow-delay="0.6s">
                <h3 class="text-center text-primary">সহঃ প্রতিষ্ঠান প্রধান</h3>
                <figure class="figure position-relative">
                    <img src="https://rzasc.com/uploads/images/staff/20505a106d957f8bc277a9c1985c822a.jpg" alt="সহঃ প্রতিষ্ঠান প্রধান" class="img-fluid rounded shadow-sm">
                    <figcaption class="figcaption position-absolute bottom-0 start-0 w-100 text-white p-3 bg-dark bg-opacity-50">
                        খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে।
                        <a href="fullview.php?msg=3" class="text-warning text-decoration-none">More..</a>
                    </figcaption>
                </figure>
            </li>
            <!-- Portfolio Item 4 -->
            <li class="portfolio-item col-md-3 col-sm-4 col-xs-6 wow fadeInUp mb-4" data-wow-delay="0.8s">
                <h3 class="text-center text-primary">সহঃ প্রতিষ্ঠান প্রধান</h3>
                <figure class="figure position-relative">
                    <img src="https://rzasc.com/uploads/images/staff/20505a106d957f8bc277a9c1985c822a.jpg" alt="সহঃ প্রতিষ্ঠান প্রধান" class="img-fluid rounded shadow-sm">
                    <figcaption class="figcaption position-absolute bottom-0 start-0 w-100 text-white p-3 bg-dark bg-opacity-50">
                        খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে। খুব শীঘ্রই এই অংশটি আপডেট করা হবে।
                        <a href="fullview.php?msg=3" class="text-warning text-decoration-none">More..</a>
                    </figcaption>
                </figure>
            </li>
        </ul>
    </div>
</div>

<style>
     .portfolio-item {
            position: relative;
            overflow: hidden;
            text-align: center;
            margin-bottom: 20px;
        }
        .portfolio-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            transition: transform 0.3s;
        }
        .portfolio-item:hover img {
            transform: scale(1.1);
        }
        .portfolio-item figcaption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .portfolio-item:hover figcaption {
            opacity: 1;
        }
        .portfolio-item h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }
</style>
@endsection
