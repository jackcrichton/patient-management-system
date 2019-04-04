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
								<a class="nav-link active" href="{{ route('patient-allergies.show', $patient->id) }}">Allgeries</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="{{ route('patient-medication.show', $patient->id) }}">Medication</a>
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
						  		<h5>Allergies</h5>
						  	</div>

						  	<div class="col-md-1">
					  			<div class="float-right">
		  				            <form method="GET" action="{{ route('patient-allergies.create') }}">
        								{{ csrf_field() }}

        								<input type="hidden" class="form-control" name="patientId" id="patientId" value="{{ $patient->id }}">

										<button type="submit" class="btn btn-primary">Add Allergy</button>
									</form>
								</div>
							</div>
						</div>

			  			<hr>			  			

			  			<div class="container">
			  				@if($existingPatientAllergies->count() == 0)
			  					<h3 class="text-center">This patient has no allergy records.</h4>
		  					@else
					  			@foreach($existingPatientAllergies as $e)
							  		<div class="row">
						  				<div class="col-md-12">
											<h4 class="card-text">{{ $e->allergy()->name }}
												@if ($e->status == 'Active')
													<p class="text-danger"> {{ $e->status }}</p>
												@elseif ($e->status == 'Inactive')
													<p class="text-warning"> {{ $e->status }}</p>
												@else
													<p class="text-success"> {{ $e->status }}</p>
												@endif
											</h4>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<h5 class="card-text">Reaction Severity: <b>{{ $e->reactionSeverity }}</b></p>
										</div>

							  			<div class="col-md-6">
											<h5 class="card-text">Reaction: <b>{{ $e->reaction }}</b></p>
										</div>
									</div>

									<div class="row">
							  			<div class="col-md-6">
											<p class="card-text">Type: {{ $e->allergy()->type }}</p>
										</div>

										<div class="col-md-6">
											<p class="card-text">Agent: {{ $e->allergy()->agent }} </p>
										</div>
									</div>

									<div class="row">
							  			<div class="col-md-12">
											<p class="card-text">Source of Information: {{ $e->sourceOfInfo }} </p>
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
												<a href="{{ route('patient-allergies.edit', $e) }}">
													<button type="submit" class="btn btn-secondary">Edit Allergy</button>
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