@extends('Frontend.Layout.App')
@section('title', 'Student Profile')
@section('style')
    <style>
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #ddd dotted;
        }
        .panel-heading {
            font-weight: bold;
        }
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row margin-vert-30">
        <div class="col-md-12 text-center">
            <h2>Profile of <b>{{ $teacher->name ?? 'N/A' }}</b></h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 text-center">
            @if($teacher->photo)
                            <img src="{{ asset('uploads/photos/' . $teacher->photo) }}" class="img-fluid rounded" alt="Student Photo" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('uploads/photos/avatar.png') }}" class="img-fluid rounded" alt="Default Photo" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
            <h4>ID NO. <span class="text-danger">{{ $teacher->id ?? 'N/A' }}</span></h4>
        </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">Basic Information</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Name:</b> {{ $teacher->name }}</td>
                            <td><b>Father's Name:</b> {{ $teacher->father_name ?? 'N/A' }}</td>
                            <td><b>Mother's Name:</b> {{ $teacher->mother_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Gender:</b> {{ $teacher->gender }}</td>
                            <td><b>Religion:</b> {{ $teacher->religion }}</td>
                            <td><b>Blood Group:</b> {{ $teacher->blood_group ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Nationality:</b> {{ $teacher->nationality ?? 'N/A' }}</td>
                            <td><b>Date of Birth:</b> {{ $teacher->birth_date ?? 'N/A' }}</td>
                            <td><b>Designation:</b> {{ $teacher->designation ?? 'N/A' }}</td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Present Address</div>
                <div class="panel-body">{{ $teacher->address ?? '' }}</div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">Permanent Address</div>
                <div class="panel-body">{{ $teacher->address ?? '' }}</div>
            </div>


            <div class="panel panel-danger">
                <div class="panel-heading">NOTE</div>
                <div class="panel-body">
                    <p>Due to privacy issues, all information is not shown here. For details, contact the concerned department.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
