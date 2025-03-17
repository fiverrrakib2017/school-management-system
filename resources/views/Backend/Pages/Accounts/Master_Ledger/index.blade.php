@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" id="tableStyle">
                    <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                              <th class="">No.</th>
                              <th class="">Master Ledger Name</th>
                              <th class="">Status</th>
                              <th class="">Create Date</th>
                            </tr>
                        </thead>
                        <tbody>

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

     var table=$("#datatable1").DataTable({
       "processing":true,
       "responsive": true,
       "serverSide":true,
       beforeSend: function () {
         //$('#preloader').addClass('active');
       },
       complete: function(){
         //$('.product_loading').css({"display":"none"});
       },
       ajax: "{{ route('admin.master_ledger.all_data') }}",
       language: {
         searchPlaceholder: 'Search...',
         sSearch: '',
         lengthMenu: '_MENU_ items/page',
       },
       "columns":[
         {
           "data":"id"
         },
         {
           "data":"name"
         },
         {
           "data":"status",
           render:function(data,type,row){
               if (row.status==1) {
                   return '<span class="badge bg-success">Active</span>';
               }else{
                   return '<span class="badge bg-danger">Inactive</span>';
               }
           }
         },
         {
           "data":"created_at",
           render: function (data, type, row) {
               var formattedDate = moment(row.created_at).format('DD MMM YYYY');
               return formattedDate;
           }
         },
       ],
       order:[
         [0, "desc"]
       ],

     });
     $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
   });





  </script>




@endsection
