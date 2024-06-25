@if (auth()->guard('admin')->check())

<script>
   window.location = "{{ route('admin.dashboard') }}";
</script>

@endif

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Adminto - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->

        <link href="{{asset('Backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- icons -->
        <link href="{{asset('Backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="assets/css/toastr.min.css" rel="stylesheet" type="text/css">
    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages ">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 mt-1">
                        <div class="text-center">   
                            <a href="index.html">
                                <img src="{{asset('Backend/assets/images/it-fast.png')}}" alt=""  >
                            </a>
                            <p class="text-muted mt-2 mb-4">School Management System Admin Dashboard</p>

                        </div>
                        <div class="card">
                         
                          @if ($errors->any())
                          <div class="card-header">
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                          @endif
                          @if(Session::has('error-message'))
                          <div class="card-header">
                                <p class="alert alert-danger">{{ Session::get('error-message') }}</p>
                          </div>
                          @endif
                          
                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                                <form action="{{ route('login.functionality') }}" method="post">
                                @csrf
                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Username</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter  Email" value="{{old('email')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 d-grid text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->


                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <script src="{{ asset('Backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/js/toastr.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('Backend/assets/js/app.min.js') }}"></script>

    </body>
</html>