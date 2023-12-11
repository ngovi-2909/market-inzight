<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(){
        return view('layouts.master');
    }
    public function getLogin(){
        return view('authentication.login');
    }
    public function getSignup(){
        return view('authentication.register');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect((route('home')));
        }
        return redirect(route('login'))->with("error", 'Login details are not valid');
    }

    public function signup(StoreRequest $request){
        if(!$request->validated()){
            return redirect(route('register'))->with("error", "Registration failed, try again");
        }
        $this->userRepository->store($request);
        return redirect(route('login'))->with("success", "Registration success, login to access the page");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
