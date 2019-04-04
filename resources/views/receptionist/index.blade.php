@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('flash::message')

                <div class="card"> 
                    <div class="card-body">
                        <div class="container">
                            <h5 class="card-title">Welcome {{ $user->title }}. {{ $user->forename }} {{ $user->surname }}</h5>

                            <hr>

                            <div class="row">
                                <div class="col-md-11">
                                    <h4>Patients</h4>
                                </div>

                                <div class="col-md-1">
                                    <a href="receptionist/create" class="float-right">
                                        <button type="submit" class="btn btn-primary">
                                            Add Patient
                                        </button>
                                    </a>
                                </div>
                            </div> 

                            <br>

                            @if($patients->count() == 0)
                                <hr>

                                <h3 class="text-center">There are currently no patient records.</h4>
                            @else
                	            <div class="table-responsive"> 
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Forename</th>
                                                <th scope="col">Surname</th>
                                                <th scope="col">DOB</th>
                                                <th scope="col">Sex</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($patients as $patient)
                                                <tr>
                                                    <td>{{ $patient->title }}</td>
                                                    <td>{{ $patient->forename }}</td>
                                                    <td>{{ $patient->surname }}</td>
                                                    <td>{{ $patient->dateOfBirth }}</td>
                                                    <td>{{ ucfirst($patient->sex) }}</td>
                                                    <td>
                                                        <a href="{{ route('receptionist.show', $patient->id) }}">
                                                            <button type="submit" class="btn btn-primary float-right" style="width:100%">
                                                                View
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>    
                                    </table>

                                    <div class="float-right">
                                    	{{ $patients->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                   </div>
                </div>
            </div>
	    </div>
	</div>
@endsection