<?php

namespace MI\Crud\Http\Controllers;

use MI\Crud\Requests\User\StoreRequest;

use MI\Crud\Repositories\UserRepository;
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
        return view('Crud::layouts.master');
    }
    public function getLogin(){
        return view('Crud::authentication.login');
    }
    public function getSignup(){
        return view('Crud::authentication.register');
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
