@php
    $website_info=App\Models\Website_information::first();
@endphp

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>admit Card</title>

<style>
    .txt-center {
    text-align: center;
}
/* .border- {
    border: 1px solid #000 !important;
} */
.padding {
    padding: 15px;
}
.mar-bot {
    margin-bottom: 15px;
}
.admit-card {

    padding: 15px;
    margin: 20px 0;
}
.BoxA h5, .BoxA p {
    margin: 0;
}
h5 {
    text-transform: uppercase;
}
table img {
    width: 100%;
    margin: 0 auto;
}
/* .table-bordered td, .table-bordered th, .table thead th {
    border: 1px solid #000000 !important;
} */
</style>

  </head>
  <body>

    <section style="background-color: #f9f9f9; padding: 40px 0;">
        <div class="container">
            <div class="admit-card" style="background: #fff;  box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px;">
                <div class="BoxA border- padding mar-bot" style=" padding-bottom: 20px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 style="font-size: 18px; color: #333; font-weight: bold;">{{ $website_info->name }}</h5>
                            <p style="font-family: serif; color: #777;">{{ $website_info->address }}</p>
                            <p style="font-family: serif; color: #777;">{{ $website_info->email }}</p>
                            <p style="font-family: serif; color: #777;">{{ $website_info->phone_number }}</p>
                        </div>
                        <div class="col-sm-4 text-center">
                            <img src="{{ asset('Backend/uploads/photos/1742276686.jpg') }}" width="120px;" style="border-radius: 50%;" alt="Logo" />
                        </div>
                        <div class="col-sm-4">
                            <h5 style="font-size: 18px; color: #333; font-weight: bold;">Admit Card</h5>
                            <h6 style="font-size: 16px; color: #555;">
                                @php
                                     $exam=App\Models\Student_exam::find($exam_id);
                                     echo $exam->name . ' -- ' . $exam->year;
                                @endphp
                            </h6>
                        </div>
                    </div>
                </div>
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered">
						  <tbody style="border: 1px dotted #c4c3c3; border-bottom:1px dotted #ababab;">

							<tr >
							  <td><b>Student Name: </b>{{ $student->name }}</td>
							  <td><b>Gender: </b>{{ $student->gender }}</td>
							</tr>
							<tr>
							  <td><b>Class Name: </b>{{ $student->currentClass->name }}</td>
							  <td><b>Section: </b>{{ $student->section->name }}</td>
							</tr>
							<tr>
							  <td><b>Father Name: </b>{{ $student->father_name }}</td>
							  <td><b>DOB: </b> {{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}</td>

							</tr>
							<tr>
							  <td><b>Address: </b>{{ $student->current_address }}</td>
							</tr>

						  </tbody>
						</table>
					</div>
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row txt-center">    <img src="{{ asset(!empty($item->photo) ? 'uploads/photos/'.$item->photo : 'uploads/photos/avatar.png') }}" width="100px" height="130px" alt="image"></th>
							</tr>

						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="BoxE border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<h5>Exam Schedule</h5><hr>
					</div>
				</div>
			</div>
			<div class="BoxF border- padding mar-bot txt-center">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered" >
							<thead >
								<tr style="border: 1px dotted #c4c3c3; border-bottom:1px dotted #c4c3c3;">
									<th>Sr. No.</th>
									<th>Subject</th>
									<th>Exam Date</th>
									<th>Start Time</th>
									<th>End Time</th>
									<th>Invigilator</th>
								</tr>
							</thead>
						  <tbody>
                            @php
                                $routine=App\Models\Student_exam_routine::where('exam_id',$exam_id)->where('class_id',$student->current_class)->get();
                                $numer=1;
                            @endphp
							@foreach ($routine as $item)
                            <tr style="border: 1px dotted #c4c3c3; border-bottom:1px dotted #c4c3c3;">
                                <td>{{ $numer++ }}</td>
                                <td>{{ $item->subject->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d M Y') }}</td>

                                <td>{{ \Carbon\Carbon::parse($item->start_time)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->end_time)->format('h:i A') }}</td>

                                <td>{{ $item->invigilator }}</td>
                            </tr>
                            @endforeach

						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<footer class="txt-center">

			</footer>

		</div>
	</div>

</section>


  </body>
</html>
<script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>


