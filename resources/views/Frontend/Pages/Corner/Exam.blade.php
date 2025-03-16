@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
<style>
    .table tbody tr {
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection

@section('content')

    <div class="container no-padding">
        <div class="row margin-vert-30">

            <!-- Main Content Section -->
            <div class="col-md-9">
                <div class="blog-post">
                    <div class="blog-item-header">
                        <h2>
                            <a>
                                <center><h3 style="color:#016B4F">:: Exam routine ::</h3></center><br>
                            </a>
                        </h2>
                    </div>

                    <div class="blog-item">
                        <div class="clearfix"></div>
                        <div class="blog-post-body row margin-top-15">


                            <div class="col-md-12">
                                <table width="1021" class="table table-bordered table-hover" id="example2">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="65%">Name</th>
                                            <th width="20%">Published Date</th>
                                            <th width="10%">Download</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                                                <td>{{ $item->id }}</td>

                                                <td>{{ $item->title }}</td>
                                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>

                                                <td>
                                                    @if ($item->image)
                                                        @php
                                                            $ext = pathinfo($item->image, PATHINFO_EXTENSION);
                                                        @endphp

                                                        @if ($ext === 'pdf')
                                                            <a href="{{ asset('Backend/uploads/photos/' . $item->image) }}" target="_blank" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-download"></i> Download PDF
                                                            </a>
                                                        @else
                                                            <a href="{{ asset('Backend/uploads/photos/' . $item->image) }}" data-lightbox="gallery" data-title="">
                                                                <img src="{{ asset('Backend/uploads/photos/' . $item->image) }}" alt="Gallery Image 1" class="img-fluid rounded shadow-sm hover-zoom"  style="max-width: 100px; max-height: 90px;">
                                                            </a>
                                                        @endif

                                                    @else
                                                        No file
                                                    @endif
                                                </td>

                                                <td>{{ $item->lesson }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $data->links('pagination::bootstrap-4') }}
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Blog Post -->
            </div>

            <!-- Notice Section -->
            @include('Frontend.Component.Notice')
            <!-- End Notice Section -->

        </div>
    </div>

@endsection
