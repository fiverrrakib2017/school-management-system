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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->roll_no ?? '' }}</td>
                                <td>{{ $student->current_class->name ?? '' }}</td>
                                <td>{{ $student->section->name ?? '' }}</td>
                                <td>{{ $student->phone ?? '' }}</td>
                                <td>
                                    @if($student->photo)
                                        <img src="{{ asset('uploads/photos/' . $student->photo) }}" class="student-photo">
                                    @else
                                        <img src="{{ asset('uploads/photos/avatar.png') }}" class="student-photo">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
