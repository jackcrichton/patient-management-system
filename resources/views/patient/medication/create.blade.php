@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">	        
	        	<div class="card">
                    <div class="card-body">
                    	<div class="container">
                    		<div class="row">
                    			<div class="col-md-11">
	                				<h5 class="card-title">Add Medication for {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</h5>
	                				<h6 class="card-subtitle mb-2 text-muted">Existing medication prescriptions are not displayed.</h6>
	                			</div>

	                			<div class="col-md-1">
	                				<a href="/patient-medication/{{ $patient->id }}">
						            	<button class="btn btn-primary float-right">Back</button>
						            </a>
	                			</div>
	                		</div>
            			</div>
                    </div>

                    <div class="container">
                    	@if($unsetMedication->count() == 0)
                    		<hr>
                    		<div class="container">
                    			<h2>No more medications can be prescribed to this patient.</h2>

                    			<br>
                    		</div>
                		@else
		                    <div class="table-responsive">
			                    <table class="table">
			                        <thead>
			                            <tr>
			                                <th scope="col">Name</th>
			                                <th scope="col">Dose</th>
			                                <th></th>
			                            </tr>
			                        </thead>

			                        {{dd($unsetMedication)}}
		                            @foreach($unsetMedication as $medication)
			                            <tbody>
		                                    <tr>
		                                        <td>{{ $medication->name }}</td>
		                                        <td>{{ $medication->dose }}</td>
		                                        <td>
	                                        		<form method="POST" action="{{ route('patient-medication.store') }}">
						               				{{ csrf_field() }}

												        <input type="hidden" class="form-control" id="patientId" name="patientId" value="{{ $patient->id }}" required>

												        <input type="hidden" class="form-control" id="medicationId" name="medicationId" value="{{ $medication->id }}" required>

														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
														  Add Medication
														</button>

														<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														     		<div class="modal-header">
													        			<h5 class="modal-title">Add Medication</h5>

																        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																          	<span aria-hidden="true">&times;</span>
																        </button>
														      		</div>

																     <div class="modal-body">
															            <div class="form-group">
																			<label for="comment">Start Date</label>

																	    	<input class="form-control" type="date" name="start_date" id="start_date" required>
																	    </div>

															            <div class="form-group">
																			<label for="comment">End Date</label>

																	    	<input class="form-control" type="date" name="end_date" id="end_date" required>
																	    </div>

																       <div class="form-group">
																			<label for="comment">Quantity</label>

																			<select class="custom-select" name="quantity" id="quantity" required>
																			<option selected></option>

																			<?php for ($i = 1; $i <= 20; $i++) : ?>
																		        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																		    <?php endfor; ?>

																			</select>
																		</div>

																		<div class="form-group">
																			 <div class="form-group">
																			<label for="comment">Notes:</label>

																			<textarea class="form-control" rows="5" name="notes" id="notes" required></textarea>
																		</div>
														      		</div>

															      	<div class="modal-footer">
															        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

															        	<button role="button" type="submit" class="btn btn-primary float-right">Add Medication</button>
															        </div>

															         @if($errors->any())
												                        <div class="alert alert-danger" role="alert">
												                            @foreach ($errors->all() as $error)

												                            {{ $error }}

												                            @endforeach
												                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												                                <span aria-hidden="true">&times;</span>
												                            </button>
												                        </div>
												                    @endif
														    	</div>
														  	</div>
														</div>
													</form>
		                                        </td>
							                </tr>
							            </tbody>
	                            	@endforeach
		                    	</table>
		                    </div>
	                    @endif
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection