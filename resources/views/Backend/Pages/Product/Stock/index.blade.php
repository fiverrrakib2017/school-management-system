@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
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
          <a class="breadcrumb-item" href="{{route('admin.products.index')}}">Product</a>
          <span class="breadcrumb-item active">Stock</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Image</th>
          <th class="">Product Name</th>  
          <th class="">Stock</th>
          <th class="">Sku</th>
        
        </tr>
      </thead>
      <tbody>
        @foreach($products as $index => $product)
            @php
                $title = strlen($product->title) > 50 ? substr($product->title, 0, 50) . '...' : $product->title;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if(isset($product->product_image[0]))
                    <img src="{{ asset(request()->host().'/uploads/product/' . $product->product_image[0]->image ) }}" alt="" srcset="" width="40px" height="40px" class="image-fluid">
                    @else
                    <span>No Image</span>
                    @endif
                </td>
                <td>
                    {{ $title }}
                </td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->sku }}</td>
                
            </tr>
            @endforeach
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
  <script type="text/javascript">
    $(document).ready(function(){
     
        $("#datatable1").DataTable();
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });
  </script>



  
@endsection
