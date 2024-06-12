@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
    <link rel="stylesheet" href="{{ asset('Backend/css/dropzone.min.css') }}" type="text/css" />
    <style>
      /* dropzone.css */
.dropzone {
    border: 2px dashed #287eff !important;
    border-radius: 5px;
    padding: 6px !important;
    text-align: center;
    cursor: pointer;
}

.dz-message {
    font-size: 18px;
    color: #777;
}

#rowImg {
  margin-top: 20px;
  display: flex;
  flex-wrap: wrap-reverse;

  gap:10px;
}
.sortImage{
  height: 100px;
  max-width: 100%;
}


.invalid{
  border: 2px solid rgb(255, 47, 47) !important;
  background: rgba(255, 255, 255, 0.849) !important;
  border-radius: 4px;
}

.errText {
  color: #ff3030 !important;
  font-size: 13px !important ;
  font-weight: 400 !important;
}

.Neon {
    font-family: sans-serif;
    font-size: 14px;
    color: #494949;
    position: relative;


}
.Neon * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;

}
.Neon-input-dragDrop {
    display: block;
    width: 100%;
    margin: 15px 0;
    padding: 25px;
    color: #8d9499;
    color: #97A1A8;
    background: #fff;
    border: 2px dashed #C8CBCE;
    text-align: center;
    -webkit-transition: box-shadow 0.3s, border-color 0.3s;
    -moz-transition: box-shadow 0.3s, border-color 0.3s;
    transition: box-shadow 0.3s, border-color 0.3s;

}
.Neon-input-dragDrop .Neon-input-icon {
    font-size: 48px;
    margin-top: -10px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;

}
.Neon-input-text h3 {
    margin: 0;
    font-size: 18px;
    cursor: pointer;
}
.Neon-input-text span {
    font-size: 12px;
}
.Neon-input-choose-btn.blue {
    color: #008BFF;
    border: 1px solid #008BFF;
}
.Neon-input-choose-btn {
    display: inline-block;
    padding: 8px 14px;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    font-size: 12px;
    font-weight: bold;
    color: #8d9496;
    border-radius: 3px;
    border: 1px solid #c6c6c6;
    vertical-align: middle;
    background-color: #fff;
    box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    transition: all 0.2s;
}



*,
::before,
::after {
  box-sizing: border-box;
  /* 1 */
  border-width: 0;
  /* 2 */
  border-style: solid;
  /* 2 */
  border-color: #e5e7eb;
  /* 2 */
}

::before,
::after {
  --tw-content: '';
}


.textarea {
    padding: 10px;
    border: 1px solid gray;
    border-radius: 5px;
    height: 120px;
    color: black;
}

.textarea:focus{
  outline: none;
}

#scroll{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 90%;
  background-color: white;
  overflow-y: auto;
  padding: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}
    </style>
@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.products.index')}}">Product</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;">
   <div class="row">
    <div class="col-md-9 m-auto">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
          <h6>Add New Product</h6>
        </div>
        <form action="{{ route('admin.products.store') }}" id="productForm" enctype="multipart/form-data" method="post">@csrf
          <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Name</label>
                <input type="text"  class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name" required>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Slug</label>
                <input type="text"  class="form-control" name="slug" id="slug" value="">
                <p class="ierr"></p>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="image_id" id="image_id" hidden>
                  <label for="image" class="label">Upload Image</label>
                  <div id="image" class="dropzone dz-clickable">
                    <div class="dz-message needsclick">
                        <br>Drop files here or click to upload.<br><br>
                    </div>
                </div>
                <div id="rowImg"></div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col">
              <div class="form-group">
                <label for="">Brand</label>
                <select type="text" class="form-control" name="brand_id" id="brand_id" required>
                  <option value="">---Select---</option>
                  @if (count($brand) > 0)

                    @foreach($brand as $item)
                    <option value="{{$item->id}}">{{ $item->brand_name }}</option>
                    @endforeach
                  @endif
                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="">Category</label>
                <select type="text" class="form-control " name="category_id" id="category_id" required>
                  <option value="">Select</option>
                  @if (count($category) > 0)

                    @foreach($category as $item)
                    <option value="{{$item->id}}">{{ $item->category_name }}</option>
                    @endforeach

                  @else
                    <option value="">No Product</option>
                  @endif

                </select>
                <p class="ierr"></p>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Sub Category</label>
                <select type="text" class="form-control " name="sub_cat_id" id="sub_cat_id">
                  <option value="">Select</option>
                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Child Category</label>
                <select type="text" class="form-control " name="child_cat_id" id="child_cat_id">
                  <option value="">Select</option>
                </select>
                <p class="ierr"></p>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Short Description</label>
                <textarea type="text" class="form-control" name="short_description" id="short_description"   placeholder="Enter Your Short Description "></textarea>
                <p class="ierr"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Description</label>
                <textarea type="text" class="form-control"  name="description" id="description" placeholder="Enter Your Description "></textarea>
                <p class="ierr"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Shipping & Returns</label>
                <textarea type="text" class="form-control" id="shipping_returns" name="shipping_returns"></textarea>
                <p class="ierr"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control" id="price"  name="price" placeholder="Enter Your Price" required/>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Sku</label>
                <input type="text" class="form-control" name="sku" id="sku" required/>
                <p class="ierr"></p>
            </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Vat/Tax</label>
                <select type="number" class="form-control" id="tax"  name="tax" required>
                    <option >---Select---</option>
                    <option value="0%">0%</option>
                    <option value="5%">5%</option>
                    <option value="10%">10%</option>
                    <option value="15%">15%</option>
                    <option value="20%">20%</option>
                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Delivery Charge</label>
                <input type="text" class="form-control" name="dellivery_charge" id="dellivery_charge" placeholder="Enter Amount" required/>
                <p class="ierr"></p>
            </div>
            </div>
          </div>



          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="">Size</label>
                <select type="text" class="form-control" id="size" name="size[]" multiple="multiple" >
                <option value="">---Select---</option>
                  @foreach ($size as $item)
                     <option value="{{ $item->name }}">{{ $item->name }}</option>
                  @endforeach

                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="">Color</label>
                <select class="form-control" id="color" name="color[]" multiple="multiple" >
                  <option value="">---Select---</option>
                    @foreach ($color as $item)
                     <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="">Product Type</label>
                <select type="text" class="form-control" name="product_type" id="product_type" required>
                  <option >---Select---</option>
                  <option value="Features">Features</option>
                  <option value="Popular">Popular</option>
                  <option value="New">New</option>
                </select>
                <p class="ierr"></p>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Barcode</label>
                <input type="text" class="form-control"  name="barcode" id="barcode" required/>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="qty" class="label">Quantity</label>
              <input type="number" name="qty" class="form-control" id="qty" placeholder="Enter Quantity" required>
              <p class="ierr"></p>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Status</label>
                <select type="text" class="form-control select2" name="status" id="status" required>
                  <option value="">Select</option>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
                <p class="ierr"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Track Quantity</label><br>
                  <div class="br-toggle br-toggle-rounded br-toggle-primary on">
                    <div class="br-toggle-switch"></div>
                  </div>
              </div>
            </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="button" onclick="history.back();" class="btn btn-danger">Back</button>
            <button type="submit" class=" btn btn-success">Add Now</button>
          </div>
        </form>
    </div>
    </div>
   </div>
</div><!-- br-section-wrapper -->


@endsection
@php
    $tamurl='upload-temp-image';
@endphp
@section('script')
<script src="https://cdn.tiny.cloud/1/zifeh3wuv4rjvx6ktqat7x169antz66gx9iwbh8sztsk1utd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('Backend/js/dropzone.min.js') }}"></script>
  <script type="text/javascript">
    $("#brand_id").select2();
    $("#category_id").select2();
    $("#sub_cat_id").select2();
    $("#child_cat_id").select2();
    $("#status").select2();
    $("#product_type").select2();

    $("#color, #size").select2({
      allowClear: true,
      placeholder: "Select "
    });
    /** Create Automatic Slug **/
    $("#product_name").on('keyup',function(){
        var inputString=$(this).val();
        var result= inputString.replace(/\s+/g, '-').toLowerCase();
        $("#slug").val(result);
    });




      /** Toggles **/
        $('.br-toggle').on('click', function(e){
          e.preventDefault();
          $(this).toggleClass('on');
        })

       /** Editor **/
      tinymce.init({
        selector: '#short_description',
        plugins: 'lists link image',
        toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
        height: 300, // Specify the height of the editor
      });
      tinymce.init({
        selector: '#description',
        plugins: 'lists link image',
        toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
        height: 300, // Specify the height of the editor
      });

      tinymce.init({
        selector: '#shipping_returns',
        plugins: 'lists link image',
        toolbar: 'undo redo | bold italic | bullist numlist | link image',
        height: 300, // Specify the height of the editor
      });


    /** Drag And Drop Image Upload **/
      Dropzone.autoDiscover = false;
      const dropzone = $("#image").dropzone({

        url:  "{{$tamurl}}",
        maxFiles: 10,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            var html = `
            <div id="image-row-${response.image_id}">
                <input type="text" name="image_array[]" value="${response.image_id}" hidden>
                <div  id="border">
                    <img src="${response.imagePath}" class="sortImage">
                    <a href="javascript:void(0)" onclick='deleteImage(${response.image_id})' class="errBtn">Remove</a>
                </div>
            </div>`;
            $('#rowImg').append(html);
        },
        complete: function(file){
            this.removeFile(file);
        },
        error: function(error){
            console.log(error);
        }
    });
    /** Drag And Drop Image Upload **/

    function deleteImage(id){
        $.ajax({
          url: "{{route('admin.product.delete.photo')}}",
          type: 'POST',
          data: {
              id: id,
              'type':'temp_file',
          },
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
              if (response.success==true) {
                $('#image-row-' + id).remove();
                  toastr.success(response.message);
              }
          },
          error: function(xhr, status, error) {
              toastr.error('Server Error');
              console.error(xhr.responseText);
          }
      });
    }
    /* Load Sub Category */
    $(document).on('change',"select[name='category_id']",function (){
      var category_id=$(this).val();
      if (category_id) {
        $.ajax({
          url: '/admin/product/get-sub_category/' + category_id,
          type: 'GET',
          success: function(data) {
              /*Empty Child Category*/
              $('#child_cat_id').empty();
              $('#child_cat_id').append('<option value="">---Select---</option>');
              /*Empty Sub Category*/
              $('#sub_cat_id').empty();
              $('#sub_cat_id').append('<option value="">Select</option>');
              $.each(data, function(key, item) {
                $('#sub_cat_id').append('<option value="' + item.id + '">' + item.name + '</option>');
              });
          }
        });
      }else{
        $('#sub_cat_id').empty();
        $('#sub_cat_id').append('<option value="">Select</option>');
        /*Empty Child Category*/
        $('#child_cat_id').empty();
        $('#child_cat_id').append('<option value="">---Select---</option>');
      }
    });

    /* Load Child Category */
    $(document).on('change',"select[name='sub_cat_id']",function (){
      var sub_cat_id=$(this).val();
      if (sub_cat_id) {
        $.ajax({
          url: '/admin/product/get-child_category/' + sub_cat_id,
          type: 'GET',
          success: function(data) {
              $('#child_cat_id').empty();
              $('#child_cat_id').append('<option value="">---Select---</option>');
              $.each(data, function(key, item) {
                $('#child_cat_id').append('<option value="' + item.id + '">' + item.name + '</option>');
              });
          }
        });
      }else{
        $('#child_cat_id').empty();
        $('#child_cat_id').append('<option value="">---Select---</option>');
      }
    });

    /** Product Store  **/
    $('#productForm').submit(function (e) {
        e.preventDefault();
        tinymce.activeEditor.setProgressState(true);
        tinymce.triggerSave();
        var formArray = $(this).serializeArray();
        $.ajax({
            url: '{{ route("admin.products.store") }}',
            type: 'post',
            data: formArray,
            beforeSend: function () {
              $('form button[type=submit]').prop('disabled', true);
              $("form button[type=submit]").html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            dataType: 'json',
            success: function (response) {
               if (response.status == true) {
                  $('button[type=submit]').prop('disabled', false);
                  $("button[type=submit]").html('Add Now');
                  toastr.success(response.message);
                  window.location.href = "{{ route('admin.products.index') }}";
                } else {
                    var errors = response.errors;
                    $('.errText').html('');
                    $('input, select').removeClass('invalid');
                    $.each(errors, function (key, value) {
                        $(`#${key}`).addClass('invalid')
                            .siblings('p')
                            .addClass('errText')
                            .html(value);
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
     /** Product Add  **/
  </script>
@endsection

