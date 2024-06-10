@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">

    <link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="#">Product</a>
          <span class="breadcrumb-item active">Category</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
        <a  href="{{route('admin.category.create')}}" class="btn btn btn-success">Add New Category</a>
      </div>
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Category Name</th>
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
                <td>{{ $item->category_name }}</td>
                 <td>
                    @if($item->category_image)
                    <img class="img-circle" height="50px" src="{{ asset(request()->host().'/Backend/images/category/' . $item->category_image) }}" alt="Photo">

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
                    <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.category.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                    <button data-toggle="modal" data-target="#deleteModal{{$item->id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-trash"></i></button>
                </td>
            </tr>




            <!--Start Delete MODAL ---->
          <div id="deleteModal{{$item->id}}" class="modal fade">
              <div class="modal-dialog modal-dialog-top" role="document">
                  <div class="modal-content tx-size-sm">
                  <div class="modal-body tx-center pd-y-20 pd-x-20">
                      <form action="{{route('admin.category.delete')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                          <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
                          <input type="hidden" name="id" value="{{$item->id}}">
                          <button type="submit" class="btn btn-danger mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                              yes
                          </button>
                          <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                              No
                          </button>
                      </form>
                  </div><!-- modal-body -->
                  </div><!-- modal-content -->
              </div>
          </div>
          <!--End Delete MODAL ---->
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
        toastr.success("{{ session('success') }}");
    </script>
    @elseif(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif

    <!-- @if(session("errors"))
        <script>
            var errors = @json(session('errors'));
            errors.forEach(function(error) {
              toastr.error(error);
            });
        </script>
    @endif  -->
@endsection
