<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Post;
 
class PostController extends Controller
{
    public function index()
    {
        // Fetch posts from the database
        $posts = Post::all();
 
        return view('post/index', ['posts' => $posts]); // Pass posts to the view
    }

 
 
    public function delete($id)
    {
        Post::destroy($id);
        return redirect()->route('post'); 
    }
}