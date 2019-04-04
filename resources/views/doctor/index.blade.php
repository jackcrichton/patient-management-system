@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card"> 
                    <div class="card-body">
                        <h5 class="card-title">Welcome {{ $user->title }}. {{ $user->forename }} {{ $user->surname }}</h5>

                        <hr>

                        <h6 class="card-subtitle mb-2 text-muted">Use the search engine below to any patient assigned to you.</h6>

                        <br>

                        <form type="GET" action="{{ route('patient.index', $user) }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Forename</span>
                                        </div>

                                        <input type="text" class="form-control" name="forename" value="{{ $newRequest != null ? $newRequest->forename : null }}">
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Surname</span>
                                        </div>

                                        <input type="text" class="form-control" name="surname" value="{{ $newRequest != null ? $newRequest->surname : null }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date Of Birth</span>
                                        </div>

                                        <input type="text" class="form-control" name="dateOfBirth" placeholder="YYYY-MM-DD" value="{{ $newRequest != null ? $newRequest->dateOfBirth : null }}">
                                    </div>  
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Postcode</span>
                                        </div>

                                        <input type="text" class="form-control" name="postcode" value="{{ $newRequest != null ? $newRequest->postcode : null }}">
                                    </div>  
                                </div>
                            </div>

                            <a class="float-left" style="margin-right: 10px">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Toggle other patients
                                </button>
                            </a>

                            <a class="float-left">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Toggle my patients
                                </button>
                            </a>

                            <button type="submit" class="btn btn-danger float-right" name="reset" style="margin-left: 10px">
                                Reset
                            </button>

                            <button type="submit" class="btn btn-primary float-right" name="search">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">           
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">

                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                My Patients ({{ $myPatients->count() }}) 
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            @if(count($myPatients) == 0)
                                <h3 class="text-center">No patients found.</h3>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Forename</th>
                                            <th scope="col">Surname</th>
                                            <th scope="col">DOB</th>
                                            <th scope="col">Sex</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Town</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Postcode</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($myPatients as $patient)
                                            <tr>
                                                <td>{{ $patient->title }}</td>
                                                <td>{{ $patient->forename }}</td>
                                                <td>{{ $patient->surname }}</td>
                                                <td>{{ $patient->dateOfBirth }}</td>
                                                <td>{{ $patient->sex }}</td>
                                                <td>{{ $patient->firstLineAddress }}</td>
                                                <td>{{ $patient->town }}</td>
                                                <td>{{ $patient->country }}</td>
                                                <td>{{ $patient->postcode }}</td>
                                                <td>
                                                    <a href="{{ route('patient.show', ['id' => $patient->id]) }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            View
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                  

                    <div class="card" id="allPatients">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Other Patients ({{ $allPatients->count() }})
                                </button>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                   @if(count($myPatients) == 0)
                                        <h3 class="text-center">No patients found.</h3>
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Forename</th>
                                                    <th scope="col">Surname</th>
                                                    <th scope="col">DOB</th>
                                                    <th scope="col">Sex</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Town</th>
                                                    <th scope="col">Country</th>
                                                    <th scope="col">Postcode</th>
                                                    <th scope="col">Doctor</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($allPatients as $patient)
                                                    <tr>
                                                        <td>{{ $patient->title }}</td>
                                                        <td>{{ $patient->forename }}</td>
                                                        <td>{{ $patient->surname }}</td>
                                                        <td>{{ $patient->dateOfBirth }}</td>
                                                        <td>{{ $patient->sex }}</td>
                                                        <td>{{ $patient->firstLineAddress }}</td>
                                                        <td>{{ $patient->town }}</td>
                                                        <td>{{ $patient->country }}</td>
                                                        <td>{{ $patient->postcode }}</td>
                                                        <td>
                                                            {{ $patient->doctor()->title }}. 
                                                            {{ $patient->doctor()->forename }} 
                                                            {{ $patient->doctor()->surname }}
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('patient.show', ['id' => $patient->id]) }}">
                                                                <button type="submit" class="btn btn-primary">
                                                                    View
                                                                </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection