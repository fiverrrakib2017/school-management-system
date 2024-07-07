@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
          <div class="card-header">
             <a  href="{{route('admin.category.create')}}" class="btn btn btn-success">Add New Category</a>
          </div>
            <div class="card-body">
             

                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-striped table-bordered    " cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th class="">No.</th>
                            <th class="">Category Name</th>
                            <th class="">Image</th>
                            <th class="">Slug</th>
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
                <td>{{ $item->category_name }}</td>
                 <td>
                    @if($item->category_image)
                    <img class="img-circle" height="50px" src="{{ asset('/Backend/uploads/photos/' . $item->category_image) }}" alt="Photo">

                    @else
                        <img src="{{ asset('Backend/images/default.jpg') }}" height="50px" alt="Default Photo">
                    @endif
                </td>
                <td>{{ $item->slug}}</td>
                
               
                <td>
                    <!-- Add your action buttons here -->
                    <a class="btn btn-primary btn-sm mr-3" href="{{route('admin.category.edit', $item->id)}}"><i class="fa fa-edit"></i></a>
                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$item->id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-trash"></i></button>
                </td>
            </tr>




          <!--Start Delete MODAL ---->
          <div id="deleteModal{{$item->id}}" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <form action="{{route('admin.category.delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="fas fa-trash"></i>
                        </div>
                        <h4 class="modal-title w-100">Are you sure?</h4>
                        <input type="hidden" name="id" value="{{$item->id}}">
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
