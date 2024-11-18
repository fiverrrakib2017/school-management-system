<div class="modal fade bs-example-modal-lg" id="ticketModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog " role="document">
                        <div class="modal-content col-md-12">
                           <div class="modal-header">
                              <h5 class="modal-title" id="ticketModalLabel"><span
                                 class="mdi mdi-account-check mdi-18px"></span> &nbsp;New Assign To </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
						   <div class="modal-body">
							  <form action="{{ route('admin.tickets.store') }}" id="ticketForm" method="POST" enctype="multipart/form-data">
                                @csrf
									<div class="form-group mb-2">
										<label>Student Name</label>
										<select name="student_id" class="form-select" type="text" style="width: 100%;" required>
                                            <option value="">---Select---</option>
                                            @php
                                                $students = \App\Models\Student::latest()->get();
                                            @endphp
                                            @if($students->isNotEmpty())
                                                @foreach($students as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">No student available</option>
                                            @endif
                                        </select>
									</div>

									<div class="form-group mb-2">
										<label>Ticket For</label>
										<select name="ticket_for" class="form-select" type="text" style="width: 100%;" required>
                                            <option value="">---Select---</option>
                                            <option value="1">Default </option>
                                        </select>
									</div>
									<div class="form-group mb-2">
										<label>Ticket Assign</label>
										<select name="ticket_assign_id" class="form-select" type="text" style="width: 100%;" required>
                                            <option value="">---Select---</option>
                                            @php
                                                $tickets_assign = \App\Models\Ticket_assign::latest()->get();
                                            @endphp
                                            @if($tickets_assign->isNotEmpty())
                                                @foreach($tickets_assign as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Not Data available</option>
                                            @endif
                                        </select>
									</div>
									<div class="form-group mb-2">
										<label>Complain Type</label>
										<select name="ticket_complain_id" class="form-select" type="text" style="width: 100%;" required>
                                            <option value="">---Select---</option>
                                            @php
                                            $tickets_complain = \App\Models\Ticket_complain_type::latest()->get();
                                        @endphp
                                        @if($tickets_complain->isNotEmpty())
                                            @foreach($tickets_complain as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Not Data available</option>
                                        @endif
                                        </select>
									</div>
									<div class="form-group mb-2">
										<label>Priority</label>
										<select name="priority_id" class="form-select" type="text" style="width: 100%;" required>
                                            <option value="">---Select---</option>
                                            <option value="1">Low</option>
                                            <option value="2">Normal</option>
                                            <option value="3">Standard</option>
                                            <option value="4">Medium</option>
                                            <option value="5">High</option>
                                            <option value="6">Very High</option>
                                        </select>
									</div>
									<div class="form-group mb-2">
										<label>Subject</label>
										<input name="subject" class="form-control" type="text" placeholder="Enter Subject" required/>
									</div>
									<div class="form-group mb-2">
										<label>Description</label>
										<textarea name="description" class="form-control" type="text" placeholder="Enter Description" required></textarea>
									</div>
                                    <div class="form-group mb-2">
										<label>Note</label>
										<input name="note" class="form-control" type="text" placeholder="Enter Note"/>
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
