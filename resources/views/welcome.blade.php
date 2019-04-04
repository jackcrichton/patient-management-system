<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hospital Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#dive-right-in").fadeIn(2000);
            });
        </script>
    </head>

    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                @if(!Auth::user())
                    <div class="top-right links">
                        <a href="{{ route('login') }}">Login</a>
                    </div>
                @endif
            @endif

            <div class="content">
                <div class="links">
                    <div class="container" id="dive-right-in" style="display:none"> <div class="title m-b-md">
                        @auth
                            @if(Auth::user()->role == 'superadmin')
                                <a href="{{ route('admin.index') }}" style="text-decoration: none">Home as Superadmin</a>
                            @elseif(Auth::user()->role == 'admin')
                                <a href="{{ route('admin.index') }}" style="text-decoration: none">Home as Admin</a>
                            @elseif(Auth::user()->role == 'doctor')
                                <a href="{{ route('patient.index') }}" style="text-decoration: none">Home as Doctor</a>
                            @elseif(Auth::user()->role == 'receptionist')
                                <a href="{{ route('receptionist.index') }}" style="text-decoration: none">Home as Receptionist</a>
                            @endif  
                        @else
                            Hospital Management
                        @endauth
                    </div>

                    <h2>Liverpool John Moore's Hospital Management Application.</h2>
                </div>
            </div>
        </div>
    </body>
</html>