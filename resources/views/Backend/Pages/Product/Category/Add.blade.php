@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')

@endsection
@section('content')
<div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
    <div class="card-title bg-info text-white text-center">
      <h4>Add New Category</h4>
    </div>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
        <div class="form-group mb-2">
          <label for="">Category Name</label>
          <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required>
        </div>
        <div class="form-group mb-2">
        <label for="">Category Image</label>
          <input accept="image/*" type="file" name="category_image" class="form-control" id="imageInput"><br>
          <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{asset('Backend/images/default.jpg')}}" alt="">
        </div>
        <div class="form-group mb-2">
          <label for="">Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Enter Slug">
        </div>
        <div class="form-group mb-2">
          <label for="">Status</label>
          <select type="text" class="form-select" name="status" required>
              <option value="">Select</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
          </select>
        </div>
      
    </div>
    <div class="card-footer">
    <button type="submit" class="btn btn-success">Add Now</button>
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

