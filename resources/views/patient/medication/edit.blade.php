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
	                				<h5 class="card-title">Edit medication information for {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</h5>
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
		               		<form method="POST" action="{{ route('patient-medication.update', $patientMedication->id) }}">
	               				{{ csrf_field() }}
	                    	    @method('PUT')

                	            <div class="form-group">
									<label for="comment">Start Date</label>
							    	<input class="form-control" type="date" name="start_date" id="start_date" value="{{ $patientMedication->start_date }}" required>
							    </div>

					            <div class="form-group">
									<label for="comment">End Date</label>

							    	<input class="form-control" type="date" name="end_date" id="end_date" value="{{ $patientMedication->end_date }}" required>
							    </div>

						       <div class="form-group">
									<label for="comment">Quantity</label>

									<select class="custom-select" name="quantity" id="quantity" value="{{ $patientMedication->quantity }}" required>

									<?php for ($i = 1; $i <= 20; $i++) : ?>
								        <option><?php echo $i; ?></option>
								    <?php endfor; ?>

									</select>
								</div>

								<div class="form-group">
									 <div class="form-group">
									<label for="comment">Notes:</label>

									<input class="form-control" type="text" name="notes" id="notes" value="{{ $patientMedication->notes }}" required>
								</div>

								<button role="button" type="submit" class="btn btn-primary float-right">Save</button>
							</form>

							<form method="POST" action="{{ route('patient-medication.destroy', $patientMedication )}}">
							{{ csrf_field() }}
							@method('DELETE')

								<button role="button" type="submit" class="btn btn-danger float-left">Remove medication</button>
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