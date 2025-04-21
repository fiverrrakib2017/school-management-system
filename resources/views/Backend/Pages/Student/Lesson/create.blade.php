@extends('Backend.Layout.App')
@section('title', 'Dashboard | Lesson Plan Create')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book"></i> Create Lesson Plan</h3>
                <div class="card-tools">
                    <a href="" class="btn btn-sm btn-danger">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.student.lesson.plan.store') }}" method="POST" id="handle_submit_form" enctype="multipart/form-data">@csrf
       
                <div class="card-body">
                    <div class="row">

                        <!-- Class -->
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control" style="width: 100%" required>
                                    <option value="">---Select---</option>
                                    @php
                                        $classes = \App\Models\Student_class::latest()->get();
                                    @endphp
                                    @if ($classes->isNotEmpty())
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="section_id" class="form-label">Section <span
                                        class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%">
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group mb-2">
                                <label for="subject_id" class="form-label">Subject <span
                                        class="text-danger">*</span></label>
                                <select name="subject_id" id="subject_id" class="form-control" style="width: 100%">
                                    <option value="">---Select---</option>
                                </select>
                            </div>
                        </div>

                       

                        <!-- Lesson Date -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lesson_date">Lesson Start Date</label>
                                <input type="date" name="lesson_start_date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Lesson Name -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="topic">Lesson Name</label>
                                <input type="text" name="lesson_name" class="form-control" placeholder="Enter Lesson Name" required>
                            </div>
                        </div>
                        <!-- Lesson Page -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lesson_range">Lesson Page Range</label>
                                <input type="text" name="lesson_range" class="form-control" placeholder="e.g. 3 to 8" required>
                            </div>
                        </div>
                        <!-- Approx Duration -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="duration">Approx Duration</label>
                                <select type="text" name="approx_duration" class="form-control" placeholder="e.g. 30 min" required>
                                    <option value="">---Select---</option>
                                    @php 
                                        for($i=1; $i <= 30 ; $i++){
                                            echo '<option value="'.$i.'">'.$i.' Day</option>';
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <!--QUESTION -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="duration">Q & A</label>
                                <select type="text" name="question_and_answer" class="form-control" placeholder="e.g. 30 min" required>
                                    <option value="">---Select---</option>
                                    @php 
                                        for($i=1; $i <= 30 ; $i++){
                                            echo '<option value="'.$i.'">'.$i.' Day</option>';
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <!--Teacher -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="teacher">Teacher</label>
                                <select type="text" name="teacher_id" class="form-control" required>
                                    <option value="">---Select---</option>
                                    @php
                                    $data = \App\Models\Teacher::latest()->get();
                                @endphp
                                @if ($data->isNotEmpty())
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                        

                        <!-- Message -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Write a brief message..."></textarea>
                            </div>
                        
                            <div class="form-check">
                                <input type="checkbox" name="is_send_message" class="form-check-input" id="is_send_message">
                                <label class="form-check-label" for="is_send_message">Send this message to the student</label>
                            </div>
                        </div>
                        

                    </div> <!-- /.row -->
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Lesson Plan
                    </button>
                </div>
            </form>

        </div> <!-- /.card -->

    </div><!-- /.container-fluid -->
</section>
@endsection


@section('script')
    <script src="{{ asset('Backend/assets/js/__handle_submit.js') }}"></script>
    <script type="text/javascript">
        handle_submit_form("#handle_submit_form"); 
        $('select').select2({
            placeholder: "---Select---",
            allowClear: false
        });
        /*********************** Student Filter and Condition*******************************/
        $(document).on('change', 'select[name="class_id"]', function() {
            var sections = @json($sections);
            var subjects = @json($subjects);
            /*Get Class ID*/
            var selectedClassId = $(this).val();

            var filteredSections = sections.filter(function(section) {
                /*Filter sections by class_id*/
                return section.class_id == selectedClassId;
            });
            /* Update Subject dropdown*/
            var filteredSubjects = subjects.filter(function(subject) {
                /*Filter subject by class_id*/
                return subject.class_id == selectedClassId;
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


            $('select[name="section_id"]').html(sectionOptions);
            $('select[name="section_id"]').select2();

            $('select[name="subject_id"]').html(subjectOptions);
            $('select[name="subject_id"]').select2();

        });

   


        /*********************** Show Student Data For Submit Result*******************************/

        $("button[name='']").on('click', function(e) {
            e.preventDefault();
            var exam_id = $("select[name='exam_id']").val();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();
            var subject_id = $("select[name='subject_id']").val();
            if (exam_id == '') {
                toastr.error('Please Select Examination Name');
                return false;
            }
            if (class_id == '') {
                toastr.error('Please Select Class Name');
                return false;
            }
            if (subject_id == '') {
                toastr.error('Please Select Subject Name');
                return false;
            }

            $("#className").text($('select[name="class_id"] option:selected').text());
            $("#sectionName").text($('select[name="section_id"] option:selected').text());
            $("#subjectName").text($('select[name="subject_id"] option:selected').text());
            $("#examName").text($('select[name="exam_id"] option:selected').text());

            var submitBtn = $('#search_box').find('button[name="submit_btn"]');
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
                );
            submitBtn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.student.search_result_before_upload') }}",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    class_id: class_id,
                    section_id: section_id,
                    subject_id: subject_id,
                    exam_id: exam_id
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


                            html +=
                                '<td><input type="checkbox" class="is_absent_checkbox" name="is_absent[' +
                                data.id + ']" ' + (data.is_absent == 1 ? 'checked' : '') +
                                '></td>';
                            html +=
                                '<td><input class="form-control written_marks" type="text" name="written_marks[' +
                                data.id + ']" value="' + (data.written_marks ?? '') + '"></td>';
                            html +=
                                '<td><input class="form-control objective_marks" type="text" name="objective_marks[' +
                                data.id + ']" value="' + (data.objective_marks ?? '') +
                                '"></td>';
                            html +=
                                '<td><input class="form-control practical_marks" type="text" name="practical_marks[' +
                                data.id + ']" value="' + (data.practical_marks ?? '') +
                                '"></td>';


                            html += '</tr>';
                        });
                    }

                    $("#_data").html(html);
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                },
                complete: function() {
                    submitBtn.html('<i class="fas fa-search"></i> Search Now');
                    submitBtn.prop('disabled', false);
                }

            });
        });

       
    </script>
@endsection
