<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
      $items = Customer::select(['id','logo','name','link'])->orderBy('id','desc')->get();
      return view('admin.customer.index',[
          'items'=>$items
      ]);
    }
    public function create()
    {
      return view('admin.customer.create');
    }
    public function store(CreateCustomerRequest $request)
    {
      $image =$request ->file('logo');

      $customer = [
        'name'=>$request->name,
        'logo'=>$image->hashName(),
        'link'=>$request->link,
      ];
      $customerquery = Customer::create($customer);
      if($customerquery){
        $image->store('uploads/customer','public');
      }
      return redirect()->route('admin.customer.index');
    }
    public function edit(int $customer_id)
    {
      $item = Customer::where('id',$customer_id)->first();
      return view('admin.customer.edit',[
        'item'=>$item
      ]);
    }
    public function update(UpdateCustomerRequest $request, int $customer_id)
    {
      $data = $request->validated();
      $customer = Customer::findOrFail($customer_id);
      if($request->hasFile('logo')){
        if($customer->logo){
           Storage::disk('public')->delete('uploads/customer/'.$customer->logo);
        }
        $logo = $request ->file('logo');
        $data['logo']=$logo->hashName();
        $logo->store('uploads/customer','public');
      }
      Customer::where('id',$customer_id)->update($data);
      return redirect()->route('admin.customer.index');
    }
    public function delete(int $customer_id)
    {

      $customer = Customer::findOrFail($customer_id);

     if($customer->logo){
       $path = 'uploads/customer/'.$customer->logo;
         if(Storage::disk('public')->exists($path)){
            Storage::disk('public')->delete($path);
          }
        }

     $customer->delete();
     
     return redirect()->route('admin.customer.index');

    }
}
