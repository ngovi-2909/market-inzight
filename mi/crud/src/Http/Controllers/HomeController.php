<?php

namespace mi\crud\Http\Controllers;

use mi\crud\Http\Controllers\Controller;
use mi\crud\Requests\User\StoreRequest;

use mi\crud\Repositories\UserRepository;
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
    public function index()
    {
        if(Auth::check()){
            if(auth()->user()->is_active){
                return view('crud::layouts.master');
            }else{
                return redirect(route('login'))->with('error', 'Please contact admin to active your account');
            }
        }
        return view('crud::authentication.login');
    }
    public function getLogin(){
        return view('crud::authentication.login');
    }
    public function getSignup(){
        return view('crud::authentication.register');
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
        return redirect()->route('login')->with("error", 'Login details are not valid');
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
