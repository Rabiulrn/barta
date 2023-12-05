<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        return view("index");
    }
    public function profile(){
        return view("profile");
    }
    // public function editProfile(Request $request){
    //     dd($request->all());
    //     return view("editProfile");
    // }
    public function editProfile($id)
    {
        // Fetch the user with the given $id from the database
        // $user = User::find($id);
    //    $user= DB::table("users")->find("id",$id);
       $user = DB::table('users')->where('id', $id)->first();

        // If the user is not found, you can handle it accordingly
        if (!$user) {
            abort(404); // or redirect to another page, or show a custom error message
        }

        // Pass the user data to the view
        return view('editProfile', compact('user'));
    }
    public function updateProfile( Request $request){
       // Validate the request data
       $request->validate([
        'bio' => 'nullable|string|max:255', // Adjust validation rules as needed
    ]);
$validatedData =[
    'first_name'=> $request->input('first_name'),
    'last_name'=> $request->input('last_name'),
    // 'email'=> $request->input('email'),
    // 'password'=> $request->input('password'),
    'bio'=> $request->input('bio')

];
DB::table('users')->update($validatedData);
 
    // Get the authenticated user
    



    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }


}
