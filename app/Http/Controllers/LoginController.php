<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('posts.index');
    }
    public function registrer(){
        return view('posts.createaccount');
    }
    public function recoveraccount(){
        return view('posts.recoveraccount');
    }
    public function verifymail(){
        return view('posts.mailverification');
    }
    public function registerinstitution(){
        return view('posts.registerrepmember');
    }
}
