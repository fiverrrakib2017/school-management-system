@extends('Frontend.Layout.App')
@section('title', 'Welcome to Our Website')

@section('style')
<style>
    .student-table-wrapper {
        border: 1px solid #ddd dotted;

        padding: 15px;


    }
    .student-table-wrapper h3 {
        font-size: 20px;
        margin-bottom: 15px;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #007bff;
        padding-bottom: 5px;
    }
    .student-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        white-space: nowrap;
    }
    .student-table thead {
        background: #f1f1f1;
        font-weight: 600;
    }
    .student-table thead th {
        padding: 10px;
        border: 1px solid #ddd dotted;
        text-align: center;
    }
    .student-table tbody td {
        padding: 10px;
        border: 1px solid #ddd;
        vertical-align: middle;
        text-align: center;
    }
    .student-table tbody tr:nth-child(odd) {
        background: #f9f9f9;
    }
    .student-photo {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #ddd;
    }
    .no-padding {
        padding: 0;
    }
    @media (max-width: 768px) {
        .student-table-wrapper {
            overflow-x: auto;
        }
        .student-table {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container no-padding">
    <div class="row margin-vert-30">

        <!-- Main Content Section -->
        <div class="col-md-12">
            <div class="student-table-wrapper">
                <h3 class="text-primary">Student List</h3>

                <input type="hidden" id="mediam" name="mediam" value="1001" />

                <div style="height: 550px; overflow-y: auto;">
                    <div class="d-flex justify-content-between mb-3">
                        <form action="{{ route('student.list') }}" method="GET" class="w-100">
                            <div class="row " style="margin-bottom: 12px;">
                                <div class="col-md-3">
                                    <select name="class_id" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="section_id" class="form-control">
                                        <option value="">Select Section</option>
                                        {{-- @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
                                </div>
                                <div class="col-md-3 d-flex">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                    <a href="{{ route('student.list') }}" class="btn btn-danger ms-2">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- Student Table -->
                    <table class="student-table table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Roll</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Phone No.</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('student.fullview',$student->id) }}" style="color: black">{{ $student->name }}</a></td>
                                <td>{{ $student->roll_no ?? '' }}</td>
                                <td>{{ $student->currentClass->name ?? '' }}</td>
                                <td>{{ $student->section->name ?? '' }}</td>
                                <td>{{ $student->phone ?? '' }}</td>
                                <td>
                                    @if($student->photo)
                                        <img src="{{ asset('uploads/photos/' . $student->photo) }}" class="student-photo">
                                    @else
                                        <img src="{{ asset('uploads/photos/avatar.png') }}" class="student-photo">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('student.fullview',$student->id) }}" class="btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $students->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).on('change','select[name="class_id"]',function(){
        /*Get Sections*/
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
        $('select[name="section_id"]').select2();

    });

</script>
@endsection

