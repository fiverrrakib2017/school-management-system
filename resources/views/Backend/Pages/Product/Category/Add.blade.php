@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.category.index')}}">Category</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;"> 
   <div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
    <div class="card-header bg-info text-white">
      <h6>Add New Category</h6>
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Category Name</label>
          <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required>
        </div>
        <div class="form-group">
          <label for="">Category Image</label>
          <input accept="image/*" type="file" name="category_image" class="form-control" id="imageInput"><br>
          <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{asset('Backend/images/default.jpg')}}" alt="">
        </div>
        <div class="form-group">
          <label for="">Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Enter Slug">
        </div>
        <div class="form-group">
          <label for="">Status</label>
          <select type="text" class="form-control" name="status" required>
              <option value="">Select</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Add Now</button>
        </div>
      </form>
    </div>
   </div> 
    </div>
   </div>
</div><!-- br-section-wrapper -->


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

