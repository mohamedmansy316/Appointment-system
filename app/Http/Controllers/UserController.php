<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $r){
        $Rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $ErrotMessages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required'
        ];
        $Validator = Validator::make($r->all(), $Rules, $ErrotMessages);
        if($Validator->fails()){
            return back()->withErrors($Validator->errors()->all());
            }else{
                $Attempt = Auth::attempt(['email' => $r->email, 'password' => $r->password, 'active' => 1]);
                if($Attempt){
                    //Logged In
                return redirect()->route('index');
                }else{
                    return back()->with('error', 'Email or Password is incorrect');
                }
            }
        }
    public function getSignup(){
        return view('auth.signup');
    }
    public function postSignup(Request $r){
        $Rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users',
        ];
        $ErrorMessages = [
            'name.required' => "Your name is required",
            'email.requried' => "Your email is required",
            'email.email' => "Your email is not valid",
            'email.unique' => "Your email is already registered",
            'phone.required' => "Your phone is required",
            'phone.unique' => "Your phone is already registered",
            'password.required' => "Your password is required",
            'password.min' => "Your password must be at least 5 characters",
        ];
        $Validator = Validator::make($r->all(), $Rules,$ErrorMessages);
        if($Validator->fails()){
            return back()->withErrors($Validator->errors()->all());
        }else{
            $UserData = $r->all();
            $UserData['code'] = rand(1, 99999999);
            $UserData['password'] = Hash::make($r->password);
            $UserData['active'] = 1;
            // dd($UserData);
            User::create($UserData);
            // $User = new User();
            return redirect()->route('index')->withSuccess('You have successfully registered');
        }
    }
    public function logout(){
        /**logout route
         */
        auth()->logout();
        return redirect()->route('home')->withSuccess('You have successfully logged out');
    }
}
