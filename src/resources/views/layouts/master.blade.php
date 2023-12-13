<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor.bundle.base.css')}}">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select.dataTables.min.css')}}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
</head>
<body class="with-welcome-text">

<div class="container-scroller">
    <!-- header -->
    @include('Crud::layouts.partials.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- settings panel -->
            @include('Crud::layouts.partials.settings-panel')

        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab"
                       aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab"
                       aria-controls="chats-section">CHATS</a>
                </li>
            </ul>
        </div>

        <!-- sidebar -->
            @include('Crud::layouts.partials.sidebar')

        <!-- features menu -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-tab">
                            @auth()
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom" id="myLink">
                                <ul class="nav nav-tabs" role="tablist">

                                    @if(auth()->user()->is_super_user)
                                        <li class="nav-item">
                                            <a class="nav-link ps-0" id="home-tab" data-bs-toggle="tab"
                                               href="{{route('users.index')}}" role="tab" aria-controls="overview"
                                               aria-selected="true">Users</a>
                                        </li>
                                    @endif
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                               href="{{route('emails.index')}}" role="tab" aria-selected="false">Emails</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                               href="{{route('proxies.index')}}" role="tab"
                                               aria-selected="false">Proxies</a>
                                        </li>
                                </ul>
                            </div>

                            <div class="tab-content tab-content-basic">
                                @if(auth()->user()->is_active)
                                    @yield('content')
                                @endif
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
                @include('Crud::layouts.partials.footer')
        </div>

    </div>
</div>

<!-- jquery lib -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

{{--Bootstrap--}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


{{--users management--}}
@yield('users')
{{--emails management--}}
@yield('emails')
{{--proxies management--}}
@yield('proxies')

</body>

</html>

