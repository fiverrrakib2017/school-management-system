<div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><span class="mdi mdi-account-check mdi-18px"></span>
                    &nbsp;Add New Teacher Corner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.settings.website.teacher_corner.store') }}" id="teacher_cornerForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
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
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <select name="section_id"  class="form-control">
                            <option value="">---Select---</option>
                            
                            @if($sections->isNotEmpty())
                                @foreach($sections as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="form-group mb-2">
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
                    <div class="form-group mb-2">
                        <label>Teacher Name</label>
                        <select name="teacher_id" class="form-control" type="text" style="width: 100%;" required>
                            <option value="">---Select---</option>
                            @php
                                $teachers = \App\Models\Teacher::latest()->get();
                            @endphp
                            @if($teachers->isNotEmpty())
                                @foreach($teachers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Lession</label>
                        <textarea name="lession" class="form-control" placeholder="Enter Lession" type="text" style="width: 100%;" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label>Upload Images or PDF</label>
                        <input name="images" class="form-control" type="file" style="width: 100%;"><br>
                        <img id="preview" class="img-fluid" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;" />
                       <!-- jQuery -->
                        <script src="{{ asset('Backend/plugins/jquery/jquery.min.js') }}"></script>
                        <script>
                            $('input[name="images"]').change(function() {
                                    let reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#preview').attr('src', e.target.result).show();
                                    }
                                    reader.readAsDataURL(this.files[0]);
                                });
                        </script>
                    </div>
                   

                    <div class="modal-footer ">
                        <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!----------------Edit Modal------------------------------>

{{-- <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content col-md-12">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><span class="mdi mdi-account-check mdi-18px"></span>
                    &nbsp; Update Teacher Corner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.settings.website.teacher_corner.update') }}" id="teacher_cornerForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
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
                    <div class="form-group mb-2">
                        <label>Section Name</label>
                        <select name="section_id"  class="form-control">
                            <option value="">---Select---</option>

                        </select>

                    </div>
                    <div class="form-group mb-2">
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
                    <div class="form-group mb-2">
                        <label>Teacher Name</label>
                        <select name="teacher_id" class="form-control" type="text" style="width: 100%;" required>
                            <option value="">---Select---</option>
                            @php
                                $teachers = \App\Models\Teacher::latest()->get();
                            @endphp
                            @if($teachers->isNotEmpty())
                                @foreach($teachers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Lession</label>
                        <textarea name="lession" class="form-control" placeholder="Enter Lession" type="text" style="width: 100%;" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label>Upload Images or PDF</label>
                        <input name="images" class="form-control" type="file" style="width: 100%;"><br>
                        <img id="preview" class="img-fluid" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px;" />
                       <!-- jQuery -->
                        <script src="{{ asset('Backend/plugins/jquery/jquery.min.js') }}"></script>
                        <script>
                            $('input[name="images"]').change(function() {
                                    let reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#preview').attr('src', e.target.result).show();
                                    }
                                    reader.readAsDataURL(this.files[0]);
                                });
                        </script>
                    </div>
                   

                    <div class="modal-footer ">
                        <button data-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}



    <script type="text/javascript">
    $(document).on('change','select[name="class_id"]',function(){
        
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
    
    </script>