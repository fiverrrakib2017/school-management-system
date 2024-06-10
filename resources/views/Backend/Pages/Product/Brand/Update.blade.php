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
          <a class="breadcrumb-item" href="index.html">Dashboard</a>
          <a class="breadcrumb-item" href="#">Brand</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;"> 
   <div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
    <div class="card-header bg-info text-white">
      <h6>Update Brand</h6>
    </div>
    <div class="card-body">
      <form method="post" action="{{ route('admin.brand.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group d-none">
          <label for="">Brand Id</label>
          <input type="text" class="form-control" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
          <label for="">Brand Name</label>
          <input type="text" class="form-control"value="{{$data->brand_name}}" name="brand_name" placeholder="Enter Brand Name">
        </div>
        <div class="form-group">
          <label for="">Upload Image</label>
          <input accept="image/*" type="file" name="brand_image" class="form-control" id="imageInput">

          <input type="text" name="brand_old_image" class="form-control d-none" value="{{$data->brand_image}}">

          <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{ asset('Backend/images/brands/'.$data->brand_image) }}" alt="">
        </div>
        <div class="form-group">
          <label for="">Slug</label>
          <input type="text" class="form-control" name="slug" placeholder="Enter Slug" value="{{$data->slug}}">
        </div>
        <div class="form-group">
          <label for="">Status</label>
          <select type="text" class="form-control" name="status">
              <option value="">Select</option>
              <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
              <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Update Now</button>
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

