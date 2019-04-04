@extends('layouts.app')

@section('content')
	<div class="card">
		<div class="card-body">
		    <h5 class="card-title">Actvie Users</h5>

		    <div class="table-responsive">
	        	<table class="table">
					<thead>
						@foreach($activeUsers as $user)
							<tr>
								<th>{{ $user->title }}</th>
								<th>{{ $user->forename }}</th>
								<th>{{ $user->surname }}</th>
								<th>{{ $user->email }}</th>
								<th>
									<button type="button" class="btn btn-primary">Edit</button>
								</th>
							</tr>
						@endforeach
					</thead>
				<table>

				{{$activeUsers->links()}}
			</div>
		</div>
	</div>
@endsection