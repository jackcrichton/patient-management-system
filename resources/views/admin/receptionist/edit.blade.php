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
                                <h5 class="card-title">Update Receptionist</h5>
                            </div>

                            <div class="col-md-1">
                                <a href="/admin">
                                    <button class="btn btn-primary float-right">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <form method="POST" action="{{ route('admin-receptionist.update', $receptionist->id) }}">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-2">
                                <label for="comment">Title</label>

                                <select class="form-control" name="title" id="title" value="{{ $receptionist->title }}" required>
                                    @foreach($titles as $title)
                                        <option>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="comment">Forename</label>

                                <input class="form-control" name="forename" id="forename" value="{{ $receptionist->forename }}" required>
                            </div>

                            <div class="col-md-5">
                                <label for="comment">Surname</label>

                                <input class="form-control" name="surname" id="surname" value="{{ $receptionist->surname }}" required>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="comment">Date Of Birth</label>

                                <input class="form-control" type="date" name="dateOfBirth" id="dateOfBirth" value="{{ $receptionist->dateOfBirth }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="comment">Email</label>

                                <input type="text" class="form-control" id="email" name="email" value="{{ $receptionist->email }}" required>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="comment">Password</label>

                                <input type="password" class="form-control" id="password" name="password" value="{{ $receptionist->password }}" required>

                                <label for="comment">Confirm Password</label>

                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ $receptionist->password }}" required>
                            </div>
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary float-right">Save Receptionist</button>
                    </form>


                    <form method="POST" action="{{ route('admin-receptionist.destroy', $receptionist )}}">
                        {{ csrf_field() }}
                        @method('DELETE')

                        <button role="button" type="submit" class="btn btn-danger float-left">Remove Receptionist User</button>
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
