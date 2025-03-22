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
    border: 2px dotted #ababab;
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

<section>
	<div class="container">
		<div class="admit-card">
			<div class="BoxA border- padding mar-bot">
				<div class="row">
					<div class="col-sm-4">
						<h5>Future ICT School</h5>
						<p>Gouripur Daudkandi, Cumilla</p>
						<p>rakibas375@gmail.com</p>
						<p>01757967432</p>
					</div>
					<div class="col-sm-4 txt-center">
						<img src="{{ asset('Backend/uploads/photos/1742276686.jpg') }}" width="100px;" />
					</div>
					<div class="col-sm-4">
						<h5>Admit Card</h5>
                        <h5>1st Model Test Exam 2025</h5>
					</div>
				</div>
			</div>
			<div class="BoxD border- padding mar-bot">
				<div class="row">
					<div class="col-sm-10">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <td><b>ENROLLMENT NO : 9910101</b></td>
							  <td><b>Course: </b> B.TECH</td>
							</tr>
							<tr>
							  <td><b>Student Name: </b>Vinod Sharma</td>
							  <td><b>Sex: </b>M</td>
							</tr>
							<tr>
							  <td><b>Father/Husband Name: </b>SS Sharma</td>
							  <td><b>DOB: </b>02 Jul 2019</td>
							</tr>
							<tr>
							  <td><b>Address: </b>SS Sharma</td>
							</tr>

						  </tbody>
						</table>
					</div>
					<div class="col-sm-2 txt-center">
						<table class="table table-bordered">
						  <tbody>
							<tr>
							  <th scope="row txt-center"><img src="{{ asset('Backend/uploads/photos/1740660577.jpeg') }}" width="100px" height="130px" /></th>
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
						<table class="table table-bordered">
							<thead>
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
							  <td>English</td>
							  <td>5 July 2019</td>
							</tr>
							<tr>
							  <td>3</td>
							  <td>English</td>
							  <td>5 July 2019</td>
							</tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<footer class="txt-center">
				<p>Future ICT School</p>
			</footer>

		</div>
	</div>

</section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>



    {{-- <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Admit Card</title>
    <style>
        .txt-center {
            text-align: center;
        }
        .padding {
            padding: 15px;
        }
        .mar-bot {
            margin-bottom: 15px;
        }
        .admit-card {
            border: 2px solid #000;
            padding: 20px;
            margin: 30px 0;
            background: #f9f9f9;
            border-radius: 10px;
        }
        .header-info h5, .header-info p {
            margin: 0;
        }
        h5 {
            text-transform: uppercase;
            font-weight: bold;
        }
        .table th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }
        .table td {
            vertical-align: middle;
        }
        .footer {
            margin-top: 20px;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
      </head>
      <body>
    <section>
        <div class="container">
            <div class="admit-card">
                <div class="row">
                    <div class="col-sm-4 header-info">
                        <h5>Future ICT School</h5>
                        <p>Gouripur Daudkandi, Cumilla</p>
                        <p>rakibas375@gmail.com</p>
                        <p>01757967432</p>
                    </div>
                    <div class="col-sm-4 txt-center">
                        <img src="{{ asset('Backend/uploads/photos/1742276686.jpg') }}" width="100px;" />
                    </div>
                    <div class="col-sm-4 text-right">
                        <h5>Admit Card</h5>
                        <h5>1st Model Test Exam 2025</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-10">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>ENROLLMENT NO : 9910101</b></td>
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
                                    <td colspan="2"><b>Address:</b> SS Sharma</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-2 txt-center">
                        <img src="{{ asset('Backend/uploads/photos/1740660577.jpeg') }}" width="100px" height="130px" class="border" />
                    </div>
                </div>
                <hr>
                <div class="txt-center">
                    <h5>Exam Schedule</h5>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
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
                                    <td>6 July 2019</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Science</td>
                                    <td>7 July 2019</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <footer class="txt-center footer">
                    <p>Future ICT School</p>
                </footer>
            </div>
        </div>
    </section>
    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
      </body>
    </html> --}}
