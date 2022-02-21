<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $validationRule = [
        "title" => "required|string|max:100",
        "content" => "required",
        "published" => "sometimes|accepted",
        "category_id" => "nullable|exists:categories,id",
        "image" => "nullable|image|max:2048|mimes:jpeg,bmp,png"
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view("admin.posts.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione dati
        $request->validate($this->validationRule);

        //creazione post
        $data = $request->all();

        $newPost = new Post();
        $newPost->title = $data["title"];
        $newPost->content = $data["content"];

        if (isset($data["published"]) ) {
            $newPost->published = true;
        }
        // $newPost->published = isset($data["published"]);

        $newPost->category_id = $data["category_id"];

        $slug = Str::of($newPost->title)->slug('-');
        $count = 1;
        
        //prendi il primo post il cui slug è uguale a $slug
        //se è presente allora genero un nuovo slug aggiungendo -$count
        while(Post::where("slug", $slug)->first() ) {
            $slug = Str::of($newPost->title)->slug('-') . "-{$count}";
            $count++;
        }
        $newPost->slug = $slug;

        //salvo l'immagine se è presente
        if(isset($data["image"])) {
            $path_image = Storage::put("uploads", $data["image"]);
            $newPost->image = $path_image;   
        }

        $newPost->save();

        //redirect al post creato
        return redirect(route("posts.show", $newPost->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view("admin.posts.edit", compact("post", "categories"));
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
        //validazione dati
        $request->validate($this->validationRule);

        //modifca post
        $data = $request->all();

        if( $post->title != $data["title"]) {
            $post->title = $data["title"];

            //nuovo slug
            $slug = Str::of($post->title)->slug('-');
            if($slug != $post->slug){
                $count = 1;
                while(Post::where("slug", $slug)->first() ) {
                    $slug = Str::of($post->title)->slug('-') . "-{$count}";
                    $count++;
                }
                $post->slug = $slug;
            }
        }
        $post->content = $data["content"];
        
        if (isset($data["published"]) ) {
            $post->published = true;
        } else {
            $post->published = false;
        }
        // $post->published = isset($data["published"]);

        $post->category_id = $data["category_id"];

        //salvo l'immagine se è presente e cancello la vecchia immagine
        if(isset($data["image"])) {
            //cancello l'immagine
            Storage::delete($post->image);

            //salvo la nuova immagine
            $path_image = Storage::put("uploads", $data["image"]);
            $post->image = $path_image;   
        }
        
        $post->save();


        //redirect al post modificato
        return redirect(route("posts.show", $post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        // cancello l'immagine
        if($post->image) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route("posts.index");
    }
}
