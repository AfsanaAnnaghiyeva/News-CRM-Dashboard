<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Todo\CreateTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\Post;

class TodoController extends Controller
{
    public function index()
    {
        $user=auth()->user();
        $todos= $user->todos()->orderBy('created_at','desc')->get();
        return view('admin.todo.index',[
            'title'=>'Tapsiriqlarim',
            'todos'=>$todos
        ]);
    }
    public function create()
    {
       return view('admin.todo.create');
    }
    public function store(CreateTodoRequest $request)
    {
      $data=$request->validated();
      $data['user_id'] = auth()->id();
      $data['is_completed'] = 0;

      Todo::create($data);
      
      return redirect()->route('admin.todo.index');
    }
    public function edit(int $todo_id)
    {
      $item=auth()->user()->todos()->where('id',$todo_id)->firstOrFail();
      return view('admin.todo.edit',[
        'title'=>'Redakte et',
         'item'=>$item
      ]);
    }
    public function update(UpdateTodoRequest $request,int $todo_id)
    {
     $todo = auth()->user()->todos()->where('id',$todo_id)->firstOrFail();
     $data = $request->validated();
     $data['is_completed'] = $request->has('is_completed')? 1: 0;
     $todo->update($data);
     return redirect()->route('admin.todo.index');
    }
    public function delete(int $todo_id)
    {
       auth()->user()->todos()->where('id',$todo_id)->delete();
       return redirect()->route('admin.todo.index');
    }
}
