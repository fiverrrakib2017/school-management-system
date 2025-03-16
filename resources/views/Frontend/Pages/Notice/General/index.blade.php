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
                                <center>
                                    <h3 style="color:#016B4F">:: General Notice ::</h3>
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
                                            <th width="16%">Date</th>
                                            <th width="84%">Title</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>

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
                                                    <a href="{{ route('notice.general.view', $item->id) }}">বিস্তারিত..</a>
                                                </td>
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
