<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
     $items = Service::select(['id','title','price','description'])->orderBy('id','desc')->get();
     return view('admin.service.index',[
        'items'=>$items
     ]);
    }
    
    public function create()
    {
      return view('admin.service.create');
    }
    public function store(CreateServiceRequest $request)
    {
        Service::create($request->except(['_token']));
        return redirect()->route('admin.service.index');
    }
    public function edit( int $service_id)
    {
        $item=Service::where('id',$service_id)->first();
        return view('admin.service.edit',[
            'item'=>$item
        ]);
    }
    public function update(UpdateServiceRequest $request,int $service_id)
    {
      Service::where('id',$service_id)->update($request->except('_token'));
      return redirect()->route('admin.service.index');
    }
    public function delete(int $service_id)
    {
      Service::where('id',$service_id)->delete();
      return redirect()->route('admin.service.index');
    }
}
