 <!-- Add Inovice Modal-->
 <div class="modal fade bs-example-modal-lg" id="invoiceModal" tabindex="-1" role="dialog"
 aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog " role="document">
    <div class="modal-content col-md-12">
       <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span
             class="mdi mdi-account-check mdi-18px"></span> &nbsp;Invoice Summery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
          <form id="paymentForm">

             <div class="form-group mb-2">
                <label>Total Amount </label>
                <input readonly class="form-control table_total_amount" name="table_total_amount" type="text">
             </div>
             <div class="form-group mb-2">
                <label>Paid Amount </label>
                <input  type="text" class="form-control table_paid_amount" name="table_paid_amount" value="0">
             </div>
             <div class="form-group mb-2">
                <label> Discount Amount </label>
                <input  type="text" class="form-control table_discount_amount" name="table_discount_amount" value="00">
             </div>
             <div class="form-group mb-2">
                <label> Due Amount </label>
                <input type="text" readonly class="form-control table_due_amount" name="table_due_amount" value="0">
             </div>
             <div class="form-group mb-2">
                <label>Type</label>
                <select type="text" class="form-select table_status" style="width: 100%;" name="table_status">
                  <option value="">---Select---</option>
                  <option value="0">Draf</option>
                  <option value="1">Completed</option>
                  <option value="2">Print Invoice</option>
              </select>
             </div>
             <div class="modal-footer ">
                <button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
                <button type="button" id="save_invoice_btn" class="btn btn-success">Save Invoice</button>
             </div>
          </form>
       </div>
    </div>
 </div>
</div>
