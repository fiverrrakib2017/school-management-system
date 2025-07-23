@extends('Backend.Layout.App')
@section('title', 'Student Admin Card Generate')

@section('style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fas fa-user-graduate"></i>&nbsp;
                    <h5 class="mb-0 fw-semibold">Student Admit Card Generate</h5>
                </div>
                <div class="card-header">
                    <div class="row" id="search_box">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="exam_id" class="form-label">Examination Name <span
                                        class="text-danger">*</span></label>
                                <select name="exam_id" id="exam_id" class="form-control" style="width: 100%;" required>
                                    <option value="">---Select---</option>
                                    @foreach (\App\Models\Student_exam::latest()->get() as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->name }}--{{ $exam->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control" style="width: 100%;" required>
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
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%;" required>
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
                <div class="card-body d-none" id="print_area">

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="button" id="printBtn" class="btn btn-primary mb-2"><i class="fas fa-print"></i>
                                Generate Admit Card</button>
                        </div>
                    </div>
                    {{-- <button type="button" id="printBtn" class="btn btn-primary"><i class="fas fa-print"></i></button><br> --}}
                    <div class="table-responsive responsive-table">

                        <table id="datatable1" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>

                                    <th class=""><input type="checkbox" id="selectAll"
                                            class=" student-checkbox"></th>
                                    <th class="">No.</th>
                                    <th class="">Images</th>
                                    <th class="">Student Name </th>
                                    <th class="">Class </th>
                                    <th class="">Section </th>
                                    <th class="">Roll </th>
                                    <th class="">Phone Number</th>
                                    <th class="">Address</th>
                                </tr>
                            </thead>
                            <tbody id="_data">
                                <tr id="no-data">
                                    <td colspan="10" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $('select').select2({
            placeholder: "---Select---",
            allowClear: false
        });
        var students = @json($students);
        $(document).on('change', 'select[name="class_id"]', function() {
            var sections = @json($sections);
            var subjects = @json($subjects);
            var students = @json($students);
            /*Get Class ID*/
            var selectedClassId = $(this).val();

            var filteredStudents = students.filter(function(student) {
                /*Filter class by class_id*/
                return student.current_class == selectedClassId;
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

        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var exam_id = $("select[name='exam_id']").val();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();

            if (!exam_id) {
                toastr.error("Exam Name is require!!");
                return;
            }
            if (!class_id) {
                toastr.error("Student Class Name is require!!");
                return;
            }
            get_student(exam_id, class_id, section_id);

        });

        function get_student(exam_id, class_id, section_id) {
            var submitBtn = $('#search_box').find('button[name="submit_btn"]');
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
                );
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
                    var _number = 1;
                    var html = '';
                    $("#print_area").removeClass('d-none');
                    /*Check if the response data is an array*/
                    if (Array.isArray(response.data) && response.data.length > 0) {
                        response.data.forEach(function(data) {
                            html += '<tr data-id="' + data.id + '">';

                            html += '<td><input type="checkbox"  value="' + data.id + '" name="student_ids[]" class="Custom Checkbox student-checkbox"></td>';

                            html += '<td>' + (_number++) + '</td>';

                            var photo = data.photo ?
                            '<img src="' + "{{ asset('uploads/photos/') }}/" + data.photo + '"style="width: 50px; height: 50px; border-radius: 50%;">' :
                            '<img src="' + "{{ asset('uploads/photos/avatar.png') }}" + '"  style="width: 50px; height: 50px; border-radius: 50%;">';


                            html += '<td>' + photo + '</td>';


                            html += '<td>' + data.name + '</td>';
                            html += '<td>' + (data.current_class ? data.current_class.name : 'N/A') +
                                '</td>';
                            html += '<td>' + (data.section ? data.section.name : 'N/A') + '</td>';
                            html += '<td>' + data.roll_no + '</td>';
                            html += '<td>' + data.phone + '</td>';
                            html += '<td>' + data.current_address + '</td>';
                            html += '</tr>';
                        });
                    } else {
                        html += '<tr>';
                        html += '<td colspan="8" style="text-align: center;">No Data Available</td>';
                        html += '</tr>';
                    }

                    $("#_data").html(html);
                    $("#datatable1").DataTable();
                },
                error: function() {
                    toastr.error('An error occurred. Please try again.');
                },
                complete: function() {
                    submitBtn.html('<i class="fas fa-search"></i> Search Now');
                    submitBtn.prop('disabled', false);
                }

            });
        }


    /* Submit */


    $("#selectAll").on('click', function() {
            if ($(this).is(':checked')) {
                $(".student-checkbox").prop('checked', true);
            } else {
                $(".student-checkbox").prop('checked', false);
            }
        });
        $(document).on('click', '.student-checkbox', function() {
            if ($(".student-checkbox:checked").length == $(".student-checkbox").length) {
                $("#selectAll").prop('checked', true);
            } else {
                $("#selectAll").prop('checked', false);
            }
        });
        $(document).on('click', '#printBtn', function() {
            /*keep reference*/
            let print_button = $(this);

            /* Show spinner & disable button*/
            print_button.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Generating...`
            );
            print_button.prop('disabled', true);

            /* Delay spinner for 1s*/
            setTimeout(() => {
                var selectedIds = [];
                $(".student-checkbox:checked").each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    var url =
                        "{{ route('admin.student.admid.card.print', ['exam_id' => ':exam_id', 'student_ids' => ':student_ids']) }}";
                    url = url.replace(':exam_id', $("select[name='exam_id']").val());

                    var student_ids = selectedIds.join(',');
                    url = url.replace(':student_ids', student_ids);

                    window.open(url, '_blank');
                } else {
                    toastr.error("Please select at least one student.");
                }

                /* Restore button after task done*/
                print_button.html(`<i class="fas fa-print"></i> Generate Admit Card`);
                /* Enable button*/
                print_button.prop('disabled', false);

            }, 1000);
        });
    </script>
@endsection
