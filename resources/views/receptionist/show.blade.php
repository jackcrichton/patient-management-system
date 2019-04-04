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
									<a href="{{ route('receptionist.index') }}">
										<button type="submit" class="btn btn-primary">Back</button>
									</a>
								</div>
							</h5>
						</div>
						
						<br>
					</div>

				  	<div class="card-body">
				  		<div class="container">
					  		<div class="row">
					  			<div class="col-md-11">
							  		<h5>Person</h5>
							  	</div>

							  	<div class="col-md-1">
						  			<div class="float-right">
										<a href="{{ route('receptionist.edit', $patient->id) }}">
											<button type="button" class="btn btn-primary">Edit</button>
										</a>
									</div>
								</div>
							</div>
							
							<hr>

							<div class="row">
					  			<div class="col-md-6">
									<p class="card-text">Full name: {{ $patient->title }} {{ $patient->forename }} {{ $patient->surname }}</p>
								</div>

								<div class="col-md-6">
									<p class="card-text">Date Of Birth: {{ $patient->dateOfBirth }}</p>
								</div>
							</div>

							<div class="row">
					  			<div class="col-md-6">
									<p class="card-text">Sex: {{ $patient->sex }}</p>
								</div>

								<div class="col-md-6">
									<p class="card-text">Email: {{ $patient->email }}</p>
								</div>
							</div>

							<div class="row">
					  			<div class="col-md-12">
									<p class="card-text">Mobile: {{ $patient->mobileNo }}</p>
								</div>
							</div>
						
							<hr>

							<h5>Address details</h5>

							<hr>

					  		<div class="row">
					  			<div class="col-md-6">
									<p class="card-text">Address: {{ $patient->firstLineAddress }}</p>
								</div>

								<div class="col-md-6">
									<p class="card-text">Town: {{ $patient->town }}</p>
								</div>
							</div>

							<div class="row">
					  			<div class="col-md-6">
									<p class="card-text">County: {{ $patient->county }}</p>
								</div>

								<div class="col-md-6">
									<p class="card-text">Postcode: {{ $patient->postcode }}</p>
								</div>
							</div>

                            <hr>
                                <h5>Contact</h5>
                            <hr>

                            <div class="row">
                            	<div class="col-md-6">
                                    <p class="card-text">Email: {{ $patient->email }}</p>
                                </div>

                                <div class="col-md-6">
                                    <p class="card-text">Mobile Number: {{ $patient->mobileNo }}</p>
                                </div>
                            </div>

                             <hr>
                                <h5>Doctor</h5>
                            <hr>

							<div class="row">
					  			<div class="col-md-12">
									<p class="card-text">Doctor: {{ $doctor->title }}. {{ $doctor->forename }} {{ $doctor->surname }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
	        </div>
	    </div>
	</div>
@endsection