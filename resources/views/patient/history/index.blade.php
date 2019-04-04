@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
       
		  	<div class="card">
		    	<div class="card-header">
			 		<div class="container">
						<h5>
							{{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}

							<div class="float-right">
								<a href="{{ route('patient.index', $patient->id) }}">
									<button type="submit" class="btn btn-primary">Back</button>
								</a>
							</div>
						</h5>
					</div>
					
					<br>

					<hr>

					<div class="container">
						<ul class="nav nav-pills card-header-pills">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('patient.show', $patient->id) }}">Personal Information</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="{{ route('patient-allergies.show', $patient->id) }}">Allgeries</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="{{ route('patient-medication.show', $patient->id) }}">Medication</a>
							</li>

							<li class="nav-item">
								<a class="nav-link active" href="{{ route('patient-history.show', $patient->id) }}">History</a>
							</li>
						</ul>
					</div>
				</div>

			  	<div class="card-body">
			  		<div class="container">
			  			<h5>Patient History</h5>

			  			<hr>

			  			<div class="col-md-12">
			  				@if(count($historyLog) == 0)
			  					<h3 class="text-center">No allergy or medication changes have been made to this patient yet.</h3>
		  					@else
				  				@foreach($historyLog as $h)
				  					@if ($h->patientAllergyId)
			  							<div class="card text-white bg-{{ $h->type == 'Create' ? 'success' : ($h->type == 'Update' ? 'info' : 'danger')}} mb-3">
									  		<div class="card-header">
									  			Change recorded at {{ $h->created_at }} 

									  			<hr>


												<h4>Type: Allergy</h4>
									  			<h4>Action: {{ $h->type }}</h4>
									  			<h4>Change made by: {{ $h->doctor()->title }} {{ $h->doctor()->forename }} {{ $h->doctor()->surname }}</h4>
									  		</div>

								 			<div class="card-body">
								    			<p class="card-text">Allergy: {{ $h->allergy()->name }}</p>
								    			<p class="card-text">Reaction Severity: {{ $h->reactionSeverity }}</p>
							    				<p class="card-text">Reaction: {{ $h->reaction }}</
							    				p>
							    				<p class="card-text">Source of Information: {{ $h->sourceOfInfo }}</p>
						    					<p class="card-text">Status: {{ $h->status }}</p>
								  			</div>
										</div>
			  						@elseif ($h->patientMedicationId)
										<div class="card text-white bg-{{ $h->type == 'Create' ? 'success' : ($h->type == 'Update' ? 'info' : 'danger')}} mb-3">
									  		<div class="card-header">
									  			Change recorded at {{ $h->created_at }} 

									  			<hr>

									  			<h4>Type: Medication</h4>
									  			<h4>Action: {{ $h->type }}</h4>
						  						<h4>Change made by: {{ $h->doctor()->title }} {{ $h->doctor()->forename }} {{ $h->doctor()->surname }}</h4>
									  		</div>

								 			<div class="card-body">
								    			<p class="card-text">Allergy: {{ $h->medication()->name }}</p>
								    			<p class="card-text">Start Date: {{ $h->start_date }}</
								    				p>
							    				<p class="card-text">End Date: {{ $h->end_date }}</
							    				p>
							    				<p class="card-text">Quantity: {{ $h->quantity }}</p>
						    					<p class="card-text">Notes: {{ $h->notes }}</p>
								  			</div>
								  		</div>
		  							@endif
				  				@endforeach
			  				@endif
			  			</div>
			  		</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection