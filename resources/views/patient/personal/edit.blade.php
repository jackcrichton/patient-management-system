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
	                				<h5 class="card-title">Update Personal Details</h5>
	                			</div>

	                			<div class="col-md-1">
	                				<a href="/patient/{{ $patient->id }}">
						            	<button class="btn btn-primary float-right">Back</button>
						            </a>
	                			</div>
	                		</div>
            			</div>

	                	<hr>

	                    <form method="POST" action="{{ route('patient.update', $patient->id) }}">
	                    	{{ csrf_field() }}
                    	    @method('PUT')

		                    <div class="row">
		                        <div class="col-md-3">
		                            <div class="input-group mb-3">
										<div class="input-group-prepend">
		                                    <span class="input-group-text">Title</span>
		                                </div>

		                                <select class="custom-select" id="title" name="title" value="{{ $patient->title }}" required>
		                                    @foreach($titles as $title)
		                                    	<option>{{ $title }}</option>
	                                    	@endforeach	
		                                </select>
		                            </div>  
		                        </div>

		                        <div class="col-md-4">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Forename</span>
		                                </div>

		                                <input type="text" class="form-control" id="forename" name="forename" value="{{ $patient->forename }}" required>
		                            </div>  
		                        </div>

		                        <div class="col-md-5">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Surname</span>
		                                </div>

		                                <input type="text" class="form-control" id="surname" name="surname" value="{{ $patient->surname }}" required> 
		                            </div>  
		                        </div>
		                    </div>

		                    <div class="row">
		                    	<div class="col-md-12">
		                    		 <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Email</span>
		                                </div>

		                                <input type="text" class="form-control" id="email" name="email" value="{{ $patient->email }}" required>
		                            </div>  
		                    	</div>
		                    </div>

		                    <div class="row">
		                        <div class="col-md-6">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Date Of Birth</span>
		                                </div>

		                                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="{{ $patient->dateOfBirth }}" required>
		                            </div>  
		                        </div>

                                <div class="col-md-6">
	                                 <div class="input-group mb-3">
	                                 	 <div class="input-group-prepend">
		                                    <span class="input-group-text">Sex</span>
		                                </div>

		                                <select class="custom-select" id="sex" name="sex" value="{{ $patient->sex }}" required>
		                                    @foreach($sex as $s)
		                                    	<option>{{ ucfirst($s) }}</option>
	                                    	@endforeach	
		                                </select>
		                            </div>  
		                        </div>
				            </div>

	                         <div class="row">
		                        <div class="col-md-12">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">First Line Address</span>
		                                </div>

		                                <input type="text" class="form-control" id="firstLineAddress" name="firstLineAddress" value="{{ $patient->firstLineAddress }}" required>
		                            </div>  
		                        </div>
				            </div>

							<div class="row">
				                 <div class="col-md-6">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Town</span>
		                                </div>

		                                <input type="text" class="form-control" id="town" name="town" value="{{ $patient->town }}" required>
		                            </div>  
		                        </div>

	                            <div class="col-md-6">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Country</span>
		                                </div>

		                                <input type="text" class="form-control" id="country" name="country" value="{{ $patient->country }}" required>
		                            </div>  
		                        </div>	
		                    </div>

                            <div class="row">
		                        <div class="col-md-6">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Mobile Number</span>
		                                </div>

		                                <input type="text" class="form-control" id="mobileNo" name="mobileNo" value="{{ $patient->mobileNo }}" required>
		                            </div>  
		                        </div>

	                           	<div class="col-md-6">
		                            <div class="input-group mb-3">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text">Postcode</span>
		                                </div>

		                                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $patient->postcode }}" required>
		                            </div>  
		                        </div>	
				            </div>

							<button type="submit" class="btn btn-primary float-right">Save Patient</button>
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
@endsection