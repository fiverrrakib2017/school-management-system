@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
@endsection

@section('content')

<div class="container no-padding">
    <div class="row margin-vert-30">

        <!-- Main Content Section -->
        <div class="col-md-12">
            <section class="container py-5">
                <h2 class="text-center text-primary pb-3 border-bottom" style="margin-top: 20px; font-size: 2.5rem; font-weight: bold;">গ্যালারি</h2>
                <hr class="mb-4">
                <div class="row g-4" style="padding: 15px !important;">
                    @php
                     $gallery = App\Models\Gallery::get();
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
        </div>



    </div>
</div>

@endsection
