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

            <div class="col-md-6  col-md-offset-3 col-sm-offset-3">
                <form class="login-page">
                    <div class="login-header margin-bottom-20">
                        <center><h3>RESULT BY ROLL</h3></center>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="exam_name" id="exam_name">
                            <option value="">Exam name</option>

                        </select>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="class" id="class">
                            <option value="">Class</option>

                        </select>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="section" id="section">
                            <option value="">Section</option>
                        </select>
                    </div>

                    <div class="input-group margin-bottom-20" id="roll">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        <input placeholder="Enter your roll number" class="form-control" id="students" type="text">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" id="print" type="button">Print Progress report</button>
                        </div>
                    </div>
                    <hr>
                    <h5>Forget your roll  &nbsp; &nbsp; <a href="student_corner.php">Click here</a> &nbsp; &nbsp;to know your ID.</h5>
                </form>
                </div>

        <!-- Notice Section -->

        <!-- End Notice Section -->

        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">

    </script>
@endsection
