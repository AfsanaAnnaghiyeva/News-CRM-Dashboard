<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
   public function index()
   {
      $posts = Post::with(['category'])->orderBy('id','desc')->get();
  
     return view('admin.post.index',[
      'title'=>'Postlar',
      'posts'=>$posts
     ]);
   }

   public function create()
   {
      $categories = Category::orderBy('id','desc')->get();
      return view('admin.post.create',[
        'title'=>'yeni post',
        'categories'=>$categories
     ]);
   }

   public function store(CreatePostRequest $request)
   {
      $image = $request->file('image');
      $post = [
          'title'=>$request->title,
          'content'=>$request->content,
          'category_id'=>$request->category_id,
          'image'=>$image->hashName(),
          'status'=>$request->status,
          'slug'=>\Illuminate\Support\Str::slug($request->title)
      ];
      $postquery = Post::create($post);
      if($postquery){
        $image ->store('uploads','public');
      }
      return redirect()->route('admin.post.index');
   }

   public function edit(int $post_id)
   {
        $item = Post::where('id',$post_id)->first();
        $categories = Category::all();
         return view('admin.post.edit',[
          'title'=>'Xeberi Redakte et',
          'item'=>$item,
          'categories'=>$categories
         ]);
   }

   public function update( UpdatePostRequest $request, int $post_id)
   {
     $data = $request->validated();
     $data['slug'] = \Illuminate\Support\Str::slug($request->title);
     if($request->hasFile('image')){
        $image = $request->file('image');
        $data['image'] = $image->hashName();
        $image->store('uploads','public');
     }
     Post::where('id',$post_id)->update($data);
     return redirect()->route('admin.post.index');
   }

   public function delete(int $post_id)
   {
     Post::where('id',$post_id)->delete();
     return redirect()->route('admin.post.index');
   }
}
