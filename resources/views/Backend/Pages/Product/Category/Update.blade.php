@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')

@endsection
@section('content')
<div class="row">
    <div class="col-md-9 m-auto">
    <div class="card">
    <div class="card-title bg-info text-white text-center">
      <h4>Update Category</h4>
    </div>
    <form method="post" action="{{ route('admin.category.update') }}" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
      <div class="form-group d-none">
          <label for="">Category Id</label>
          <input type="text" class="form-control" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group mb-2">
          <label for="">Category Name</label>
          <input type="text" class="form-control"value="{{$data->category_name}}" name="category_name" placeholder="Enter Category Name">
        </div>
        <div class="form-group mb-2">
        <label for="">Upload Image</label>
          <input accept="image/*" type="file" name="category_image" class="form-control" id="imageInput">

          <input type="text" name="category_old_image" class="form-control d-none" value="{{$data->category_image}}">

          <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{ asset('Backend/uploads/photos/'.$data->category_image) }}" alt="">
        </div>
        <div class="form-group mb-2">
          <label for="">Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Enter Slug" value="{{$data->slug}}">
        </div>
        <div class="form-group mb-2">
          <label for="">Status</label>
          <select type="text" class="form-select" name="status">
              <option value="">Select</option>
              <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>
      
    </div>
    <div class="card-footer">
    <button type="submit" class="btn btn-success">Update Now</button>
    </div>
  </form>
   </div>

@endsection

@section('script')
  <script type="text/javascript">
      $(document).ready(function(){
        imageInput.onchange = evt => {
          const [file] = imageInput.files
          if (file) {
            showImage.src = URL.createObjectURL(file)
          }
        }
      });
  </script>
@endsection

