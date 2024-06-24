@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')

@endsection
@section('content')
<div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
    <div class="card-title bg-info text-white text-center">
      <h4>Update Brand</h4>
    </div>
    <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
      <div class="form-group d-none">
          <label for="">Brand Id</label>
          <input type="text" class="form-control" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group mb-2">
          <label for="">Brand Name</label>
          <input type="text" class="form-control" name="brand_name" placeholder="Enter Brand Name" value="{{$data->brand_name}}" required>
        </div>
        <div class="form-group mb-2">
        <label for="">Upload Image</label>
          <input accept="image/*" type="file" name="brand_image" class="form-control" id="imageInput">

          <input type="text" name="brand_old_image" class="form-control d-none" value="{{$data->brand_image}}">

          <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{ asset('Backend/uploads/photos/'.$data->brand_image) }}" alt="">
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

