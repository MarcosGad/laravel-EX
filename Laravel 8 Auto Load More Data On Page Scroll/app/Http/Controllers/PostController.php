<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Validator,Redirect,Response;
 
use App\Models\Post;
 
class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::paginate(8);
        $data = '';
        if ($request->ajax()) {
            foreach ($posts as $post) {
                $data.='<li>'.$post->id.' <strong>'.$post->title.'</strong> : '.$post->description.'</li>';
            }
            return $data;
        }
        return view('posts');
    }
}