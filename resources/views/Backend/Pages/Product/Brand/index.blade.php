@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">

    <link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="index.html">Dashboard</a>
          <a class="breadcrumb-item" href="#">Product</a>
          <span class="breadcrumb-item active">Brand</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
        <a  href="{{route('admin.brand.create')}}" class="btn btn btn-success">Add New Brand</a>
      </div>
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Brand Name</th>
          <th class="">Image</th>
          <th class="">Slug</th>
          <th class="">Status</th>
          <th class="">Create Date</th>
          <th class="">Action</th>
        </tr>
      </thead>
      <tbody>
          @php
            $key=0;
          @endphp
          @foreach($data as $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->brand_name }}</td>
                 <td>
                    @if($item->brand_image)
                    <img class="img-circle" height="50px" src="{{ asset(request()->host().'/Backend/images/brands/' . $item->brand_image) }}" alt="Photo">
                    @else
                        <img src="{{ asset('Backend/images/default.jpg') }}" height="50px" alt="Default Photo">
                    @endif
                </td>
                <td>{{ $item->slug}}</td>
                <td>
                  @if ($item->status==1)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </td>
                 <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>
                    <!-- Add your action buttons here -->
                    <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.brand.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                    <a onclick="return confirm('Are you sure')" class="btn btn-danger btn-sm mr-3" href="{{route('admin.brand.delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
          @endforeach
      </tbody>
    </table>
      </div>
    </div>

  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->


@endsection

@section('script')
    <script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>



    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });



    </script>


  @if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
    @elseif(session('error'))
    <script>
        toastr.error('{{ session('error') }}');
    </script>
    @endif

    @if(session('errors'))
        <script>
            var errors = @json(session('errors'));
            errors.forEach(function(error) {
              toastr.error(error);
            });
        </script>
    @endif

@endsection

