<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function post(Request $request){
        
        $request->validate([
            "barta" => "required",
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the rules as needed
        ]);

        $image = $request->file('picture');
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
        // $post = new Post();
        // @$post->title = $request->input('title');
        // $post->save();
        // dd($validatedData);
        DB::table('post')->insert($validatedData);


        // return redirect()->route('post.view')->with('message', 'User post successfull');
        return redirect()->back();
    }
    public function postView(){
        $data = DB::table('post')->get();
        // dd($data);
        return view("index",["data"=>$data]);
    }

  public function single(){

        return view("single");
    }
}
