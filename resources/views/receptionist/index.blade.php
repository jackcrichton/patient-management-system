@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card"> 
                    <div class="card-body">
                        <h5 class="card-title">Welcome {{ $user->title }}. {{ $user->forename }} {{ $user->surname }}</h5>

                        <hr>

                        <h6 class="card-subtitle mb-2 text-muted">Use the search engine to find a patient.</h6>

                        <br>

                        <form type="GET" action="{{ route('receptionist.index', $user) }}">
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Patients
                        </h5>

                        <hr>
                    
                        <a href="{{ route('receptionist.create') }}" class="float-right">
                            <button type="submit" class="btn btn-success">
                                Add Patient
                            </button>
                        </a>
                    </div>

                    <div class="card-body">
                        @if(count($allPatients) == 0)
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
                                    @foreach($allPatients as $patient)
                                        <tr>
                                            <td>{{ $patient->title }}</td>
                                            <td>{{ $patient->forename }}</td>
                                            <td>{{ $patient->surname }}</td>
                                            <td>{{ $patient->dateOfBirth }}</td>
                                            <td>{{ ucfirst($patient->sex) }}</td>
                                            <td>{{ $patient->firstLineAddress }}</td>
                                            <td>{{ $patient->town }}</td>
                                            <td>{{ $patient->country }}</td>
                                            <td>{{ $patient->postcode }}</td>
                                            <td>
                                                <a href="{{ route('receptionist.show', $patient->id) }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        View
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="float-right">
                                {{ $allPatients->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection