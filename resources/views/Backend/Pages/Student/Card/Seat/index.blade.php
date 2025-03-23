@extends('Backend.Layout.App')
@section('title', 'Student Seat Plan')

@section('style')
    <style>
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
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
                                <select name="section_id" id="section_id" class="form-control" style="width: 100%;"
                                    required>
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

            $('select[name="student_id"]').html(studentOptions);
            $('select[name="student_id"]').select2();

            $('select[name="section_id"]').html(sectionOptions);
            $('select[name="section_id"]').select2();


        });

        $("button[name='submit_btn']").on('click', function(e) {
            e.preventDefault();

            var class_id = $("select[name='class_id']").val();
            var section_id = $("select[name='section_id']").val();
            var exam_id = $("select[name='exam_id']").val();

            if (!class_id) {
                toastr.error("Student Class Name is required!!");
                return;
            }

            var student_id = $("input[name='student_id']").val();

            var url =
                "{{ route('admin.student.seat_plan_print', ['exam_id' => ':exam_id', 'class_id' => ':class_id', 'section_id' => ':section_id']) }}";
            url = url.replace(':exam_id', exam_id)
                .replace(':class_id', class_id)
                .replace(':section_id', section_id);

            window.open(url, '_blank');
        });
    </script>
@endsection
