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
                <form class="login-page" action="#" method="POST">
                    @csrf
                    <div class="login-header margin-bottom-20">
                        <center><h3>RESULT BY ROLL</h3></center>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="exam_id" id="exam_id">
                            <option value="">Exam name</option>
                            @php
                                $exams = \App\Models\Student_exam::where('year', date('Y'))->get();
                            @endphp
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="class_id" id="class_id">
                            <option value="">Class</option>
                            @php
                                $classes = \App\Models\Student_class::latest()->get();
                            @endphp
                            @foreach($classes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group margin-bottom-20" id="id">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <select class="form-control select2" name="section_id" id="section_id">
                            <option value="">---Section---</option>
                        </select>
                    </div>

                    <div class="input-group margin-bottom-20" id="roll">
                        <span class="input-group-addon">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        <input type="text" placeholder="Enter your roll number" class="form-control" name="roll_number">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" name="submit_btn" id="print" type="submit">Print Progress report</button>
                        </div>
                    </div>
                    <hr>
                    <h5>Forget your roll  &nbsp; &nbsp; <a href="#">Click here</a> &nbsp; &nbsp;to know your ID.</h5>
                </form>
                </div>

        <!-- Notice Section -->

        <!-- End Notice Section -->

        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
    // $(document).ready(function(){
    //     alert('okkk');
    // });
/*********************** Student Filter and Condition*******************************/
    $(document).on('change', 'select[name="class_id"]', function() {

        var sections = @json($sections);
        /*Get Class ID*/
        var selectedClassId = $(this).val();

        var filteredSections = sections.filter(function(section) {
            /*Filter sections by class_id*/
            return section.class_id == selectedClassId;
        });


        /* Update Section dropdown*/
        var sectionOptions = '<option value="">--Select--</option>';
        filteredSections.forEach(function(section) {
            sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
        });


        $('select[name="section_id"]').html(sectionOptions);
    });
    $("button[name='submit_btn']").on('click', function(e) {
        e.preventDefault();
        var exam_id = $("select[name='exam_id']").val();
        var class_id = $("select[name='class_id']").val();
        var section_id = $("select[name='section_id']").val();
        var roll_number = $("input[name='roll_number']").val();

        if (!exam_id) {
            alert("Exam Name is require!!");
            return;
        }
        if (!class_id) {
            alert("Student Class Name is require!!");
            return;
        }
        if (!section_id) {
            alert("Student Class Name is require!!");
            return;
        }
        if (!roll_number) {
            alert("Roll Number is require!!");
            return;
        }
        $.ajax({
                type: 'POST',
                url: "{{ route('student.exam.result.get_result') }}",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    exam_id:exam_id,
                    class_id: class_id,
                    section_id: section_id,
                    roll_no:roll_number
                },
                success: function(response) {
                    if (response.success) {
                        var student_id = response.data[0].student_id;
                        var exam_id = response.data[0].exam_id;
                        var url = "{{ route('student.result.print', ['exam_id' => ':exam_id', 'student_id' => ':student_id']) }}";

                        url = url.replace(':exam_id', exam_id)
                                .replace(':student_id', student_id);

                        window.open(url, '_blank');
                    }
                    if (response.success == false) {
                       alert(response.message);
                    }
                },
                error: function() {
                    console.log('An error occurred. Please try again.');
                },

            });
    });
    </script>
@endsection
