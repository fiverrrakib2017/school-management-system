@php
    $website_info = App\Models\Website_information::first();
@endphp
@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')
@section('content')
    <div class="row" id="main_div">
        <div class="col-md-12 ">
            <div class="card">
                <form action="{{ route('admin.student.class.routine.store') }}" method="POST" id="routineForm">
                    @csrf
                    <div class="card-header">
                        <div class="row" id="search_box">

                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label for="class_id" class="form-label">Class <span
                                            class="text-danger">*</span></label>
                                    <select name="class_id" id="class_id" class="form-control" style="width: 100%"
                                        required>
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
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <button type="button" name="submit_btn" class="btn btn-success"
                                        style="margin-top: 16px">
                                        <i class="fas fa-filter"></i> Filter Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="schedule_area d-none">
                        <div class="card-header">
                            <h4 class="mb-0">
                                <i class="far fa-clock mr-2"></i>
                                Class Routine Schedule
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive responsive-table">
                                <table class="table table-bordered text-nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 60px;">No.</th>
                                            <th style="min-width: 150px;">Subject</th>
                                            <th style="min-width: 120px;">Teacher</th>
                                            <th style="min-width: 120px;">Day</th>
                                            <th style="min-width: 100px;">Start Time</th>
                                            <th style="min-width: 100px;">End Time</th>
                                            <th style="min-width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="_data">
                                    </tbody>
                                </table>

                                <button type="button" class="btn btn-success mt-2" id="addMoreBtn">+ Add More</button>
                            </div>


                        </div>


                        <!-- Footer -->
                        <div class="card-footer text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fas fa-back"></i> Back
                            </button>
                            <button type="submit" name="submit_routine_btn" class="btn btn-primary ">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>



@endsection

@section('script')

    <script type="text/javascript">
        let rowCount = 0;
        $("select").select2();
        $(document).on('change', 'select[name="class_id"]', function() {
            var sections = @json($sections);
            /*Get Class ID*/
            var select_calss_id = $(this).val();

            var filteredSections = sections.filter(function(section) {
                /*Filter sections by class_id*/
                return section.class_id == select_calss_id;
            });
            /* Update Section dropdown*/
            var sectionOptions = '<option value="">--Select--</option>';
            filteredSections.forEach(function(section) {
                sectionOptions += '<option value="' + section.id + '">' + section.name + '</option>';
            });
            $('select[name="section_id"]').html(sectionOptions);
        });
        /* Add new routine row*/
        $('#addMoreBtn').on('click', function(e) {
            e.preventDefault();

            let newRow = `
                <tr class="routine-row">
                    <td>${++rowCount}</td>
                    <td>
                        <select class="form-control subject-select" name="routines[${rowCount}][subject_id]" required>
                            <option value="">--- Select ---</option>

                        </select>
                    </td>
                    <td>
                        <select class="form-control teacher-select" name="routines[${rowCount}][teacher_id]" required>
                            <option value="">--- Select ---</option>

                        </select>
                    </td>
                    <td>
                        <select class="form-control day-select" name="routines[${rowCount}][day]" required>
                            <option value="">--- Select ---</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>

                        </select>
                    </td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]" required></td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]" required></td>

                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                </tr>`;

            $('#_data').append(newRow);
            /*Get Subject class and section wise*/
            const classId = $('#class_id').val();
            const section_id = $('#section_id').val();
            if (classId) {
                $.ajax({
                    url: "{{ route('admin.student.subject_filter') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        class_id: classId,
                        section_id: section_id
                    },
                    success: function(res) {
                        const newSelect = $(' .routine-row:last .subject-select');
                        newSelect.empty().append('<option>---Select---</option>');
                        res.data.forEach(item => {
                            newSelect.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });


                    }
                });
            }
            /*Get Teacher */
            $.ajax({
                url: "{{ route('admin.teacher.get_teacher') }}",
                method: 'GET',
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                success: function(res) {
                    const newSelect = $(' .routine-row:last .teacher-select');
                    newSelect.empty().append('<option>---Select---</option>');
                    res.data.forEach(item => {
                        newSelect.append(
                            `<option value="${item.id}">${item.name}</option>`);
                    });


                }
            });
        });

        /* Remove row*/
        $(document).on('click', '.removeRow', function() {
            $(this).closest('.routine-row').remove();
        });


        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();

            var submitBtn = $(this);

            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
            );

            submitBtn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.student.class.routine.get_class_routine') }}",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    class_id: class_id,
                    section_id: section_id,
                },
                success: function(response) {
                    $(".schedule_area").removeClass('d-none');
                    var html = '';

                    const subjects = response.subjects;
                    const teachers = response.teachers;

                    // if (response.success && response.data.length === 0) {
                    //     toastr.info('No routine found for this class and section.');
                    //     return false;
                    // }
                    if (subjects.length === 0) {
                        toastr.error('No subjects found for this class and section.');
                        return false;
                    }
                    if (teachers.length === 0) {
                        toastr.error('No teachers found for this class and section.');
                        return false;
                    }
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(item) {
                            html += `
                                <tr class="routine-row">
                                    <td>${++rowCount}</td>
                                    <td>
                                        <select class="form-control subject-select" name="routines[${rowCount}][subject_id]" required>
                                            <option value="">--- Select ---</option>
                                            ${subjects.map(subject => `
                                                            <option value="${subject.id}" ${subject.id == item.subject_id ? 'selected' : ''}>
                                                                ${subject.name}
                                                            </option>
                                                        `).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control teacher-select" name="routines[${rowCount}][teacher_id]" required>
                                            <option value="">--- Select ---</option>
                                            ${teachers.map(teacher => `
                                                            <option value="${teacher.id}" ${teacher.id == item.teacher_id ? 'selected' : ''}>
                                                                ${teacher.name}
                                                            </option>
                                                        `).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control teacher-select" name="routines[${rowCount}][day]" required>
                                            <option value="">--- Select ---</option>
                                            <option value="Saturday" ${item.day == 'Saturday' ? 'selected' : ''}>Saturday</option>
                                            <option value="Sunday" ${item.day == 'Sunday' ? 'selected' : ''}>Sunday</option>
                                            <option value="Monday" ${item.day == 'Monday' ? 'selected' : ''}>Monday</option>
                                            <option value="Tuesday" ${item.day == 'Tuesday' ? 'selected' : ''}>Tuesday</option>
                                            <option value="Wednesday" ${item.day == 'Wednesday' ? 'selected' : ''}>Wednesday</option>
                                            <option value="Thursday" ${item.day == 'Thursday' ? 'selected' : ''}>Thursday</option>
                                            <option value="Friday" ${item.day == 'Friday' ? 'selected' : ''}>Friday</option>

                                        </select>
                                    </td>
                                    <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]" value="${item.start_time}" required></td>
                                    <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]" value="${item.end_time}" required></td>

                                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                                </tr>`;
                            $('#_data').html(html);
                        });

                    } else {
                        html += `
                                <tr class="routine-row">
                                    <td>${++rowCount}</td>
                                    <td>
                                        <select class="form-control subject-select" name="routines[${rowCount}][subject_id]" required>
                                            <option value="">--- Select ---</option>
                                                ${subjects.map(subject => `
                                                        <option value="${subject.id}">
                                                            ${subject.name}
                                                        </option>
                                                    `).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control teacher-select" name="routines[${rowCount}][teacher_id]" required>
                                            <option value="">--- Select ---</option>
                                            ${teachers.map(teacher => `
                                                    <option value="${teacher.id}">
                                                        ${teacher.name}
                                                    </option>
                                                `).join('')}
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control day-select" name="routines[${rowCount}][day]" required>
                                            <option value="">--- Select ---</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                        </select>
                                    </td>
                                    <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]"  required></td>
                                    <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]"required></td>

                                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                                </tr>
                            `;
                        $('#_data').html(html);
                    }



                },


                error: function() {
                    toastr.error('An error occurred. Please try again.');
                },
                complete: function() {
                    submitBtn.html(' <i class="fas fa-filter"></i> Filter');
                    submitBtn.prop('disabled', false);
                }

            });
        });


        handle_submit_form("#routineForm");

        function handle_submit_form(formSelector) {
            $(formSelector).submit(function(e) {
                e.preventDefault();

                /* Get the submit button */
                var submitBtn = $(this).find('button[type="submit"]');
                var originalBtnText = submitBtn.html();

                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden"></span>'
                    );
                submitBtn.prop('disabled', true);

                var form = $(this);
                var formData = new FormData(this);
                /* Send the form data using AJAX*/
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: formData,
                    beforeSend: function() {
                        form.find(':input').prop('disabled', true);
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
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
                        form.find(':input').prop('disabled', false);
                    }
                });
            });
        }
    </script>

@endsection
