
@php
$website_info=App\Models\Website_information::first();
@endphp

@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<style>
    /* Print CSS */
    @media print {
        #printButton {
            display: none;
        }
        .card {
            border: none;
            box-shadow: none;
        }
    }
    .school-header {
        text-align: center;
        padding: 15px;
    }
    .school-header img {
        height: 80px;
        width: 80px;
        margin-bottom: 10px;
    }
    .school-header h2 {
        font-weight: 100;
        margin-bottom: 5px;
    }
    .school-header p {
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }
    .info-box {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 16px;
        font-weight: bold;
    }
</style>
@endsection
@section('content')

<div class="row" id="main_div">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <div class="row" id="search_box">

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="exam_id" class="form-label">Examination Name <span class="text-danger">*</span></label>
                            <select name="exam_id" id="exam_id" class="form-control"  style="width: 100%"  required>
                                <option value="">---Select---</option>
                                @foreach(\App\Models\Student_exam::latest()->get() as $exam)
                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                            <select name="class_id"  class="form-control"  style="width: 100%"  required>
                                <option value="">---Select---</option>
                                @php
                                    $classes = \App\Models\Student_class::latest()->get();
                                @endphp
                                @if($classes->isNotEmpty())
                                    @foreach($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <label for="section_id" class="form-label">Section <span class="text-danger">*</span></label>
                            <select name="section_id" id="section_id" class="form-control"  style="width: 100%" >
                                <option value="">---Select---</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 ">
                        <div class="form-group mb-2">
                            <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                            <select name="subject_id" id="subject_id" class="form-control" style="width: 100%" >
                                <option value="">---Select---</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mt-3">
                            <button type="button" name="submit_btn" class="btn btn-success" style="margin-top: 16px">
                                <i class="fas fa-search"></i> Search Now</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="row d-none" id="table_area">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                {{-- <h4>Result Entries</h4> --}}
                <button id="printButton" class="btn btn-primary"><i class="fas fa-print"></i> </button>
            </div>
            <div class="card-body" id="printArea">
               <!-- School Header -->
                <div id="printHeader" class="school-header">
                    <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}" alt="School Logo">
                    <h2>{{ $website_info->name ?? 'Future ICT School' }}</h2>
                    <p>{{ $website_info->address ?? 'Daudkandi , Chittagong , Bangladesh' }}</p>

                    <span><strong><span id="examName"></span></strong><br>
                    <span><strong>Class:</strong> <span id="className"></span> | </span>
                    <span><strong>Section:</strong> <span id="sectionName"></span> | </span>
                    <span><strong>Subject:</strong> <span id="subjectName"></span></span>
                </div>

                <div class="table-responsive responsive-table">
                    <table id="" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th class="">SL</th>
                            <th class="">Student Name</th>
                            <th class="">Roll</th>
                            <th class="">Absent</th>
                            <th class="">Written Marks</th>
                            <th class="">Prectial Marks</th>
                            <th class="">Objective Marks</th>
                            <th class="">Total Marks</th>
                            <th class="">Grade</th>
                            <th class="">Remarks</th>
                        </tr>
                        </thead>
                        <tbody id="_data"></tbody>
                    </table>
                </div>

            </div>


            <div class="card-footer text-center">
                <!-- Submit Button -->
                <button type="submit" name="submit_result_btn" class="btn btn-success px-4">
                    <i class="fas fa-save"></i> Submit Results
                </button>

                <!-- Note -->
                <p class="text-danger mt-2" style="font-size: 14px; font-weight: 500;">
                    <i class="fas fa-exclamation-triangle"></i> Please check all the information before submitting the form.
                </p>
            </div>

        </div>

    </div>
</div>
@endsection

@section('script')
<script  src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
  <script type="text/javascript">
    $('select').select2({
        placeholder: "---Select---",
        allowClear: false
    });
    /*********************** Student Filter and Condition*******************************/
   $(document).on('change','select[name="class_id"]',function(){
        var sections = @json($sections);
        var subjects = @json($subjects);
        var students = @json($students);
        /*Get Class ID*/
        var selectedClassId = $(this).val();

        var filteredStudents = students.filter(function(student) {
            /*Filter class by class_id*/
            return student.current_class  == selectedClassId;
        });
        var filteredSections = sections.filter(function(section) {
            /*Filter sections by class_id*/
            return section.class_id == selectedClassId;
        });
        /* Update Subject dropdown*/
        var filteredSubjects = subjects.filter(function(subject) {
            /*Filter subject by class_id*/
            return subject.class_id == selectedClassId;
        });

        /* Update Student dropdown*/
        var studentOptions = '<option value="">--Select--</option>';
        filteredStudents.forEach(function(student) {
            studentOptions += '<option value="' + student.id + '">' + student.name + '</option>';
        });
        /* Update Section dropdown*/
        var sectionOptions = '<option value="">--Select--</option>';
        filteredSections.forEach(function(section) {
            sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
        });
        /* Update Subject dropdown*/
        var subjectOptions = '<option value="">--Select--</option>';
        filteredSubjects.forEach(function(subject) {
            subjectOptions += '<option value="' + subject.id + '">' + subject.name + '</option>';
        });

        $('select[name="student_id"]').html(studentOptions);
        $('select[name="student_id"]').select2();

        $('select[name="section_id"]').html(sectionOptions);
        $('select[name="section_id"]').select2();

        $('select[name="subject_id"]').html(subjectOptions);
        $('select[name="subject_id"]').select2();

    });

    /***********************  Student  Submit Result*******************************/
    $(document).on('click', 'button[name="submit_result_btn"]', function(e) {
        e.preventDefault();

        var formData = {
            exam_id: $("select[name='exam_id']").val(),
            class_id: $("select[name='class_id']").val(),
            section_id: $("select[name='section_id']").val(),
            subject_id: $("select[name='subject_id']").val(),
            results: []
        };

        $('tr[data-id]').each(function() {
            var studentId = $(this).data('id');
            var writtenMarks = $('input[name="written_marks[' + studentId + ']"]').val();
            var prectialMarks = $('input[name="prectial_marks[' + studentId + ']"]').val();
            var objectiveMarks = $('input[name="objective_marks[' + studentId + ']"]').val();
            var totalMarks = $('input[name="total_marks[' + studentId + ']"]').val();
            var grade = $('input[name="grade[' + studentId + ']"]').val();
            var remarks = $('input[name="remarks[' + studentId + ']"]').val();
            var isAbsent = $('input[name="is_absent[' + studentId + ']"]').is(':checked') ? 1 : 0;

            formData.results.push({
                student_id: studentId,
                written_marks: writtenMarks,
                prectial_marks: prectialMarks,
                objective_marks: objectiveMarks,
                total_marks: totalMarks,
                grade: grade,
                remarks: remarks,
                is_absent: isAbsent
            });
        });

        if (!formData.exam_id || !formData.class_id || !formData.subject_id) {
            toastr.error('Please fill in all the fields.');
            return false;
        }

        var submitBtn =  $('button[name="submit_result_btn"]');
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.student.exam.result.store') }}",
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success('Results submitted successfully.');
                } else {
                    toastr.error('An error occurred while submitting the results.');
                }
            },
            error: function() {
                toastr.error('An error occurred. Please try again.');
            },
            complete: function() {
                submitBtn.html('<i class="fas fa-save"></i> Submit Results');
                submitBtn.prop('disabled', false);
            }
        });
    });



    /*********************** Show Student Data For Submit Result*******************************/

    $("button[name='submit_btn']").on('click',function(e){
        e.preventDefault();
        var exam_id = $("select[name='exam_id']").val();
        var class_id = $("select[name='class_id']").val();
        var section_id = $("select[name='section_id']").val();
        var subject_id = $("select[name='subject_id']").val();
        if(exam_id == ''){
            toastr.error('Please Select Examination Name');
            return false;
        }
        if(class_id == ''){
            toastr.error('Please Select Class Name');
            return false;
        }
        if(subject_id == ''){
            toastr.error('Please Select Subject Name');
            return false;
        }

        $("#className").text($('select[name="class_id"] option:selected').text());
        $("#sectionName").text($('select[name="section_id"] option:selected').text());
        $("#subjectName").text($('select[name="subject_id"] option:selected').text());
        $("#examName").text($('select[name="exam_id"] option:selected').text());

        var submitBtn =  $('#search_box').find('button[name="submit_btn"]');
        submitBtn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`);
        submitBtn.prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.student.student_filter') }}",
            cache: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                class_id: class_id,
                section_id: section_id,
            },
            success: function(response) {
                $("#table_area").removeClass('d-none');

            var _number = 1;
            var html = '';

            /*Check if the response data is an array*/
            if (Array.isArray(response.data) && response.data.length > 0) {
                response.data.forEach(function(data) {

                    html += '<tr data-id="' + data.id + '">';
                    html += '<td>' + (_number++) + '</td>';
                    html += '<td>' + (data.name ? data.name : 'N/A') + '</td>';
                    html += '<td>' + (data.roll_no ? data.roll_no : 'N/A') + '</td>';
                    html += '<td><input type="checkbox" name="is_absent[' + data.id + ']"></td>';

                    html += '<td><input class="form-control written_marks"  type="text" name="written_marks[' + data.id + ']" data-id="' + data.id + '"></td>';

                    html += '<td><input class="form-control prectial_marks"  type="text" name="prectial_marks[' + data.id + ']" data-id="' + data.id + '"></td>';

                    html += '<td><input class="form-control objective_marks"  type="text" name="objective_marks[' + data.id + ']" data-id="' + data.id + '"></td>';

                    html += '<td><input class="form-control total_marks" type="text" name="total_marks[' + data.id + ']" data-id="' + data.id + '" value="100"></td>';

                    html += '<td><input class="form-control grade" Placeholder="Grade" type="text" name="grade[' + data.id + ']" data-id="' + data.id + '" readonly></td>';



                    html += '<td><input class="form-control" Placeholder="Enter Remarks" type="text" name="remarks[' + data.id + ']"></td>';

                    html += '</tr>';
                });
            } else {
                html += '<tr>';
                html += '<td colspan="10" style="text-align: center;">No Data Available</td>';
                html += '</tr>';
            }

            $("#_data").html(html);
        },
        error: function() {
            toastr.error('An error occurred. Please try again.');
        },
        complete:function(){
            submitBtn.html('<i class="fas fa-search"></i> Search Now');
            submitBtn.prop('disabled', false);
        }

        });
    });
    function _time_formate(time) {
        let [hour, minute, second] = time.split(':');
        hour = parseInt(hour);
        let ampm = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12;
        return `${hour}:${minute} ${ampm}`;
    }
    /*********************** Auto Grade Calculation*******************************/
    $(document).on('input', '.written_marks, .practical_marks, .objective_marks', function() {
        let rowId = $(this).attr('data-id');
            console.log("Row ID:", rowId);

            if (!rowId) {
                alert("Error: Row ID not found!");
                return;
            }

        let written = parseFloat($(`input[name="written_marks[${rowId}]"]`).val()) || 0;
        let practical = parseFloat($(`input[name="practical_marks[${rowId}]"]`).val()) || 0;
        let objective = parseFloat($(`input[name="objective_marks[${rowId}]"]`).val()) || 0;

        /* Total Marks Calculation*/
        let total = written + practical + objective;
        $(`input[name="total_marks[${rowId}]"]`).val(total);

        /* Calculate Grade*/
        let grade = calculateGrade(total);

        /*Update Grade Field*/
        $(`input[name="grade[${rowId}]"]`).val(grade);

        /* Calculate Remarks */
        let remarks = getRemarks(grade);
        $(`input[name="remarks[${rowId}]"]`).val(remarks);

    });

    /* Function to Determine Grade*/
    function calculateGrade(marks) {
        if (marks >= 80) return "A+";
        else if (marks >= 70) return "A";
        else if (marks >= 60) return "A-";
        else if (marks >= 50) return "B";
        else if (marks >= 40) return "C";
        else if (marks >= 33) return "D";
        else return "F";
    }

    /* Function to Determine Remarks */
    function getRemarks(grade) {
        let remarksMap = {
            "A+": "Excellent",
            "A": "Very Good",
            "A-": "Good",
            "B": "Satisfactory",
            "C": "Needs Improvement",
            "D": "Poor",
            "F": "Fail"
        };
        return remarksMap[grade] || "N/A";
    }
    /*********************** Print Student Reuslt Data *******************************/
    document.getElementById("printButton").addEventListener("click", function() {
        var printContents = document.getElementById("printArea").outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContents + "</body></html>";
        window.print();
        document.body.innerHTML = originalContents;
    });

  </script>
@endsection
