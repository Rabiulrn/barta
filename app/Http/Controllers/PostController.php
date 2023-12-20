<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function post(Request $request){
        // dd($request);
        $request->validate([
            "barta" => "required",
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the rules as needed
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

// view kora hoyeche userController theke

  public function edit($id){
    // $single_data = DB::find('$id');
    $single_data = DB::table('post')->where('id', $id)->first();
    return view("editPost",compact('single_data'));

        // return view("single");

    }
  public function update(Request $request){
    $postId = $request->input('id');
         // Validate the request data
         $request->validate([
            'barta' => 'nullable|string|max:255', // Adjust validation rules as needed
        ]);
    $validatedData =[
        'post'=> $request->input('barta'),

    
    ];
    DB::table('post')->where('id', $postId)->update($validatedData);

    return redirect()->route('home');

    }
    // another way
    // public function update(Request $request,$id)
    // {
    //     $update = Post::findOrFail($id);
    //     $update->post = $request->post;
    //     $update->save();
    //     return redirect()->route('home');
    // }

    public function destroy($id)
    {
        DB::table('post')->where('id', $id)->delete();
        return redirect()->route('home');
    }
  public function single(){

        return view("single");
    }
}
