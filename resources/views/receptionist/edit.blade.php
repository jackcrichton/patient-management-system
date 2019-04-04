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
                                    <h5 class="card-title">Edit Patient</h5>
                                </div>

                                <div class="col-md-1">
                                    <a href="/receptionist/{{ $patient->id }}">
                                        <button class="btn btn-primary float-right">Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('receptionist.update', $patient->id) }}">
                        {{ csrf_field() }}
                        @method('PUT')

                            <hr>
                                <h5>General</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-2">
                                    <label for="comment">Title</label>

                                    <select class="form-control" name="title" id="title" value="{{ $patient->title }}">
                                        @foreach($titles as $title)
                                            <option value="{{ $patient->title }}" {{ $patient->title == $title ? 'selected' : ''}}>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="comment">Forename</label>

                                    <input class="form-control" name="forename" id="forename" value="{{ $patient->forename }}"required>
                                </div>

                                 <div class="col-md-5">
                                    <label for="comment">Surname</label>

                                    <input class="form-control" name="surname" id="surname" value="{{ $patient->surname }}" required>
                                </div>
                            </div>  

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleFormControlSelect1">Sex</label>

                                    <select class="form-control" name="sex" id="sex">
                                        @foreach($sex as $s)
                                            <option value="{{ $patient->sex }}" {{ $patient->sex == $s ? 'selected' : ''}}>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="comment">Date Of Birth</label>

                                    <input class="form-control" type="date" name="dateOfBirth" id="dateOfBirth" value="{{ $patient->dateOfBirth }}" required>
                                </div>
                            </div>  

                            <hr>
                                <h5>Address</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="comment">First Line Address</label>

                                    <input class="form-control" name="firstLineAddress" id="firstLineAddress" value="{{ $patient->firstLineAddress }}" required>
                                </div>

                                 <div class="col-md-6">
                                    <label for="comment">Town</label>

                                    <input class="form-control" name="town" id="town" value="{{ $patient->town }}" required>
                                </div>
                            </div>  

                            <br>

                            <div class="row">
                                 <div class="col-md-6">
                                    <label for="comment">Country</label>

                                    <input class="form-control" name="country" id="country" value="{{ $patient->country }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="comment">Postcode</label>

                                    <input class="form-control" name="postcode" id="postcode" value="{{ $patient->postcode }}" required>
                                </div>
                            </div>

                            <hr>
                                <h5>Contact</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="comment">Email</label>

                                    <input class="form-control" name="email" id="email" value="{{ $patient->email }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="comment">Mobile Number</label>

                                    <input type="number" class="form-control" name="mobileNo" id="mobileNo" value="{{ $patient->mobileNo }}" required>
                                </div>
                            </div>

                            <hr>
                                <h5>Doctor</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="comment">Doctor</label>

                                    <select class="form-control" name="userAssignedTo" id="userAssignedTo">
                                        @foreach($doctors as $d)
                                            <option value="{{ $patient->userAssignedTo }}" {{ $patient->userAssignedTo == $d->id ? 'selected' : ''}}>{{ $d->title }}. {{ $d->forename }} {{ $d->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary float-right">
                                Add Patient
                            </button>
                        </form>

                        <form method="POST" action="{{ route('receptionist.destroy', $patient->id )}}">
                        {{ csrf_field() }}
                        @method('DELETE')

                            <button role="button" type="submit" class="btn btn-danger float-left">Remove patient</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection