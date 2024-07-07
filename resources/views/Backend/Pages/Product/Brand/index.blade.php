@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                <a href="{{route('admin.brand.create')}}" class="btn-sm btn btn-success mb-2"><i class="mdi mdi-account-plus"></i>
                    Add New Brand</a>

                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th class="">No.</th>
                            <th class="">Brand Name</th>
                            <th class="">Image</th>
                            <th class="">Slug</th>
                            <th class="">Status</th>
                            <th class=""></th>
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
                    <img class="img-circle" height="50px" src="{{ asset('Backend/uploads/photos/' . $item->brand_image) }}" alt="Photo">
                    @else
                        <img src="{{ asset('Backend/images/default.jpg') }}" height="50px" alt="Default Photo">
                    @endif
                </td>
                <td>{{ $item->slug}}</td>
                <td>
                  @if ($item->status==1)
                  <span class="badge bg-success">Active</span>
                  @else
                  <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>
                
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
        </div>

    </div>
</div>


@endsection

@section('script')

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
