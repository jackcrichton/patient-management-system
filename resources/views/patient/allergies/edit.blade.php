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
	                				<h5 class="card-title">Edit allergy information for {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</h5>
	                			</div>

	                			<div class="col-md-1">
	                				<a href="/patient-allergies/{{ $patient->id }}">
						            	<button class="btn btn-primary float-right">Back</button>
						            </a>
	                			</div>
	                		</div>
            			</div>

            			<hr>

	                    <div class="container">
		               		<form method="POST" action="{{ route('patient-allergies.update', $patientAllergy->id) }}">
	               				{{ csrf_field() }}
	                    	    @method('PUT')

            	                 <div class="form-group">
									<label for="comment">Reaction Severity:</label>

									<select class="custom-select" name="reactionSeverity" id="reactionSeverity"  value="{{ $patientAllergy->reactionSeverity }}" required>

										@foreach($severity as $s)
											<option>{{ $s }}</option>
										@endforeach
									</select>
								</div>
							

					            <div class="form-group">
									<label for="comment">Reaction:</label>

									<input class="form-control" type="text" name="reaction" id="reaction" value="{{ $patientAllergy->reaction }}" required>
								</div>

					            <div class="form-group">
									<label for="comment">Source of Information:</label>

									<select class="custom-select" name="sourceOfInfo" id="sourceOfInfo" value="{{ $patientAllergy->sourceOfInfo }}"  required>

										@foreach($sourceOfInfo as $s)
											<option value="{{ $patientAllergy->sourceOfInfo }}" {{ $patientAllergy->sourceOfInfo == $s ? 'selected' : ''}}>{{ $s }}</option>
										@endforeach
									</select>
								</div>

							     <div class="form-group">
									<label for="comment">Status:</label>

									<select class="custom-select" name="status" id="status" value="{{ $patientAllergy->status }}"  required>
										
										@foreach($status as $s)
											<option>{{ $s }}</option>
										@endforeach
									</select>
								</div>

								<button role="button" type="submit" class="btn btn-primary float-right">Save</button>
							</form>

							<form method="POST" action="{{ route('patient-allergies.destroy', $patientAllergy )}}">
							{{ csrf_field() }}
							@method('DELETE')

								<button role="button" type="submit" class="btn btn-danger float-left">Remove allergy</button>
							</form>

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
	        </div>
	    </div>
	</div>
@endsection