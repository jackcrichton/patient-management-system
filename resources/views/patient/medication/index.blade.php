@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        	@include('flash::message')

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
								<a class="nav-link active" href="{{ route('patient-medication.show', $patient->id) }}">Medication</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="{{ route('patient-history.show', $patient->id) }}">History</a>
							</li>
						</ul>
					</div>
				</div>

			  	<div class="card-body">
			  		<div class="container">
	  			  		<div class="row">
				  			<div class="col-md-11">
						  		<h5>Medications</h5>
						  	</div>

						  	<div class="col-md-1">
					  			<div class="float-right">
		  				            <form method="GET" action="{{ route('patient-medication.create') }}">
	    								{{ csrf_field() }}

	    								<input type="hidden" class="form-control" name="patientId" id="patientId" value="{{ $patient->id }}">

										<button type="submit" class="btn btn-primary">Add Medication</button>
									</form>
								</div>
							</div>
						</div>

						<hr>

			  			<div class="container">
			  				@if($existingPatientMedication->count() == 0)
			  					<h3 class="text-center">This patient has no medication records.</h4>
		  					@else
					  			@foreach($existingPatientMedication as $e)
							  		<div class="row">
						  				<div class="col-md-12">
											<h4 class="card-text">{{ $e->medication()->name }}</h4>
										</div>
									</div>

									<br>

									<div class="row">
										<div class="col-md-6">
											<h5 class="card-text">Dose: <b>{{ $e->medication()->dose }}</b></h5>
										</div>

							  			<div class="col-md-6">
											<h5 class="card-text">Quantity: <b>{{ $e->quantity }}</b></h5>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<h5 class="card-text">Start Date: <b>{{ $e->start_date }}</b></h5>
										</div>

							  			<div class="col-md-6">
											<h5 class="card-text">End Date: <b>{{ $e->end_date }}</b></h5>
										</div>
									</div>

									<br>

									<div class="row">
							  			<div class="col-md-12">
											<p class="card-text">Notes: {{ $e->Notes }}</p>
										</div>
									</div>

									<hr>

									<div class="row">
							  			<div class="col-md-5">
											<p class="card-text">Created at: {{ $e->created_at }}</p>
										</div>

										<div class="col-md-5">
											<p class="card-text">Last updated at: {{ $e->updated_at }} </p>
										</div>

										<div class="col-md-2">
											<div class="float-right">
												<a href="{{ route('patient-medication.edit', $e) }}">
													<button type="submit" class="btn btn-secondary">Edit Medication</button>
												</a>
											</div>
										</div>
									</div>

									<hr>
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