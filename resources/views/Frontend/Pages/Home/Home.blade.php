@extends('Frontend.Layout.App')
@section('title','Welcome Our website')
@section('style')

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

        .teacher-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        .hover-zoom {
            transition: transform 0.3s ease;
        }
        .hover-zoom:hover {
            transform: scale(1.05);
        }
</style>
@endsection
@section('content')
@include('Frontend.Component.Marquee')
<div class="container no-padding">
    <div class="row">
        <!-- Carousel Slideshow -->
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Carousel Indicators -->

            <div class="clearfix"></div>
            <!-- End Carousel Indicators -->
            <!-- Carousel Images -->
            <div class="carousel-inner">
                <div class="item active">
                    @php
                        $slider = App\Models\Slider::limit(1)->get();
                    @endphp

                    @foreach ($slider as $key => $item)
                        <img src="{{ asset('Backend/uploads/photos/' . $item->image) }}" width="1080" height="400">
                    @endforeach


                </div>

                    @php
                        $slider = App\Models\Slider::limit(5)->get();
                    @endphp
                    @foreach ($slider as $key => $item)
                     <div class="item">
                            <img src="{{ asset('Backend/uploads/photos/' . $item->image) }}" width="1080" height="400">
                        </div>
                    @endforeach

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

<div class="container">
    <div class="row margin-vert-30">
        @php
            $banner = App\Models\Banner::latest()->first();
        @endphp

        @if($banner)
        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="welcome-section wow fadeInLeft" data-wow-duration="1.5s">
                <h2 class="welcome-title text-primary">
                   <a href="{{ route('banner.fullview', $banner->id) }}"> {{ $banner->title }}</a>
                </h2>
                <p class="text-justify">
                    @if($banner->description)
                        {{ \Illuminate\Support\Str::limit($banner->description, 300) }}
                    @else
                        স্বাগতম আমাদের ওয়েবসাইটে। এখানে আপনি প্রতিদিনের সকল তথ্য পেতে পারবেন। আমাদের সাথে থাকার জন্য ধন্যবাদ।
                    @endif
                    <br>
                    <a href="{{ route('banner.fullview', $banner->id) }}" class="btn btn-primary btn-sm wow bounceIn">আরও পড়ুন</a>
                </p>
                @if($banner->image)
                    <img class="img-responsive img-thumbnail animate fadeInUp" src="{{ asset('Backend/uploads/photos/' . $banner->image) }}" alt="Welcome Image">
                @else
                    <img class="img-responsive img-thumbnail animate fadeInUp" src="https://rzasc.com/uploads/frontend/home_page/wellcome116773260420225.jpeg" alt="Welcome Image">
                @endif
            </div>
        </div>
        @endif

        <!-- Notice Section -->
        @include('Frontend.Component.Notice')
        <!-- End Notice Section -->
    </div>

</div>



<div class="container background-gray-lighter py-5">
    <div class="row">
        <ul class="portfolio-group list-unstyled d-flex flex-wrap justify-content-between">
            @php
                $speech = App\Models\Speech::limit(4)->get();
            @endphp
            @foreach ($speech as $item)
                @php
                    $filePath = asset('Backend/uploads/photos/' . $item->image);
                @endphp
                <!-- Portfolio Item -->
                <li class="portfolio-item col-md-3 col-sm-4 col-xs-6 wow fadeInUp mb-4" data-wow-delay="0.2s">
                    <h3 class="text-center text-primary">{{ $item->title }}</h3>
                    <figure class="figure position-relative">
                        <img src="{{ $filePath }}" alt="ছবি" class="img-fluid rounded shadow-sm">
                        <figcaption class="figcaption position-absolute bottom-0 start-0 w-100 text-white p-3 bg-dark bg-opacity-50">
                            {{ \Illuminate\Support\Str::limit($item->description, 100) }}

                             <a href="{{ route('speech.fullview', $item->id) }}" class="text-warning text-decoration-none">More..</a>
                        </figcaption>
                    </figure>
                </li>
            @endforeach
        </ul>

    </div>
</div>
<section class="container py-5">
    <h2 class="text-center text-primary border-bottom pb-3" style="margin-top:15px;">শিক্ষকমণ্ডলী</h2>
    <hr>
    <div class="row">
        @php
            $teachers = App\Models\Teacher::limit(4)->get();
        @endphp
        @foreach ($teachers as $item)
            @php
                $filePath = $item->photo
                    ? asset('uploads/photos/' . $item->photo)
                    : "https://media.istockphoto.com/id/1341046662/vector/picture-profile-icon-human-or-people-sign-and-symbol-for-template-design.jpg?s=612x612&w=0&k=20&c=A7z3OK0fElK3tFntKObma-3a7PyO8_2xxW0jtmjzT78=";
            @endphp

            <!-- শিক্ষক  -->
            <div class="col-md-3 col-sm-6 mb-4 wow fadeInUp" data-wow-delay="0.2s" style="padding: 15px !important;">
                <div class="card shadow-sm">
                    <img src="{{ $filePath }}" class="card-img-top teacher-img" alt="শিক্ষক">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->designation }}</p>
                        <a href="teacher_profile.php?id={{ $item->id }}" class="btn btn-success">প্রোফাইল দেখুন</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>





<section class="container py-5">
    <h2 class="text-center text-primary pb-3 border-bottom" style="margin-top: 20px; font-size: 2.5rem; font-weight: bold;">গ্যালারি</h2>
    <hr class="mb-4">
    <div class="row g-4" style="padding: 15px !important;">
        @php
         $gallery = App\Models\Gallery::limit(4)->get();
        @endphp
        @foreach($gallery as $item)
            @php
                $filePath = $item->image
                    ? asset('Backend/uploads/photos/' . $item->image)
                    : "https://media.istockphoto.com/id/1341046662/vector/picture-profile-icon-human-or-people-sign-and-symbol-for-template-design.jpg?s=612x612&w=0&k=20&c=A7z3OK0fElK3tFntKObma-3a7PyO8_2xxW0jtmjzT78=";
            @endphp
            <div class="col-md-4 col-sm-6 mb-4 wow fadeInUp" data-wow-delay="0.2s" style="padding: 15px !important;">
                <a href="{{ $filePath }}" data-lightbox="gallery" data-title="Gallery Image 1">
                    <img src="{{ $filePath }}" alt="Gallery Image 1" class="img-fluid rounded shadow-sm hover-zoom">
                </a>
            </div>
        @endforeach
    </div>
</section>





@endsection
