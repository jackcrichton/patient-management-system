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
	                				<h5 class="card-title">Edit allergy informationfor {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</h5>
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
											<option value="{{ $patientAllergy->reactionSeverity }}" {{ $patientAllergy->reactionSeverity == $s ? 'selected' : ''}}>{{ $s }}</option>
										@endforeach
									</select>
								</div>
							

					            <div class="form-group">
									<label for="comment">Reaction:</label>

									<textarea class="form-control" rows="5" name="reaction" id="reaction" value="{{ $patientAllergy->reaction }}" required></textarea>
								</div>

					            <div class="form-group">
									<label for="comment">Source of Information:</label>

									<select class="custom-select" name="sourceOfInfo" id="sourceOfInfo" value="{{ $patientAllergy->sourceOfInfo }}"  required>
										<option selected></option>

										@foreach($sourceOfInfo as $s)
											<option value="{{ $patientAllergy->sourceOfInfo }}" {{ $patientAllergy->sourceOfInfo == $s ? 'selected' : ''}}>{{ $s }}</option>
										@endforeach
									</select>
								</div>

							     <div class="form-group">
									<label for="comment">Status:</label>

									<select class="custom-select" name="status" id="status" value="{{ $patientAllergy->status }}"  required>
										<option selected></option>

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
		        		</div>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</div>
@endsection