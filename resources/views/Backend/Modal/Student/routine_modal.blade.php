<div class="modal fade bs-example-modal-lg" id="editRoutineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoutineModalLabel">
                    <span class="mdi mdi-account-check mdi-18px"></span> &nbsp;Edit Examination Routine
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST"  id="editRoutineForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Examination Name</label>
                            <select name="exam_id" class="form-control" type="text" style="width: 100%;" required>
                                <option value="">---Select---</option>
                                @php
                                    $exams = \App\Models\Student_exam::latest()->get();
                                @endphp
                                @if($exams->isNotEmpty())
                                    @foreach($exams as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Class Name</label>
                            <select name="class_id" class="form-control" type="text" style="width: 100%;" required>
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

                    <div class="row">
                         <div class="col-md-6 mb-2">
                            <label>Subject Name</label>
                            <select name="subject_id" class="form-control" type="text" style="width: 100%;" required>
                                <option value="">---Select---</option>
                                @php
                                    $subjects = \App\Models\Student_subject::latest()->get();
                                @endphp
                                @if($subjects->isNotEmpty())
                                    @foreach($subjects as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Exam Date</label>
                            <input  type="date" name="exam_date" class="form-control"  required />
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Start Time</label>
                            <input type="time"  name="start_time" class="form-control" required />

                        </div>
                        <div class="col-md-6 mb-2">
                            <label>End Time</label>
                            <input type="time" name="end_time" class="form-control"  required />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Room Number</label>
                            <input type="number" name="room_number" class="form-control" type="text" placeholder="Enter Room Number" required />

                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Invigilator Name</label>
                            <input name="invigilator_name" class="form-control" type="text" placeholder="Enter Invigilator Name" required />

                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Modal HTML -->
<div class="modal fade" id="routineModal" tabindex="-1" role="dialog" aria-labelledby="routineModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.student.exam.routine.store') }}" method="POST" id="routineForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('Backend/uploads/photos/' . ($website_info->logo ?? 'default-logo.jpg')) }}"
                            height="50" />
                        &nbsp; {{ $website_info->name ?? 'Future ICT School' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Examination Name</label>
                            <select name="exam_id" class="form-control subject-select" required>
                                <option value="">--- Select ---</option>
                                @foreach (\App\Models\Student_exam::latest()->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Class Name</label>
                            <select name="class_id" class="form-control subject-select" id="class_id" required>
                                <option value="">--- Select ---</option>
                                @foreach (\App\Models\Student_class::latest()->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="routine-rows">
                        <!-- Routine Row Template -->
                        <div class="routine-row row mb-2">
                            <div class="col-md-2"><label>Exam Date</label><input type="date"
                                    name="routines[0][exam_date]" class="form-control" required></div>

                            <div class="col-md-2">
                                <label>Subject</label>
                                <select name="routines[0][subject_id]" class="form-control subject-select" required>
                                    <option value="">--- Select ---</option>
                                    {{-- @foreach (\App\Models\Student_subject::latest()->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Start Time</label>
                                <input type="time" name="routines[0][start_time]" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label>End Time</label>
                                <input type="time" name="routines[0][end_time]" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label>Room No</label>
                                <input type="text" name="routines[0][room_number]" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label>Invigilator</label>
                                <input type="text" name="routines[0][invigilator_name]" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success" id="addMoreBtn">+ Add More</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save All</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('Backend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        let rowCount = 1;

        // Initialize Select2 on the first select
        $('.subject-select').select2({ width: '100%' });

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
                    $('#routine-rows .routine-row').each(function() {
                        const select = $(this).find('.subject-select');
                        const currentValue = select.val();
                        select.empty().append('<option value="">--- Select ---</option>');
                        res.data.forEach(item => {
                            select.append(`<option value="${item.id}">${item.name}</option>`);
                        });

                        // Re-init select2
                        select.select2({ width: '100%' });
                    });
                }
            });
        });

        // Add new routine row
        $('#addMoreBtn').on('click', function(e) {
            e.preventDefault();

            let newRow = `
                <div class="routine-row row mb-2">
                    <div class="col-md-2"><input type="date" name="routines[${rowCount}][exam_date]" class="form-control" required></div>

                    <div class="col-md-2">
                        <select name="routines[${rowCount}][subject_id]" class="form-control subject-select" required>
                            <option value="">--- Select ---</option>
                        </select>
                    </div>

                    <div class="col-md-2"><input type="time" name="routines[${rowCount}][start_time]" class="form-control" required></div>
                    <div class="col-md-2"><input type="time" name="routines[${rowCount}][end_time]" class="form-control" required></div>
                    <div class="col-md-2"><input type="text" name="routines[${rowCount}][room_number]" class="form-control" required></div>
                    <div class="col-md-1"><input type="text" name="routines[${rowCount}][invigilator_name]" class="form-control" required></div>
                    <div class="col-md-1"><button type="button" class="btn btn-danger remove-row">&times;</button></div>
                </div>`;

            $('#routine-rows').append(newRow);

            // Initialize select2
            $('#routine-rows .routine-row:last .subject-select').select2({ width: '100%' });

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
                        const newSelect = $('#routine-rows .routine-row:last .subject-select');
                        newSelect.empty().append('<option value="">--- Select ---</option>');
                        res.data.forEach(item => {
                            newSelect.append(`<option value="${item.id}">${item.name}</option>`);
                        });

                        // Re-init select2
                        newSelect.select2({ width: '100%' });
                    }
                });
            }

            rowCount++;
        });

        // Remove row
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.routine-row').remove();
        });
    });
</script>
