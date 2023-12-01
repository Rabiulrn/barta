<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view("index");
    }
    public function profile(){
        return view("profile");
    }
    public function editProfile(){
        return view("editProfile");
    }

}
