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
            <img src="images/frontImg.jpg" alt="">
            <div class="text">
                <span class="text-1">Every new friend is a <br> new adventure</span>
                <span class="text-2">Let's get connected</span>
    </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <br>
                @if(session()->has('error'))
                    <div class="alert-danger">{{session('error')}}</div>
                @endif
                @if(session()->has('success'))
                    <div class="alert-success">{{session('success')}}</div>
                @endif
                <form action="{{route('login.post')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" placeholder="Enter your email" name="email">
                        </div>
                        @if($errors->has('email'))
                            <div class="text-danger">{{$errors->first('email')}}</div>
                        @endif
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Enter your password" name="password">
                        </div>
                        @if($errors->has('password'))
                            <div class="text-danger">{{$errors->first('password')}}</div>
                        @endif
                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" value="Sumbit">
                        </div>
                        <div class="text sign-up-text">Don't have an account?
                            <a href="{{route('register')}}">
                                <label>Signup now</label>
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
