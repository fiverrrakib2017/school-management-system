<div class="modal fade bs-example-modal-lg" id="assignModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog " role="document">
                        <div class="modal-content col-md-12">
                           <div class="modal-header">
                              <h5 class="modal-title" id="assignModalLabel"><span
                                 class="mdi mdi-account-check mdi-18px"></span> &nbsp;New Assign To </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
						   <div class="modal-body">
							  <form action="{{ route('admin.tickets.assign.store') }}" id="assignForm" method="POST" enctype="multipart/form-data">
                                @csrf
									<div class="form-group mb-2">
										<label>Assign To</label>
										<input name="name" placeholder="Enter Assign Name" class="form-control" type="text" required>
									</div>

									<div class="modal-footer ">
										<button data-bs-dismiss="modal" type="button" class="btn btn-danger">Cancel</button>
										<button type="submit" class="btn btn-success">Save Changes</button>
									</div>
								</form>
							</div>
                        </div>
                     </div>
                  </div>
