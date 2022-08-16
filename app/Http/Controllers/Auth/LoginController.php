<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function getLogin(){
        // Mail::to("dotungduong2708@gmail.com")->send(new OrderShipped(['ma'=>'1232311']));

        return view('auth.login');
    }
    public function postLogin(Request $request){
        $rules =  [
            'email' => 'required|email',
            'password' => 'password'
        ];
        $message = [
            'email.required' => 'moi ban nhap vao email',
            'email.email' => 'moi ban nhap dung email',
            'password.required' => 'moi ban nhap vao password',
        ];
        $validator = Validator::make($request->all(),$message,$rules);
        if($validator->fails()){
            return redirect('login')->withErrors($validator);
        }else{
            $email = $request->input('email');
            $password = $request->input('password');
            if(Auth::attempt(['email'=>$email, 'password'=> $password])){
                return redirect('/user');
            }else{
                Session::flash('error','email hoac pass khong dung');
                return redirect('login');
            }
        }
    }
}
