@extends('Backend.Layout.App')
@section('title', 'Student Admit Card')

@section('content')


<div class="container ">
    <div class="card " style="max-width: 800px; margin: auto;">
        <div class="card-header text-center ">
            <img src="{{ asset('Backend/uploads/photos/1742276686.jpg') }}" alt="School Logo" class="mb-2" style="max-width: 80px;">
            <h3 class="mb-0 text-uppercase font-weight-bold">Admit Card</h3>
            <h5 class="mb-0 text-uppercase">1st Terminal Examination - 2024</h5>
            <p class="mb-0 font-italic">Future ICT School, Gouripur, Daudkandi, Cumilla</p>
        </div>
        <div class="card-body ">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('Backend/uploads/photos/1740660577.jpeg') }}" class="img-thumbnail border border-dark" style="max-width: 120px; height: 150px; object-fit: cover;" />
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered text-sm bg-light" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td><b>Enrollment No:</b> 9910101</td>
                                <td><b>Class:</b> 10</td>
                            </tr>
                            <tr>
                                <td><b>Student Name:</b> Vinod Sharma</td>
                                <td><b>Gender:</b> Male</td>
                            </tr>
                            <tr>
                                <td><b>Father's Name:</b> SS Sharma</td>
                                <td><b>DOB:</b> 02 Jul 2010</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Address:</b> Gouripur, Daudkandi, Cumilla</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                <h5 class="text-center font-weight-bold text-uppercase bg-primary text-white p-2">Exam Schedule</h5>
                <table class="table table-bordered text-center" style="font-size: 14px;">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Subject</th>
                            <th>Exam Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bangla</td>
                            <td>5 March 2024</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>English</td>
                            <td>7 March 2024</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mathematics</td>
                            <td>10 March 2024</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Science</td>
                            <td>12 March 2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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
