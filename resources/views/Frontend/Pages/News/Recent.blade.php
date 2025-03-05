@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
    <style>

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
                                <center>
                                    <h3 style="color:#016B4F">:: Recent news ::</h3>
                                </center><br>
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
                                            <th width="16%">Picture</th>
                                            <th width="84%">News</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $item)
                                            <tr>
                                                <td style="padding-left:3px" width="13%" align="center">
                                                    @if($item->image)
                                                        <img src="{{ asset('Backend/uploads/photos/'.$item->image) }}" width="120" height="75" />
                                                    @else
                                                        <img src="{{ asset('uploads/photos/avatar.png') }}" width="120" height="75" />
                                                    @endif
                                                </td>

                                                <td style="padding-left:6px" width="76%" align="justify">
                                                    <span style="color:#EE2E43">&nbsp;{{ $item->title }}</span><br>
                                                    <span style="margin:0px;">
                                                        &nbsp;
                                                        @if($item->description)
                                                            {{ \Illuminate\Support\Str::limit($item->description, 400) }}
                                                        @else
                                                            আমাদের ওয়েবসাইটে। এখানে আপনি প্রতিদিনের সকল তথ্য পেতে পারবেন। আমাদের সাথে থাকার জন্য ধন্যবাদ।
                                                        @endif
                                                        ...
                                                    </span>
                                                    <a href="{{ route('recent.news.view', $item->id) }}">বিস্তারিত..</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $news->links('pagination::bootstrap-4') }}
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
