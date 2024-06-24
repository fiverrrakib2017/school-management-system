<!-- Vendor -->
<script src="{{ asset('Backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- third party js -->
<script src="{{ asset('Backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('Backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src="{{ asset('Backend/assets/js/pages/datatables.init.js') }}"></script>

<!-- Dashboard init js -->
<script src="{{ asset('Backend/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ asset('Backend/assets/js/toastr.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('Backend/assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include Morris.js and its dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

@yield('script')
