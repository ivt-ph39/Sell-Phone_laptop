<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reset Password</div>
                 <div class="card-body">
                <form method="POST" action="{{route('admin.storeFormReset')}}">
                    @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label> 
                            <div class="col-md-6">
                            <input id="email" type="email" name="email" value="{{$email}}" required="required" disabled  autocomplete="email" autofocus="autofocus" class="form-control ">
                            <input id="email" type="hidden" name="email" value="{{$email}}" required="required"  autocomplete="email" autofocus="autofocus" class="form-control ">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                 <input id="password" type="password" name="password" required="required" autocomplete="new-password" class="form-control ">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror 
                            </div>
                            
                        </div> 
                        <div class="form-group row">
                                <label for="password_confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                     <input id="password_confirm" type="password" name="password_confirm" required="required" autocomplete="new-password" class="form-control">
                                    @error('password_confirm')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror 
                                </div>
                        </div>
                                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                @if (session('status_succ'))
                                    <div class="mt-2 mb-2 text-success"><i class="fas fa-2x fa-check mr-2"></i>{{session('status_succ')}}</div>
                                    <a href="{{route('admin.login')}}" class="btn btn-danger mt-1">Go Login</a>
                                @else
                                    <button type="submit" class="btn btn-primary"> Reset Password</button>
                                @endif
                            </div>
                            
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>



