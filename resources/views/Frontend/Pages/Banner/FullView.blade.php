@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
<style>
    .banner-wrapper {
        background: #f9f9f9;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 30px;
    }
    .banner-title {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
    }
    .banner-content {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }
    .banner-image {
        width: 100%;
        max-width: 180px;
        border: 1px solid #ddd;
        padding: 3px;
        background: #fff;
    }
    .banner-description {
        flex: 1;
        font-size: 15px;
        line-height: 1.7;
        color: #555;
        text-align: justify;
    }
    @media (max-width: 768px) {
        .banner-content {
            flex-direction: column;
        }
        .banner-image {
            max-width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('content')

<div class="container no-padding">
    <div class="row margin-vert-30">

        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="banner-wrapper">
                <h2 class="banner-title">{{ $banner->title }}</h2>

                <div class="banner-content">
                    <img src="{{ asset('Backend/uploads/photos/' . $banner->image) }}" class="banner-image" alt="image">
                    <div class="banner-description">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Notice Section -->
        @include('Frontend.Component.Notice')
        <!-- End Notice Section -->

    </div>
</div>

@endsection
