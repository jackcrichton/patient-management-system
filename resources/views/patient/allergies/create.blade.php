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
	                				<h5 class="card-title">Add allergy for {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</h5>
	                				<h6 class="card-subtitle mb-2 text-muted">Existing allergies are not displayed.</h6>
	                			</div>

	                			<div class="col-md-1">
	                				<a href="/patient-allergies/{{ $patient->id }}">
						            	<button class="btn btn-primary float-right">Back</button>
						            </a>
	                			</div>
	                		</div>
            			</div>
                    </div>

                    <div class="container">
                    	@if($unsetAllergies->count() == 0)
                    		<hr>
                    		<div class="container">
                    			<h2>No more allergies can be added to this patient.</h2>

                    			<br>
                    		</div>
                		@else
		                    <div class="table-responsive">
			                    <table class="table">
			                        <thead>
			                            <tr>
			                                <th scope="col">Type</th>
			                                <th scope="col">Name</th>
			                                <th scope="col">Agent</th>
			                                <th></th>
			                            </tr>
			                        </thead>

		                            @foreach($unsetAllergies as $allergy)
			                            <tbody>
		                                    <tr>
		                                        <td>{{ $allergy->type }}</td>
		                                        <td>{{ $allergy->name }}</td>
		                                        <td>{{ $allergy->agent }}</td>
		                                        <td>
	                                        		<form method="POST" action="{{ route('patient-allergies.store') }}">
						               				{{ csrf_field() }}

												        <input type="hidden" class="form-control" id="patientId" name="patientId" value="{{ $patient->id }}" required>

												        <input type="hidden" class="form-control" id="allergyId" name="allergyId" value="{{ $allergy->id }}" required>

														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
														  Add Allergy
														</button>

														<!-- Modal -->
														<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
														  	<div class="modal-dialog" role="document">
														    	<div class="modal-content">
														     		<div class="modal-header">
													        			<h5 class="modal-title">Add Allergy</h5>

																        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																         	<span aria-hidden="true">&times;</span>
																        </button>
														      		</div>

																     <div class="modal-body">
												      	  	              <div class="form-group">
																			<label for="comment">Reaction Severity:</label>

																			<select class="custom-select" name="reactionSeverity" id="reactionSeverity" required>
																				<option selected></option>

																				@foreach($severity as $s)
																					<option>{{ $s }}</option>
																				@endforeach
																			</select>
																		</div>
																	

															            <div class="form-group">
																			<label for="comment">Reaction:</label>

																			<textarea class="form-control" rows="5" name="reaction" id="reaction" required></textarea>
																		</div>

															            <div class="form-group">
																			<label for="comment">Source of Information:</label>

																			<select class="custom-select" name="sourceOfInfo" id="sourceOfInfo" required>
																				<option selected></option>

																				@foreach($sourceOfInfo as $s)
																					<option>{{ $s }}</option>
																				@endforeach
																			</select>
																		</div>

																	     <div class="form-group">
																			<label for="comment">Status:</label>

																			<select class="custom-select" name="status" id="status" required>
																				<option selected></option>

																				@foreach($status as $s)
																					<option>{{ $s }}</option>
																				@endforeach
																			</select>
																		</div>
														      		</div>

															      	<div class="modal-footer">
															        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

															        	<button role="button" type="submit" class="btn btn-primary float-right">Add Allergy</button>
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