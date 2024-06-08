@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
    <link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
    <style>
        .profile-header {
            position: relative;
            overflow: hidden;
        }
        .profile-header .profile-header-cover {
            background-color: #17A2B8;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
        .profile-header .profile-header-content {
            color: #fff;
            padding: 25px;
        }
        .profile-header-img {
            float: left;
            width: 120px;
            height: 120px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            margin: 0 0 -20px;
            padding: 3px;
            border-radius: 4px;
            /* background: #fff; */
            background: linear-gradient(#14c608, #c92c89);
        }
        .profile-header-img img {
            max-width: 100%;
        }
        .profile-header-info h4 {
            font-weight: 500;
            color: #fff;
        }
        .profile-header-img+.profile-header-info {
            margin-left: 140px;
        }
        .profile-header .profile-header-content,
        .profile-header .profile-header-tab {
            position: relative;
        }
        .profile-header .profile-header-tab {
            background: #e3e3e3;
            list-style-type: none;
            margin: -10px 0 0;
            padding: 0 0 0 140px;
            white-space: nowrap;
            border-radius: 0;
        }
        .profile-header .profile-header-tab>li {
            display: inline-block;
            margin: 0;
        }
        .profile-header .profile-header-tab>li>a {
            display: block;
            color: #929ba1;
            line-height: 20px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            border: none;
        }
        .profile-header .profile-header-tab>li.active>a,
        .profile-header .profile-header-tab>li>a.active {
            color: #242a30;
        }
        .profile-content {
            padding: 25px;
            border-radius: 4px;
        }
        .profile-section {
            margin-top:0px;
            padding-top: 20px;
            border-top: 2px dashed #b9c3ca;
        }
        .profile-section .title {
            font-size: 20px;
            margin: 0 0 15px;
        }
        .profile-section table {
            width: 100%;
        }
        .profile-section .field {
            width: 30%;
            font-weight: bold;
        }
        .profile-section .value {
            width: 70%;
        }
    </style>
@endsection
@section('content')
<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
        <span class="breadcrumb-item active">Teacher Profile</span>
    </nav>
</div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
    <div class="table-wrapper">
        <div class="card">
            <div class="card-body">
                <div id="content" class="container p-0">
                    <div class="profile-header">
                        <div class="profile-header-cover"></div>
                        <div class="profile-header-content">
                            <div class="profile-header-img">
                                <img src="{{ asset('uploads/photos/'.$teacher->photo) }}" alt="{{ $teacher->name }}" />
                            </div>
                            <div class="profile-header-info">
                                <h4 class="m-t-sm">{{ $teacher->name }}</h4>
                                <p class="m-b-sm">{{ $teacher->designation }}</p>
                                <a href="{{ route('admin.teacher.edit',$teacher->id) }}" class="btn btn-xs btn-primary mb-4">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="profile-header-tab nav nav-tabs">
                            <li class="nav-item"><a href="#posts" class="nav-link show" data-toggle="tab">POSTS</a></li>
                            <li class="nav-item"><a href="#about" class="nav-link active show" data-toggle="tab">ABOUT</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">PHOTOS</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">VIDEOS</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">FRIENDS</a></li>
                        </ul>
                    </div>
                    <div class="profile-container">
                        <div class="row row-space-20">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="about">
                                        <div class="profile-section">
                                            <h4 class="title">Personal Information</h4>
                                            <table class="table table-profile">
                                                <tbody>
                                                    <tr>
                                                        <td class="field">Name:</td>
                                                        <td class="value">{{ $teacher->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Email:</td>
                                                        <td class="value">{{ $teacher->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Phone:</td>
                                                        <td class="value">{{ $teacher->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Father's Name:</td>
                                                        <td class="value">{{ $teacher->father_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Mother's Name:</td>
                                                        <td class="value">{{ $teacher->mother_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Gender:</td>
                                                        <td class="value">{{ $teacher->gender }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Birth Date:</td>
                                                        <td class="value">{{ $teacher->birth_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">National ID:</td>
                                                        <td class="value">{{ $teacher->national_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Religion:</td>
                                                        <td class="value">{{ $teacher->religion }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Blood Group:</td>
                                                        <td class="value">{{ $teacher->blood_group }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Address:</td>
                                                        <td class="value">{{ $teacher->address }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="profile-section">
                                            <h4 class="title">Professional Information</h4>
                                            <table class="table table-profile">
                                                <tbody>
                                                    <tr>
                                                        <td class="field">Subject:</td>
                                                        <td class="value">{{ $teacher->subject }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Hire Date:</td>
                                                        <td class="value">{{ $teacher->hire_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Highest Education:</td>
                                                        <td class="value">{{ $teacher->highest_education }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Previous School:</td>
                                                        <td class="value">{{ $teacher->previous_school }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Designation:</td>
                                                        <td class="value">{{ $teacher->designation }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Salary:</td>
                                                        <td class="value">{{ $teacher->salary }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="profile-section">
                                            <h4 class="title">Emergency Contact</h4>
                                            <table class="table table-profile">
                                                <tbody>
                                                    <tr>
                                                        <td class="field">Emergency Contact Name:</td>
                                                        <td class="value">{{ $teacher->emergency_contact_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Emergency Contact Phone:</td>
                                                        <td class="value">{{ $teacher->emergency_contact_phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Remarks:</td>
                                                        <td class="value">{{ $teacher->remarks }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="field">Status:</td>
                                                        <td class="value">{{ $teacher->status ? 'Active' : 'Inactive' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="posts">Posts content here...</div>
                                    <div class="tab-pane fade" id="photos">Photos content here...</div>
                                    <div class="tab-pane fade" id="videos">Videos content here...</div>
                                    <div class="tab-pane fade" id="friends">Friends content here...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- table-wrapper -->
            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- br-section-wrapper -->
@endsection
