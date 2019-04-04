@extends('layouts.app')

@section('content')
	<div class="container">
		@include('flash::message')
	</div>

	<div class="container">
	    <div class="row justify-content-center">
	    	<div class="col-md-12">
	            <div class="card"> 
	                <div class="card-body">
	                    <h5 class="card-title">Welcome {{ $user->title }}. {{ $user->forename }} {{ $user->surname }}, you are logged in as a {{ ucfirst($user->role) }}.</h5>

	                    <hr>
	                
	                	<div class="float-right">
							@if(Auth::user()->role == 'superadmin') 
								<a href="{{ route('admin.create') }}">
									<button type="button" class="btn btn-primary">Create New Admin</button>
								</a>
							@endif	

		                	<a href="{{ route('doctor.create') }}">
								<button type="button" class="btn btn-primary">Create New Doctor</button>
							</a>
						</div>
					</div>
				</div>	

				@if(Auth::user()->role == 'superadmin') 
					<br>

					<div class="card">
						<div class="card-body">
						    <h5 class="card-title">Admin Accounts</h5>

						    <div class="table-responsive">
						    	@if($adminUsers->count() == 0)
						    		<hr>

				    		        <h3 class="text-center">No admin users found.</h3>
			    		        @else	
							        <table class="table">
										<thead>
											@foreach($adminUsers as $admin)
												<tr>
													<th>{{ $admin->title }} {{ $admin->forename }} {{ $admin->surname }}</th>

													<th>{{ $admin->email }}</th>
													
													<th>
														<a href="{{ route('admin.edit', $admin->id) }}" class="float-right">
															<button type="button" class="btn btn-primary">Edit</button>
														</a>
													</th>
												</tr>
											@endforeach
										</thead>
									</table>
								@endif
							</div>
						</div>
					</div>
				@endif

				<br>

				<div class="card">
					<div class="card-body">
					    <h5 class="card-title">Doctor Accounts</h5>
					    	@if($doctors->count() == 0)
					    		<hr>
					    		
			    		        <h3 class="text-center">No admin users found.</h3>
		    		        @else	
							    <div class="table-responsive">
							        <table class="table">
										<thead>
											@foreach($doctors as $doctor)
												<tr>
													<th>{{ $doctor->title }} {{ $doctor->forename }} {{ $doctor->surname }}</th>

													<th>{{ $doctor->email }}</th>
													
													<th>
														<a href="{{ route('doctor.edit', $doctor->id) }}" class="float-right">
															<button type="button" class="btn btn-primary">Edit</button>
														</a>
													</th>
												</tr>
											@endforeach
										</thead>
									</table>

									<div class="float-right">
										{{$doctors->links()}}
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>

				<br>
	        </div>
	    </div>
	</div>
@endsection