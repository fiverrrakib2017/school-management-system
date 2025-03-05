@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
<style>
    .speech-wrapper {
        background: #f9f9f9;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 30px;
    }
    .speech-title {
        font-size: 22px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
    }
    .speech-content {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }
    .speech-image {
        width: 100%;
        max-width: 180px;
        border: 1px solid #ddd;
        padding: 3px;
        background: #fff;
    }
    .speech-description {
        flex: 1;
        font-size: 15px;
        line-height: 1.7;
        color: #555;
        text-align: justify;
    }
    @media (max-width: 768px) {
        .speech-content {
            flex-direction: column;
        }
        .speech-image {
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
            @if($news)

            <div class="speech-wrapper">
                <h2 class="speech-title">{{ $news->title ?? '' }}</h2>

                <div class="speech-content">

                    @if($news->image)
                    <img src="{{ asset('Backend/uploads/photos/' . $news->image) }}" class="speech-image" alt="image">
                    @else
                        <img src="{{ asset('uploads/photos/avatar.png') }}" class="speech-image" alt="image" />
                    @endif
                    <div class="speech-description">
                        {!! $news->description !!}
                    </div>
                </div>
            </div>
            @else
            <div class="speech-wrapper">


                <div class="speech-content">

                  <h2 class="text-center" style="color:red;">No Data Found.</h2>
                </div>
            </div>
            @endif;
        </div>

        <!-- Notice Section -->
        @include('Frontend.Component.Notice')
        <!-- End Notice Section -->

    </div>
</div>

@endsection
