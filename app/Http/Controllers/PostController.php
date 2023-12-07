<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function post(Request $request){
        $image = $request->file('picture');
        $request->validate([
            "barta" => "required",
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the rules as needed
        ]);
        if($image){
            $imageName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }
        else{
            $imageName = null;
        }


     
        $validatedData = [
            'post' => $request->input('barta'),
            'image' => $imageName
            
        ];
        // dd($validatedData);
        DB::table('post')->insert($validatedData);


        return redirect()->route('post.view')->with('message', 'User post successfull');
    }
    public function postView(){
        $data = DB::table('post')->get();
        // dd($data);
        return view("index",["data"=>$data]);
    }

}
