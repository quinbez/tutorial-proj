<?php

namespace App\Http\Controllers;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view("admin.posts.index", compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();
        return view("admin.posts.create", compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')){

            $name =  $file->getClientOriginalName().time();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
          
            $user->posts()->create($input);
           
            return redirect('/admin/posts');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();

        if($file= $request->file('photo_id')){

            $name = $file->getClientOriginalName().time();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        Auth::user()->posts()->whereId($id)->first()->update($input);
        
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        unlink(public_path('\images\\'). $post->photo->file);

        $post->delete();

        return redirect('/admin/posts');
    }
    public function post($id){

        $post = Post::findOrFail($id);
        $comments = $post->comments()->whereIsActive(1)->get();
        return view('post', compact('post', 'comments'));
    }
}
