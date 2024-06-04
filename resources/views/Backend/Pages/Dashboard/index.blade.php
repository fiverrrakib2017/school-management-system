@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')

@section('content')
        <div class="row">
          <div class="col-md-2 offset-md-10 mt-3 mb-2">
            <div >
              <select name="dateFilter" class="form-control select2" data-placeholder="Choose location">
                <option label="Choose one"></option>
                <option value="today" selected>Today</option>
                <option value="last7days" >Last 7 Days</option>
                <option value="lastmonth">Last Month</option>
                <option value="lastyear">Last Year</option>
                <option value="last2years">Last 2 Years</option>
              </select>
            </div><!-- wd-200 -->
          </div>
        </div>

        <div class="row ">
        
          <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-cash tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Sales</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">৳ <span id="total_sales_amount">00</span></p>
                </div>
              </div>
              <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-card tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Purchase</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">৳ <span id="total_purchase_amount">00</span></p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-ios-cart tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Orders</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><span id="total_product_order">0</span></p>
                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-cash tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Net Profit </p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">৳ <span id="total_net_income">00</span></p>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

        </div><!-- row -->
        
        <div class="row " style="margin-top: 22px;">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-ios-people tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Customers</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><span id="total_customer"></span></p>
                </div>
              </div>
              <div id="ch8" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-primary  rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-ios-people tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Suppliers</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><span id="total_supplier">0</span></p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-cube tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Products</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><span id="total_products">0</span></p>
                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
              <i class="ion ion-ios-people tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Seller </p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1"><span id="total_seller">0</span></p>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

        </div><!-- row -->
        <div class="row row-sm mg-t-20">
          <div class="col-lg-6">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent pd-20">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Latest Customer</h6>
              </div><!-- card-header -->
              <div class="card-body text-center" id="latest_customer">
              <img class="img-fluid" height="80px" width="100px" src="{{asset('images/Loading_icon.gif')}}" alt="">
              </div>
              <table id="table1" class="d-none table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                    <th class="wd-10p pd-y-5">&nbsp;</th>
                    <th class="pd-y-5">Customer Name</th>
                    <th class="pd-y-5">Type</th>
                    <th class="pd-y-5">Date</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <a href=""><i class="fa fa-angle-down mg-r-5"></i>View All Customer Data</a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->
          <div class="col-lg-6 mg-t-20 mg-lg-t-0">
            <div class="card shadow-base bd-0">
              <div class="card-header pd-20 bg-transparent">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Top Rated Product </h6>
              </div><!-- card-header -->
              <table class="table table-responsive mg-b-0 tx-12">
                <thead>
                  <tr class="tx-10">
                    <th class="wd-10p pd-y-5">&nbsp;</th>
                    <th class="pd-y-5">Item Details</th>
                    <th class="pd-y-5 tx-right">Sold</th>
                    <th class="pd-y-5">Gain</th>
                    <th class="pd-y-5 tx-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="pd-l-20">
                      <img src="https://via.placeholder.com/800x533" class="wd-55" alt="Image">
                    </td>
                    <td>
                      <a href="" class="tx-inverse tx-14 tx-medium d-block">The Dothraki Shoes</a>
                      <span class="tx-11 d-block"><span class="square-8 bg-danger mg-r-5 rounded-circle"></span> 20 remaining</span>
                    </td>
                    <td class="valign-middle tx-right">3,345</td>
                    <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>33.34%</span> from last week</td>
                    <td class="valign-middle tx-center">
                      <a href="" class="tx-gray-600 tx-24"><i class="icon ion-android-more-horizontal"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="pd-l-20">
                      <img src="https://via.placeholder.com/800x533" class="wd-55" alt="Image">
                    </td>
                    <td>
                      <a href="" class="tx-inverse tx-14 tx-medium d-block">Westeros Sneaker</a>
                      <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                    </td>
                    <td class="valign-middle tx-right">720</td>
                    <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>21.20%</span> from last week</td>
                    <td class="valign-middle tx-center">
                      <a href="" class="tx-gray-600 tx-24"><i class="icon ion-android-more-horizontal"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="pd-l-20">
                      <img src="https://via.placeholder.com/800x533" class="wd-55" alt="Image">
                    </td>
                    <td>
                      <a href="" class="tx-inverse tx-14 tx-medium d-block">Selonian Hand Bag</a>
                      <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                    </td>
                    <td class="valign-middle tx-right">1,445</td>
                    <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>23.34%</span> from last week</td>
                    <td class="valign-middle tx-center">
                      <a href="" class="tx-gray-600 tx-24"><i class="icon ion-android-more-horizontal"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="pd-l-20">
                      <img src="https://via.placeholder.com/800x533" class="wd-55" alt="Image">
                    </td>
                    <td>
                      <a href="" class="tx-inverse tx-14 tx-medium d-block">Kel Dor Sunglass</a>
                      <span class="tx-11 d-block"><span class="square-8 bg-warning mg-r-5 rounded-circle"></span> 45 remaining</span>
                    </td>
                    <td class="valign-middle tx-right">2,500</td>
                    <td class="valign-middle"><span class="tx-success"><i class="icon ion-android-arrow-up mg-r-5"></i>28.78%</span> from last week</td>
                    <td class="valign-middle tx-center">
                      <a href="" class="tx-gray-600 tx-24"><i class="icon ion-android-more-horizontal"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td class="pd-l-20">
                      <img src="https://via.placeholder.com/800x533" class="wd-55" alt="Image">
                    </td>
                    <td>
                      <a href="" class="tx-inverse tx-14 tx-medium d-block">Kubaz Sunglass</a>
                      <span class="tx-11 d-block"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> In stock</span>
                    </td>
                    <td class="valign-middle tx-14 tx-right">223</td>
                    <td class="valign-middle"><span class="tx-danger"><i class="icon ion-android-arrow-down mg-r-5"></i>18.18%</span> from last week</td>
                    <td class="valign-middle tx-center">
                      <a href="" class="tx-gray-600 tx-24"><i class="icon ion-android-more-horizontal"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="card-footer tx-12 pd-y-15 bg-transparent">
                <a href=""><i class="fa fa-angle-down mg-r-5"></i>View All Products</a>
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-6 -->
        </div><!-- row -->
        <div class="row row-sm mg-t-20">
          <div class="col-lg-8">
            <div class="card bd-0 shadow-base">
              <div class="d-md-flex justify-content-between pd-25">
                <div>
                  <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">How Engaged Our Users Daily</h6>
                  <p>Past 30 Days — Last Updated Oct 14, 2017</p>
                </div>
                <div class="d-sm-flex">
                  <div>
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Bounce Rate</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">23.32%</h4>
                    <span class="tx-12 tx-success tx-roboto">2.7% increased</span>
                  </div>
                  <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Page Views</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">38.20%</h4>
                    <span class="tx-12 tx-danger tx-roboto">4.65% decreased</span>
                  </div>
                  <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Time On Site</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">12:30</h4>
                    <span class="tx-12 tx-success tx-roboto">1.22% increased</span>
                  </div>
                </div><!-- d-flex -->
              </div><!-- d-flex -->

              <div class="pd-l-25 pd-r-15 pd-b-25">
                <div id="ch5" class="ht-250 ht-sm-300"></div>
              </div>
            </div><!-- card -->

            <div class="card bd-0 shadow-base pd-25 mg-t-20">
              <div class="d-md-flex justify-content-between">
                <div>
                  <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">How Engaged Our Users Daily</h6>
                  <p>Past 30 Days — Last Updated Oct 14, 2017</p>
                </div>
                <div class="wd-200">
                  <select class="form-control select2" data-placeholder="Choose location">
                    <option label="Choose one"></option>
                    <option value="1" selected>New York</option>
                    <option value="2">San Francisco</option>
                    <option value="3">Los Angeles</option>
                    <option value="4">Chicago</option>
                    <option value="5">Seattle</option>
                  </select>
                </div><!-- wd-200 -->
              </div><!-- d-flex -->
              <div class="row mg-t-20">
                <div class="col-sm-9">
                  <div id="ch12" class="ht-250 ht-sm-300"></div>
                </div><!-- col-9 -->
                <div class="col-sm-3 mg-t-40 mg-sm-t-0">
                  <div>
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Bounce Rate</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">23.32%</h4>
                    <span class="tx-12 tx-success tx-roboto">2.7% increased</span>
                  </div>
                  <div class="mg-t-20 pd-t-20 bd-t">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Page Views</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">38.20%</h4>
                    <span class="tx-12 tx-danger tx-roboto">4.65% decreased</span>
                  </div>
                  <div class="mg-t-20 pd-t-20 bd-t">
                    <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Time On Site</p>
                    <h4 class="tx-lato tx-inverse tx-bold mg-b-0">12:30</h4>
                    <span class="tx-12 tx-success tx-roboto">1.22% increased</span>
                  </div>
                </div><!-- col-3 -->
              </div><!-- row -->
            </div><!-- card -->

          


          </div><!-- col-8 -->
          <div class="col-lg-4 mg-t-20 mg-lg-t-0">

            <div class="card shadow-base bd-0 overflow-hidden">
              <div class="pd-x-25 pd-t-25">
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1 mg-b-20">Storage Overview</h6>
                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase mg-b-0">As of Today</p>
                <h1 class="tx-56 tx-light tx-inverse mg-b-0">755<span class="tx-teal tx-24">gb</span></h1>
                <p><span class="tx-primary">80%</span> of free space remaining</p>
              </div><!-- pd-x-25 -->
              <div id="ch6" class="ht-115 mg-r--1"></div>
              <div class="bg-teal pd-x-25 pd-b-25 d-flex justify-content-between">
                <div class="tx-center">
                  <h3 class="tx-lato tx-white mg-b-5">989<span class="tx-light op-8 tx-20">gb</span></h3>
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-0 tx-white-8">Total Space</p>
                </div>
                <div class="tx-center">
                  <h3 class="tx-lato tx-white mg-b-5">234<span class="tx-light op-8 tx-20">gb</span></h3>
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-0 tx-white-8">Used Space</p>
                </div>
                <div class="tx-center">
                  <h3 class="tx-lato tx-white mg-b-5">80<span class="tx-light op-8 tx-20">%</span></h3>
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-0 tx-white-8">Free Space</p>
                </div>
              </div>
            </div><!-- card -->

            <div class="card shadow-base bd-0 mg-t-20">
              <div id="carousel3" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel3" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel3" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="bg-white ht-300 pos-relative overflow-hidden d-flex flex-column align-items-start rounded">
                      <div class="pos-absolute t-15 r-25">
                        <a href="" class="tx-gray-500 hover-info mg-l-7"><i class="icon ion-more tx-20"></i></a>
                      </div>
                      <div class="pd-x-30 pd-t-30 mg-b-auto">
                        <p class="tx-info tx-uppercase tx-11 tx-semibold tx-mont mg-b-5">Product Item #1</p>
                        <h5 class="tx-inverse mg-b-20">Samsung Galaxy S8</h5>
                        <p class="tx-uppercase tx-11 tx-semibold tx-mont mg-b-0">Purchases</p>
                        <h2 class="tx-inverse tx-lato tx-bold mg-b-0">2366</h2>
                        <span>53.86 purchases/month</span>
                      </div>
                      <div id="ch10" class="ht-100 tr-y-1"></div>
                    </div><!-- d-flex -->
                  </div>
                  <div class="carousel-item">
                    <div class="bg-white ht-300 pos-relative overflow-hidden d-flex flex-column align-items-start rounded">
                      <div class="pos-absolute t-15 r-25">
                        <a href="" class="tx-gray-500 hover-info mg-l-7"><i class="icon ion-more tx-20"></i></a>
                      </div>
                      <div class="pd-x-30 pd-t-30 mg-b-auto">
                        <p class="tx-info tx-uppercase tx-11 tx-semibold tx-mont mg-b-5">Product Item #2</p>
                        <h5 class="tx-inverse mg-b-20">Apple iPhone 8 Plus</h5>
                        <p class="tx-uppercase tx-11 tx-semibold tx-mont mg-b-0">Purchases</p>
                        <h2 class="tx-inverse tx-lato tx-bold mg-b-0">5632</h2>
                        <span>120.44 purchases/month</span>
                      </div>
                      <div id="ch11" class="ht-100 tr-y-1"></div>
                    </div><!-- d-flex -->
                  </div><!-- cardousel-item -->
                </div><!-- carousel-inner -->
              </div><!-- carousel -->
            </div><!-- card -->

            <div class="card card-body bd-0 pd-25 bg-primary mg-t-20">
              <div class="d-xs-flex justify-content-between align-items-center tx-white mg-b-20">
                <h6 class="tx-13 tx-uppercase tx-semibold tx-spacing-1 mg-b-0">Server Status</h6>
                <span class="tx-12 tx-uppercase">Oct 2017</span>
              </div>
              <p class="tx-sm tx-white tx-medium mg-b-0">Hardware Monitoring</p>
              <p class="tx-12 tx-white-7">Intel Dothraki G125H 2.5GHz</p>
              <div class="progress bg-white-3 rounded-0 mg-b-0">
                <div class="progress-bar bg-success wd-50p lh-3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
              </div><!-- progress -->
              <p class="tx-11 mg-b-0 mg-t-15 tx-white-7">Notice: Lorem ipsum dolor sit amet.</p>
            </div><!-- card -->

         
          

          </div><!-- col-4 -->
        </div><!-- row -->
       
@endsection

@section('script')
  <script type="text/javascript"> 
    $(document).ready(function(){
      /*get top rated product*/
      __top_rated_product();
       /*get Latest Customer Data Dashboard Page*/
      __customer_data();

      function getTodayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();
        return yyyy + '-' + mm + '-' + dd;
      }
      var todayDate = getTodayDate();
      __fetch_data(todayDate);

      $('select[name="dateFilter"]').on('change',function (){
        var data = $(this).val();
        if (data==="today") {
          var date=__getTodayDate();
          __fetch_data(date);
        }else if(data==='last7days'){
          var date=__last_seven_days(7);
          __fetch_data(date);
        }else if(data==='lastmonth'){
          var date=__get_last_month();
          __fetch_data(date);
        }else if(data==='lastyear'){
          var date=__get_last_year();
          __fetch_data(date);
        }else if(data==='last2years'){
          var date=__get_last_two_years(2);
          __fetch_data(date);
        }else{
          console.log('Server Error: ');
        }
      });

      function __getTodayDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();
        return yyyy + '-' + mm + '-' + dd;
      }
      function __last_seven_days(days) {
        var today = new Date();
        today.setDate(today.getDate() - days);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();
        return yyyy + '-' + mm + '-' + dd;
      }
      function __get_last_month() {
        var today = new Date();
        var mm = String(today.getMonth()).padStart(2, '0');
        var yyyy = today.getFullYear();
        return yyyy + '-' + mm + '-01'; 
      }

      function __get_last_year() {
        var today = new Date();
        var yyyy = today.getFullYear() - 1;
        return yyyy + '-01-01'; 
      }

      function __get_last_two_years(years) {
        var today = new Date();
        var yyyy = today.getFullYear() - years;
        return yyyy + '-01-01'; 
      }
      function __fetch_data(date){
        $.ajax({
          url:"{{route('admin.dashboard_get_all_data')}}",
          type:'POST',
          data:{date:date},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success:function(response){
            $('#total_sales_amount').text(response.total_sales_amount);
            $('#total_purchase_amount').text(response.total_purchase_amount);
            $('#total_net_income').text(response.net_income);
            $('#total_customer').text(response.total_customer);
            $('#total_supplier').text(response.total_supplier);
            $('#total_products').text(response.total_products);
            $('#total_seller').text(response.total_seller);
            $('#total_product_order').text(response.total_product_order);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
      /*get Latest Customer Data Dashboard Page*/
      function __customer_data(){
        $.ajax({
          url:"{{route('admin.dashboard_get_all_data')}}",
          type:'POST',
          data:{data:'customer_data'},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success:function(response){
            $("#latest_customer").attr('class','d-none');
            $("#table1").removeClass('d-none');
            var __baseUrl = '{{ url("/")}}';
             var __tbody=$("#table1 tbody");
             __tbody.empty();
            for (let i = 0; i < response.length; i++) {
            var customer = response[i];
            /*Formate the data*/
            var formatted_date=new Date(customer.created_at);
            var __month_names=["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var __formated_string=__month_names[formatted_date.getMonth()] + ' ' +
            formatted_date.getDate() + ', ' +
            formatted_date.getFullYear() + ' ' +
            formatted_date.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
            var __profile_image=__baseUrl + '/Backend/images/customer/' + customer.profile_image;
            console.log(__profile_image);
            /*Create a new table row*/ 
            var newRow = $("<tr>");
            newRow.append('<td class="pd-l-20"><img src="https://via.placeholder.com/500" class="wd-36 rounded-circle" alt="Image"></td>');
            newRow.append('<td><a href="" class="tx-inverse tx-14 tx-medium d-block">' + customer.fullname + '</a></td>');
            newRow.append('<td class="tx-12"><span class="square-8 bg-success mg-r-5 rounded-circle"></span>Active</td>');
            newRow.append('<td>' + __formated_string + '</td>'); 
            
            // Append the new row to the table body
            __tbody.append(newRow);
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Hide loading spinner on error
            $("#latest_customer").addClass('d-none');
            $("#table1").removeClass('d-none');
          }
        });
      }
      /*get Latest Customer Data Dashboard Page*/
      function  __top_rated_product(){
        $.ajax({
          url:"{{route('admin.dashboard_get_all_data')}}",
          type:'POST',
          data:{data:'get_top_rated_product'},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          success:function(response){
            console.log(response);
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Hide loading spinner on error
           // $("#latest_customer").addClass('d-none');
           // $("#table1").removeClass('d-none');
          }
        });
      }
    });

  </script>
@endsection