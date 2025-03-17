
@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .marquee-container {
        background: linear-gradient(90deg, #163b62, #015a29);
        color: #ffffff;
        font-size: 18px;
        font-weight: 600;
        padding: 15px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }
    .marquee-container p {
        margin: 0;
        padding-left: 20px;
        white-space: nowrap;
    }
    .marquee-container p span {
        padding-right: 30px;
    }
    .marquee-container p i {
        margin-right: 10px;
    }
    /* Smooth animation */
    .marquee-container marquee {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 18px;
        color: #ffffff;
    }
</style>
@endsection
@section('content')
<div class="row mb-3">
    <!-- Marquee above the buttons -->
    <div class="col-md-12">
        <div class="marquee-container">
           <marquee behavior="scroll" direction="left" scrollamount="8">
                স্বাগতম, Admin Panel এ! <i class="fas fa-cogs"></i> আপনার স্কুল ম্যানেজমেন্ট সিস্টেম পরিচালনা করুন, সহায়তা দরকার হলে আমাদের সাপোর্ট টিমের সাথে যোগাযোগ করুন | নতুন ফিচার আসছে!</span>
           </marquee>
       </div>
   </div>
    <!-- End Marquee above the buttons -->
    <div class="col-md-12 d-flex flex-wrap gap-2">
        <a href="{{ route('admin.student.create') }}" class="btn btn-primary m-1"><i class="fas fa-user-plus"></i> Add Student</a>
        <a href="{{ route('admin.teacher.create') }}" class="btn btn-success m-1"><i class="fas fa-chalkboard-teacher"></i> Add Teacher</a>
        <a href="{{ route('admin.student.attendence.index') }}"  class="btn btn-warning m-1"><i class="fas fa-calendar-alt"></i> View Attendance</a>
        <a href="{{ route('admin.student.bill_collection.create') }}" class="btn btn-info m-1"><i class="fas fa-file-invoice-dollar"></i> Manage Fees</a>
    </div>
</div>


<div class="row" id="dashboardCards">
    @php
       $dashboardCards = [
           ['id' => 1,'title' => 'Total Student', 'value' => 0, 'bg' => 'success', 'icon' => 'fas fa-user-graduate'],
           ['id' => 2,'title' => 'Total Teacher', 'value' => 0, 'bg' => 'info', 'icon' => 'fas fa-chalkboard-teacher'],
           ['id' => 3,'title' => 'Total Staff', 'value' => 0, 'bg' => 'warning', 'icon' => 'fas fa-users'],
           ['id' => 4,'title' => 'Total Class', 'value' => 0, 'bg' => 'danger', 'icon' => 'fas fa-school'],




       ];
   @endphp
    @foreach($dashboardCards as $card)
   <div class="col-lg-3 col-6 card-item wow animate__animated animate__fadeInUp" data-id="{{ $card['id'] }}" data-wow-delay="0.{{ $card['id'] }}s">
       <div class="small-box bg-{{ $card['bg'] }}">
           <div class="inner">
               <h3>{{ $card['value'] }}</h3>
               <p>{{ $card['title'] }}</p>
           </div>
           <div class="icon">
               <i class="fas {{ $card['icon'] }} fa-2x text-gray-300"></i>
           </div>
       </div>
   </div>
   @endforeach
</div>



<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">Yearly Revenue Chart</div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
             <div class="card-header bg-primary text-white">Present vs Absent</div>
              <div class="card-body">
                <canvas id="studentChart"></canvas>
              </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script type="text/javascript">
var ctx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','July','Augest','September','Octobar','November','December'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1900, 3000, 5000, 2000, 3000,1200, 1900, 3000, 5000, 2000, 3000],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        },
        options: {
            responsive: true
        }
    });


    var ctx2 = document.getElementById('studentChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Present', 'Absent'],
            datasets: [{
                data: [80, 20],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        },
        options: { responsive: true }
    });
  </script>
@endsection
