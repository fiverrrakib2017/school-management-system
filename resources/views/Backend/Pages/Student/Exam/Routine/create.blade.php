@php
    $website_info = App\Models\Website_information::first();
@endphp
@extends('Backend.Layout.App')
@section('title', 'Dashboard | Admin Panel')

@section('content')
    <div class="row" id="main_div">
        <div class="col-md-12 ">
            <div class="card">
                <form action="{{ route('admin.student.exam.routine.store') }}" method="POST" id="routineForm">
                    @csrf
                    <div class="card-header">
                        <div class="row" id="search_box">
                            <div class="col-md-3">
                                <div class="form-group mb-2">
                                    <label for="exam_id" class="form-label">Examination Name <span
                                            class="text-danger">*</span></label>
                                    <select name="exam_id" id="exam_id" class="form-control" style="width: 100%;"
                                        required>
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
                                        <i class="fas fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="schedule_area d-none">
                        <div class="card-header">
                            <h4><i class="far fa-clock"></i>Add Exam Schedule</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive responsive-table">
                                <table class="table table-bordered text-nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 60px;">No.</th>
                                            <th style="min-width: 150px;">Subject</th>
                                            <th style="min-width: 120px;">Date</th>
                                            <th style="min-width: 100px;">Start</th>
                                            <th style="min-width: 100px;">End</th>
                                            <th style="min-width: 100px;">Hall</th>
                                            <th style="min-width: 150px;">Written</th>
                                            <th style="min-width: 150px;">Objective</th>
                                            <th style="min-width: 150px;">Practical</th>
                                            <th style="min-width: 80px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="_data">
                                        {{-- <tr class="routine-row">
                                            <td>0</td>
                                            <td>
                                                <select class="form-control  subject-select" name="routines[0][subject_id]"
                                                    required>
                                                    <option value="">--- Select ---</option>
                                                    @foreach (\App\Models\Student_subject::latest()->get() as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="date" class="form-control" name="routines[0][exam_date]" required>
                                            </td>
                                            <td><input type="time" class="form-control" name="routines[0][start_time]" required>
                                            </td>
                                            <td><input type="time" class="form-control" name="routines[0][end_time]" required>
                                            </td>
                                            <td><input type="text" class="form-control" name="routines[0][room_number]"
                                                    placeholder="Room No." required></td>
                                            <td>
                                                <input type="number" class="form-control mb-1" name="routines[0][written_full]"
                                                    placeholder="Full">
                                                <input type="number" class="form-control" name="routines[0][written_pass]"
                                                    placeholder="Pass">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control mb-1" name="routines[0][objective_full]"
                                                    placeholder="Full">
                                                <input type="number" class="form-control" name="routines[0][objective_pass]"
                                                    placeholder="Pass">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control mb-1" name="routines[0][practical_full]"
                                                    placeholder="Full">
                                                <input type="number" class="form-control" name="routines[0][practical_pass]"
                                                    placeholder="Pass">
                                            </td>
                                            <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                                        </tr> --}}
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
    <script src="{{ asset('Backend/assets/js/custom_select.js') }}"></script>
    <script type="text/javascript">

    let rowCount = 0;
        // $('select').select2({
        //         placeholder: "---Select---",
        //         allowClear: false
        //     });

        // Subject load by class ID
        $('#class_id').on('change', function() {
            const classId = $(this).val();
            if (!classId) return;

            $.ajax({
                url: "{{ route('admin.student.subject.get_subject_by_class') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    class_id: classId
                },
                success: function(res) {
                    // Update only the last added subject-select
                    $(' .routine-row').each(function() {
                        const select = $(this).find('.subject-select');
                        const currentValue = select.val();
                        select.empty().append('<option value="">Select</option>');
                        res.data.forEach(item => {
                            select.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                    });
                }
            });
        });
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
            // $('select[name="section_id"]').select2();


        });
        // Add new routine row
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
                                <td><input type="date" class="form-control" name="routines[${rowCount}][exam_date]" required></td>
                                <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]" required></td>
                                <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]" required></td>
                                <td><input type="text" class="form-control" name="routines[${rowCount}][room_number]" placeholder="Room No." required></td>
                                <td>
                                    <input type="number" class="form-control mb-1" name="routines[${rowCount}][written_full]" placeholder="Full">
                                    <input type="number" class="form-control" name="routines[${rowCount}][written_pass]" placeholder="Pass">
                                </td>
                                <td>
                                    <input type="number" class="form-control mb-1" name="routines[${rowCount}][objective_full]" placeholder="Full">
                                    <input type="number" class="form-control" name="routines[${rowCount}][objective_pass]" placeholder="Pass">
                                </td>
                                <td>
                                    <input type="number" class="form-control mb-1" name="routines[${rowCount}][practical_full]" placeholder="Full">
                                    <input type="number" class="form-control" name="routines[${rowCount}][practical_pass]" placeholder="Pass">
                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                            </tr>
                `;

            $('#_data').append(newRow);
            // Load subjects for this new row
            const classId = $('#class_id').val();
            if (classId) {
                $.ajax({
                    url: "{{ route('admin.student.subject.get_subject_by_class') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        class_id: classId
                    },
                    success: function(res) {
                        const newSelect = $(' .routine-row:last .subject-select');
                        newSelect.empty().append('<option value="">Select</option>');
                        res.data.forEach(item => {
                            newSelect.append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });


                    }
                });
            }

            // rowCount++;
        });
        // Remove row
        $(document).on('click', '.removeRow', function() {
            $(this).closest('.routine-row').remove();
        });



        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();
            var exam_id = $("select[name='exam_id']").val();
            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();
            var submitBtn = $(this);
            submitBtn.html(
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>`
            );
            submitBtn.prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.student.exam.routine.get_exam_routine') }}",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    exam_id: exam_id,
                    class_id: class_id,
                    section_id: section_id,
                },
                success: function(response) {
                    $(".schedule_area").removeClass('d-none');
                    var html = '';

                    const allSubjects = response.subjects;
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(item) {
                            html += `
                <tr class="routine-row">
                    <td>${++rowCount}</td>
                    <td>
                        <select class="form-control subject-select" name="routines[${rowCount}][subject_id]" required>
                            <option value="">--- Select ---</option>
                            ${allSubjects.map(subject => `
                                    <option value="${subject.id}" ${subject.id == item.subject_id ? 'selected' : ''}>
                                        ${subject.name}
                                    </option>
                                `).join('')}
                        </select>
                    </td>
                    <td><input type="date" class="form-control" name="routines[${rowCount}][exam_date]" value="${item.exam_date}" required></td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]" value="${item.start_time}" required></td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]" value="${item.end_time}" required></td>
                    <td><input type="text" class="form-control" name="routines[${rowCount}][room_number]" value="${item.room_number}" required></td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][written_full]" value="${item.written_full}" placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][written_pass]" value="${item.written_pass}" placeholder="Pass">
                    </td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][objective_full]" value="${item.objective_full}" placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][objective_pass]" value="${item.objective_pass}" placeholder="Pass">
                    </td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][practical_full]" value="${item.practical_full}" placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][practical_pass]" value="${item.practical_pass}" placeholder="Pass">
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                </tr>
            `;
            $('#_data').html(html);
                        });

                    } else {
                        html += `
                <tr class="routine-row">
                    <td>${++rowCount}</td>
                    <td>
                        <select class="form-control subject-select" name="routines[${rowCount}][subject_id]" required>
                            <option value="">--- Select ---</option>

                        </select>
                    </td>
                    <td><input type="date" class="form-control" name="routines[${rowCount}][exam_date]"  required></td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][start_time]"  required></td>
                    <td><input type="time" class="form-control" name="routines[${rowCount}][end_time]"required></td>
                    <td><input type="text" class="form-control" name="routines[${rowCount}][room_number]"  required></td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][written_full]"  placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][written_pass]"  placeholder="Pass">
                    </td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][objective_full]"  placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][objective_pass]"  placeholder="Pass">
                    </td>
                    <td>
                        <input type="number" class="form-control mb-1" name="routines[${rowCount}][practical_full]"  placeholder="Full">
                        <input type="number" class="form-control" name="routines[${rowCount}][practical_pass]"  placeholder="Pass">
                    </td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                </tr>
            `;
            $('#_data').html(html);
            const classId = $('#class_id').val();
                    if (classId) {
                        $.ajax({
                            url: "{{ route('admin.student.subject.get_subject_by_class') }}",
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                class_id: classId
                            },
                            success: function(res) {
                                const newSelect = $(' .routine-row:last .subject-select');
                                newSelect.empty().append(
                                '<option value="">Select</option>');
                                res.data.forEach(item => {
                                    newSelect.append(
                                        `<option value="${item.id}">${item.name}</option>`
                                        );
                                });


                            }
                        });
                    }
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
function handle_submit_form(formSelector){
    $(formSelector).submit(function(e) {
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
            beforeSend: function () {
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
