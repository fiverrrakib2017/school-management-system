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
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <span class="breadcrumb-item active">Product</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
        <a  href="{{route('admin.products.create')}}" class="btn btn btn-success">Add New Product</a>
      </div>
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Product Image</th>
          <th class="">Price</th>
          <th class="">Quantity</th>
          <th class="">Sku</th>
          <th class="">Status</th>
          <th class="">Action</th>
        </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
        @if ($product->isNotEmpty())

        @foreach ($product as $data)
            <tr>
              <td>{{$i++}}</td>
              <td>
              @php
                $productImage = $data->product_image->first();
                $title = strlen($data->title) > 50 ? substr($data->title, 0, 50) . '...' : $data->title;
              @endphp
              @if (!empty($productImage->image))
                  <img src="{{ asset(request()->host().'/uploads/product/' . $productImage->image) }}" alt="" srcset="" width="40px" height="40px" class="image-fluid">
                  {{ $title }}
              @else
                  <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" width="40px" height="40px" class="w-[40px] h-[40px]">
                  {{ $title }}
              @endif
              </td>
              <td>{{$data->price}}</td>
              <td>{{$data->qty}}</td>
              <td>{{$data->sku}}</td>
              <td>
              @if ($data->status==1)
                <span class="badge badge-success">Active</span>
                @else
                <span class="badge badge-danger">Inactive</span>
                @endif
              </td>
              <td>
                <!-- Add your action buttons here -->
                <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.products.edit', $data->id)}}"><i class="fa fa-edit"></i></a>
                <button data-toggle="modal" data-target="#deleteModal{{$data->id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <!--Start Delete MODAL ---->
          <div id="deleteModal{{$data->id}}" class="modal fade">
              <div class="modal-dialog modal-dialog-top" role="document">
                  <div class="modal-content tx-size-sm">
                  <div class="modal-body tx-center pd-y-20 pd-x-20">
                      <form action="{{route('admin.products.delete')}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                          <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
                          <input type="hidden" name="id" value="{{$data->id}}">
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

        @endif
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
    $(document).ready(function(){
      $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
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



@endsection

