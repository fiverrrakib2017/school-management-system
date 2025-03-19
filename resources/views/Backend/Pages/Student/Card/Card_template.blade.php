@extends('Backend.Layout.App')
@section('title','Student ID Card')

@section('style')
<style>
    /* .txt-center {
        text-align: center;
    } */
    .border-custom {
        border: 2px dotted #a5a4a4;

        padding: 20px;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
    }
    .header-section, .footer-section {
        /* background: #2C3E50; */
        background: #06440e;
        color: #fff;
        padding: 10px 0;
        border-radius: 10px;
        text-align: center;
    }
    /* h5, p {
        margin: 0;
    } */
    table img {
        width: 100%;
        display: block;
        margin: auto;
    }

    .profile-img {
        width: 120px;
        height: 160px;
        border-radius: 10px;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<section>
    {{-- <div class="container">
        <div class="admit-card border-custom">
            <div class="header-section">
                <h5>MEWAR UNIVERSITY</h5>
                <p>NH - 79 Gangrar Chittorgarh - 312901, RAJASTHAN, INDIA</p>
            </div>


            <div class="row my-3">
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>ENROLLMENT NO :</b> 9910101</td>
                                <td><b>Course:</b> B.TECH</td>
                            </tr>
                            <tr>
                                <td><b>Student Name:</b> Vinod Sharma</td>
                                <td><b>Sex:</b> M</td>
                            </tr>
                            <tr>
                                <td><b>Father/Husband Name:</b> SS Sharma</td>
                                <td><b>DOB:</b> 02 Jul 2019</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Address:</b> moh hasnxgxums, moh hasnxgxums, moh hasnxgxums</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('Backend/uploads/photos/1740660577.jpeg') }}" class="profile-img" />

                </div>
            </div>

            <div class="my-3">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Subject/Paper</th>
                            <th>Exam Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>English</td>
                            <td>5 July 2019</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Mathematics</td>
                            <td>7 July 2019</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Physics</td>
                            <td>10 July 2019</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div> --}}


    <div class="container mt-4">
        <div class="card border-custom">
            <div class="card-header  text-center">
                <img src="{{ asset('Backend/uploads/photos/1742276686.jpg') }}" alt="University Logo" class="mb-2" style="max-width: 100px;">
                <h4 class="mb-0">Future ict School</h4>
                <p class="mb-0">Gouripur,Daudkandi,cumilla</p>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td><b>ENROLLMENT NO :</b> 9910101</td>
                                    <td><b>Course:</b> B.TECH</td>
                                </tr>
                                <tr>
                                    <td><b>Student Name:</b> Vinod Sharma</td>
                                    <td><b>Sex:</b> M</td>
                                </tr>
                                <tr>
                                    <td><b>Father/Husband Name:</b> SS Sharma</td>
                                    <td><b>DOB:</b> 02 Jul 2019</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Address:</b> moh hasnxgxums, moh hasnxgxums, moh hasnxgxums</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('Backend/uploads/photos/1740660577.jpeg') }}" class="img-fluid rounded shadow-sm border" style="max-width: 120px;" />
                    </div>
                </div>
                <div class="mt-4">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Subject/Paper</th>
                                <th>Exam Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>English</td>
                                <td>5 July 2019</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mathematics</td>
                                <td>7 July 2019</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Physics</td>
                                <td>10 July 2019</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center bg-light">
                <small>Generated by MEWAR UNIVERSITY Exam Cell</small>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">

    function PrintDiv() {
        var divToPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank', 'width=300,height=400,location=no,left=200px');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
 </script>
@endsection
