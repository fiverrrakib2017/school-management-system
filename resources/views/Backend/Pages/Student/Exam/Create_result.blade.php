@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white" >Create Exam Result</h5>
                    <button type="button" onclick="history.back();" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.student.exam.result.store') }}" method="POST" id="examResultForm">
                        @csrf

                        <!-- Exam -->
                        <div class="mb-3">
                            <label for="exam_id" class="form-label"> Exam <span class="text-danger">*</span></label>
                            <select name="exam_id" id="exam_id" class="form-select" required>
                                <option value="" selected disabled>Select an Exam</option>
                                @php
                                    $exams = \App\Models\Student_exam::latest()->get();
                                @endphp
                                @foreach($exams as $exam)
                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Student -->
                        <div class="mb-3">
                            <label for="student_id" class="form-label"> Student <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" class="form-select" required>
                                <option value="" selected disabled>Select a Student</option>
                                @php
                                    $students = \App\Models\Student::latest()->get();
                                @endphp
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subject -->
                        <div class="mb-3">
                            <label for="subject_id" class="form-label"> Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" class="form-select" required>
                                <option value="" selected disabled>Select a Subject</option>
                                @php
                                    $subjects = \App\Models\Student_subject::latest()->get();
                                @endphp
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Marks Obtained -->
                        <div class="mb-3">
                            <label for="marks_obtained" class="form-label">Marks Obtained <span class="text-danger">*</span></label>
                            <input type="number" name="marks_obtained" id="marks_obtained" class="form-control" placeholder="Enter Marks Obtained" required>
                        </div>

                        <!-- Total Marks -->
                        <div class="mb-3">
                            <label for="total_marks" class="form-label">Total Marks <span class="text-danger">*</span></label>
                            <input type="number" name="total_marks" id="total_marks" class="form-control" placeholder="Enter Total Marks" required>
                        </div>

                        <!-- Grade -->
                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input type="text" name="grade" id="grade" class="form-control" placeholder="Enter Grade (Optional)">
                        </div>

                        <!-- Remarks -->
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control" placeholder="Enter Remarks (Optional)"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="reset" class="btn btn-danger me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Save Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('select').select2({
            placeholder: "---Select---",
            allowClear: false
        });

    });



    $("#examResultForm").submit(function(e) {
            e.preventDefault();

            /* Get the submit button */
            var submitBtn = $(this).find('button[type="submit"]');
            var originalBtnText = submitBtn.html();

            submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>');
            submitBtn.prop('disabled', true);

            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success==true) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            location.reload();
                        }, 500);

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        /* Validation error*/
                        var errors = xhr.responseJSON.errors;

                        /* Loop through the errors and show them using toastr*/
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                /* Display each error message*/
                                toastr.error(message);
                            });
                        });
                    } else {
                        /*General error message*/
                        toastr.error('An error occurred. Please try again.');
                    }
                },
                complete: function() {
                    submitBtn.html(originalBtnText);
                    submitBtn.prop('disabled', false);
                }
            });
        });

  </script>
@endsection
