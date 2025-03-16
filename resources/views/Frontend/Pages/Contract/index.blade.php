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

            <div class="col-md-9">
                <div class="blog-post">
                    <div class="headline">
                        <h2>Online service</h2>
                    </div>
                    <p>As a part of our continuous improvement to serve your chield better, we are
                        currently working on upgrading the quality of our institute. For any assistance,
                        please fill up and click on “Submit” button at the bottom of this page.<br><br>

                        Our sincere apology for any inconvenience.</p>
                    <br>

                    <span class="color-red"></span>
                    @if(session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    <div class="blog-item">
                        <div class="clearfix"></div>
                        <div class="blog-post-body row margin-top-15">


                            <div class="col-md-12">
                                <form method="post" action="{{ route('admin.settings.website.contract.store') }}">
                                    @csrf

                                    <!-- Name Field -->
                                    <label for="name">Name <span class="color-red">*</span></label>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-6 col-md-offset-0">
                                            <input name="name" id="name" placeholder="Enter Name" class="form-control" type="text" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <label for="email">E-mail</label>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-6 col-md-offset-0">
                                            <input name="email" id="email" placeholder="Enter E-mail" class="form-control" type="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Message Field -->
                                    <label for="msgText">Message <span class="color-red">*</span></label>
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-8 col-md-offset-0">
                                            <textarea name="message" id="message" placeholder="Enter Message" rows="8" class="form-control">{{ old('message') }}</textarea>
                                            @if ($errors->has('message'))
                                                <span class="text-danger">{{ $errors->first('message') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <button type="submit" name="guardian_cornar" class="btn btn-primary">Submit</button>
                                </form>

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
