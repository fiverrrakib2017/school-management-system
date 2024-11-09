@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                  <a href="{{route('admin.products.create')}}" class="btn-sm btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                    Add New Product</a>
            </div>
            <div class="card-body">


                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                              <th class="">No.</th>
                              <th class="">Product Image</th>
                              <th class="">Product Name</th>
                              <th class="">Purchase Price</th>
                              <th class="">Sale's Price</th>
                              <th class="">Quantity</th>
                              <th class="">Sku</th>
                              <th class=""></th>
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
                                <img src="{{ asset('uploads/product/' . $productImage->image) }}" alt="" width="50px" height="50px" class="img-fluid">

                                @else
                                    <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" width="50px" height="50px" class="w-[40px] h-[40px]">

                                @endif
                                </td>

                                <td>{{$title}}</td>
                                <td>{{$data->p_price}}</td>
                                <td>{{$data->s_price}}</td>
                                <td>{{$data->qty}}</td>
                                <td>{{$data->sku}}</td>

                                <td>
                                  <!-- Add your action buttons here -->
                                  <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.products.edit', $data->id)}}"><i class="fa fa-edit"></i></a>
                                  <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-trash"></i></button>
                                  <a class="btn btn-success btn-sm mr-3" href="{{route('admin.products.view', $data->id)}}"><i class="fa fa-eye"></i></a>
                                </td>
                              </tr>
                            <!--Start Delete MODAL ---->
                            <div id="deleteModal{{$data->id}}" class="modal fade">
                              <div class="modal-dialog modal-confirm">
                                  <form action="{{route('admin.products.delete')}}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      <div class="modal-content">
                                      <div class="modal-header flex-column">
                                          <div class="icon-box">
                                              <i class="fas fa-trash"></i>
                                          </div>
                                          <h4 class="modal-title w-100">Are you sure?</h4>
                                          <input type="hidden" name="id" value="{{$data->id}}">
                                          <a class="close" data-bs-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close"></i></a>
                                      </div>
                                      <div class="modal-body">
                                          <p>Do you really want to delete these records? This process cannot be undone.</p>
                                      </div>
                                      <div class="modal-footer justify-content-center">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                          <button type="submit" class="btn btn-danger">Delete</button>
                                      </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                            <!--End Delete MODAL ---->
                          @endforeach

                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('script')
  <script type="text/javascript">
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

  
@endsection
