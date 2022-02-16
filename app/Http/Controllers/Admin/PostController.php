<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = DB::table('posts')->where('posted', true)->get();
        $posts = Post::all();
        return view('admin.posts.index_posts', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title'=>'required|string|max:150',
            'content'=>'required|string',
            'posted' => 'sometimes|accepted',
        ]);
        
        $data = $request->all();

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->posted = isset($data['posted']);
        $slug = Str::of($data['title'])->slug('-');
        $count = 1;
        
        while(Post::where('slug',$slug)->first()){
            $slug = Str::of($data['title'])->slug('-')."-{$count}";
            $count++;
        }
        $newPost->slug = $slug;
        $newPost->save();
        return redirect()->route('posts.show',$newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $post = DB::table('posts')->where('id',$id)->get();
        return view('admin.posts.show_post', ['post' => $post[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string|max:150',
            'content'=>'required|string',
            'posted' => 'sometimes|accepted',
        ]);
        $data = $request->all();
        $post->content = $data['content'];
        $post->posted = isset($data['posted']);
        
        #controllo se la il titolo precedente e quello fornito dall'edit sono diversi
        if($post->title != $data['title']) {
            #assegno lo slug in quanto la condizione sufficiente al suo cambiamento è la modifica del titolo
            $slug = Str::of($data['title'])->slug('-');

            $count = 1;
            while(Post::where('slug',$slug)->first()){
                $slug = Str::of($data['title'])->slug('-')."-{$count}";
                $count++;
            }
            $post->slug = $slug;
        }
        $post->title = $data['title'];
        $post->save();
        return redirect()->route('posts.show',$post->id);
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
    }
}
