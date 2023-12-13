<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="{{asset('css/login/styles.css')}}">

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="cover">
        <div>
            <img class="backImg" src="{{asset('images/backImg.jpg')}}" alt="">
            <div class="text">
                <span class="text-1">Complete miles of journey <br> with one step</span>
                <span class="text-2">Let's get started</span>
            </div>
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="signup-form">
                <div class="title">Signup</div>
                <br>
                @if(session()->has('error'))
                    <div class="alert-danger">{{session('error')}}</div>
                @endif
                @if(session()->has('success'))
                    <div class="alert-success">{{session('success')}}</div>
                @endif
                <form action="{{route('register.post')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="First Name" name="first_name">
                        </div>
                        @if($errors->has('first_name'))
                            <div class="text-danger">{{$errors->first('first_name')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Last Name" name="last_name">
                        </div>
                        @if($errors->has('last_name'))
                            <div class="text-danger">{{$errors->first('last_name')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Email" name="email">
                        </div>
                        @if($errors->has('email'))
                            <div class="text-danger">{{$errors->first('email')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" name="password">
                        </div>
                        @if($errors->has('password'))
                            <div class="text-danger">{{$errors->first('password')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Confirm Password" name="confirm_password">
                        </div>
                        @if($errors->has('confirm_password'))
                            <div class="text-danger">{{$errors->first('confirm_password')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-phone"></i>
                            <input type="tel" placeholder="Phone" name="phone">
                        </div>
                        @if($errors->has('phone'))
                            <div class="text-danger">{{$errors->first('phone')}}</div>
                        @endif
                        <div class="button input-box">
                            <input type="submit">
                        </div>
                        <div class="text sign-up-text">Already have an account?
                            <a href="{{route('login')}}">
                                <label>Login now</label>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>



