<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest; 
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $items= Category::select(['id','title'])->orderBy('id','desc')->get();
        return view('admin.category.index',[
            'items'=>$items
        ]);
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(CreateCategoryRequest $request)
    {
       $data = $request->validated();
       $data['slug']=Str::slug($request->title);
       Category::create($data);
       return redirect()->route('admin.category.index');
    }
    public function edit(int $category_id)
    {
        $item = Category::where('id',$category_id)->first();
        return view('admin.category.edit',[
            'item'=>$item
        ]);
    }
    public function update(UpdateCategoryRequest $request, int $category_id)
    {
        $data = $request->validated();
        $data['slug']= Str::slug($request->title);
       Category::where('id',$category_id)->update($data);
       return redirect()->route('admin.category.index');
    }
    public function delete(int $category_id)
    {
        Category::where('id',$category_id)->delete();
        return redirect()->route('admin.category.index');
    }
}
