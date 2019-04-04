@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-body">
                	<table class="table">
            		    <thead>
						    <tr>
								<th scope="col">Title</th>
								<th scope="col">Forename</th>
								<th scope="col">Surname</th>
								<th scope="col">Date of Birth</th>
								<th scope="col">Sex</th>
								<th scope="col">Address</th>
								<th scope="col">Town</th>
								<th scope="col">County</th>
						    </tr>
						 </thead>

						<tbody>
							@foreach($patients as $patient)
								<tr>
									<td>{{ $patient->title }}</td>
									<td>{{ $patient->forename }}</td>
									<td>{{ $patient->surname }}</td>
									<td>{{ $patient->dateOfBirth }}</td>
									<td>{{ $patient->sex }}</td>
									<td>{{ $patient->firstLineAddress }}</td>
									<td>{{ $patient->town }}</td>
									<td>{{ $patient->country }}</td>
								</tr>
						    @endforeach
						</tbody>	
					</table>

					{{ $patients->links() }}
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection