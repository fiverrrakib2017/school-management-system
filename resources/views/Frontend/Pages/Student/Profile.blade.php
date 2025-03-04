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

{{--
@section('content')
<div class="container">
    <div class="row margin-vert-30">
        <center>
            <h2>Profile of <b>Tawhid </b> </h2>
        </center>
        <hr />
        <div class="col-md-12">

            <fieldset>
                <legend>
                    <h6>ID NO. <b style="color:#F00">2</b></h6>
                </legend>
                <img src="app/images/asset/1.jpg" height="150" width="150" />
            </fieldset>


            <div style="clear:both"></div><br />


            <fieldset>
                <legend>
                    <h6 class="alert-info">Basic Information</h6>
                </legend>

                <table width="1021" class="alert-link table-condensed table-responsive">

                    <tr>
                        <td width="329" align="left"><label>Name :&nbsp;&nbsp; </label>Tawhid
                        </td>
                        <td width="327" align="left"><label>Father's name :&nbsp;&nbsp;
                            </label></td>
                        <td width="349" align="left"><label>Mother's name :&nbsp;&nbsp;
                            </label></td>
                    </tr>

                    <tr>
                        <td align="left"><label>Gender :&nbsp;&nbsp; </label>Male</td>
                        <td align="left"><label>Religion :&nbsp;&nbsp; </label>Islam</td>
                        <td align="left"><label>Blood Group :&nbsp;&nbsp; </label> </td>
                    </tr>

                    <tr>
                        <td align="left"><label>Nationality :&nbsp;&nbsp; </label>Bangladeshi
                        </td>
                        <td align="left"><label>Date of birth :&nbsp;&nbsp; </label>0000-00-00
                        </td>

                    </tr>

                    <tr>
                        <td align="left"><label>Medium :&nbsp;&nbsp;</label>English Medium</td>
                        <td align="left"><label>Group :&nbsp;&nbsp;</label>Pre-Primary</td>
                        <td align="left"><label>Class :&nbsp;&nbsp;</label>Play</td>
                    </tr>

                    <tr>
                        <td align="left"><label>Shift :&nbsp;&nbsp;</label>Morning</td>
                        <td align="left"><label>Section :&nbsp;&nbsp;</label>Gomatee</td>
                        <td align="left"><label>Class roll :&nbsp;&nbsp;</label>1</td>
                    </tr>

                </table>

            </fieldset>

            <fieldset>
                <legend>
                    <h6 class="alert-success">Present address</h6>
                </legend>

                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr>
                        <td width="177" align="left"><label>Present address
                                :&nbsp;&nbsp;</label></td>
                    </tr>
                </table>

            </fieldset>

            <fieldset>
                <legend>
                    <h6 class="alert-warning">Permanent address</h6>
                </legend>
                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr>
                        <td align="left"><label>Permanent address :&nbsp;&nbsp;</label> </td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend>
                    <h6 class="alert-success">Guardian Information</h6>
                </legend>

                <table width="1021" class="alert-link table-condensed table-responsive">

                    <tr>
                        <td width="466" align="left"><label>Guardian's name
                                :&nbsp;&nbsp;</label></td>
                        <td width="543" align="left"><label>Guardian's address
                                :&nbsp;&nbsp;</label></td>
                    </tr>
                    <tr>
                        <td align="left"><label>Mobile no :&nbsp;&nbsp;</label>Confidential</td>
                        <td align="left"><label>E-mail :&nbsp;&nbsp;</label></td>
                    </tr>

                </table>
            </fieldset>
            <fieldset>
                <legend>
                    <h6 class="alert-info">Subject</h6>
                </legend>

                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr class="alert-success">
                        <td>#</td>
                        <td>Subject code</td>
                        <td>Subject name</td>

                    </tr>



                    <tr>
                        <td>1</td>
                        <td>ENG-107</td>
                        <td>English </td>

                    </tr>


                    <tr>
                        <td>2</td>
                        <td>BAN-101</td>
                        <td>Bangla</td>

                    </tr>


                    <tr>
                        <td>3</td>
                        <td>MAT-109</td>
                        <td>Mathematics</td>

                    </tr>


                    <tr>
                        <td>4</td>
                        <td>IME-111</td>
                        <td>Religion</td>

                    </tr>


                    <tr>
                        <td>5</td>
                        <td>COM-131</td>
                        <td>Computer </td>

                    </tr>


                </table>

            </fieldset>
            <fieldset>
                <legend>
                    <h6 class="alert-success">Group subject</h6>
                </legend>
                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr>
                        <td align="left"><label>Group subject :</label>&nbsp;&nbsp;</td>
                    </tr>
                </table>
            </fieldset>

            <fieldset>
                <legend>
                    <h6 class="alert-info">Optional subject</h6>
                </legend>
                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr>
                        <td align="left"><label>Optional subject :</label>&nbsp;&nbsp;</td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>
                    <h6 class="alert-warning">Others information</h6>
                </legend>
                <table width="1021" class="alert-link table-condensed table-responsive">
                    <tr>
                        <td width="778" align="left"><label>Session
                                :</label>&nbsp;&nbsp;[0000-00-00] To [0000-00-00]</td>
                        <td width="231" align="left"><label>Date of admission
                                :</label>&nbsp;&nbsp;0000-00-00</td>
                    </tr>
                    <tr>
                        <td align="left"><label>Previous School :</label>&nbsp;&nbsp;</td>

                    </tr>
                </table>
            </fieldset>


            <fieldset>
                <legend>
                    <h6 class="alert-danger">NOTE</h6>
                </legend>
                <a>Due to privacy issues all informations are not shown here. For details
                    information contact with concerned department............ IT-FAST</a>
            </fieldset>

        </div>
        <!-- End Main Column -->
    </div>
</div>
@endsection --}}

@section('content')
<div class="container">
    <div class="row margin-vert-30">
        <div class="col-md-12 text-center">
            <h2>Profile of <b>{{ $student->name ?? 'N/A' }}</b></h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 text-center">
            @if($student->photo)
                            <img src="{{ asset('uploads/photos/' . $student->photo) }}" class="img-fluid rounded" alt="Student Photo" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('uploads/photos/avatar.png') }}" class="img-fluid rounded" alt="Default Photo" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
            <h4>ID NO. <span class="text-danger">{{ $student->id ?? 'N/A' }}</span></h4>
        </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">Basic Information</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Name:</b> {{ $student->name }}</td>
                            <td><b>Father's Name:</b> {{ $student->father_name ?? 'N/A' }}</td>
                            <td><b>Mother's Name:</b> {{ $student->mother_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Gender:</b> {{ $student->gender }}</td>
                            <td><b>Religion:</b> {{ $student->religion }}</td>
                            <td><b>Blood Group:</b> {{ $student->blood_group ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><b>Nationality:</b> {{ $student->nationality ?? 'N/A' }}</td>
                            <td><b>Date of Birth:</b> {{ $student->birth_date ?? 'N/A' }}</td>
                            <td><b>Class:</b> Play</td>
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
                <div class="panel-body">{{ $student->current_address ?? '' }}</div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">Permanent Address</div>
                <div class="panel-body">{{ $student->permanent_address ?? '' }}</div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">Guardian Information</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Guardian's Name:</b> {{ $student->guardian_name }}</td>
                            <td><b>Mobile:</b> {{ $student->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">Subjects</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr class="active">
                            <th>#</th>
                            <th>Subject Name</th>
                        </tr>
                       @php
                           $subject=App\Models\Student_subject::where('class_id',$student->currentClass->id)->get();
                       @endphp
                       @foreach ($subject as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                       @endforeach
                    </table>
                </div>
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
