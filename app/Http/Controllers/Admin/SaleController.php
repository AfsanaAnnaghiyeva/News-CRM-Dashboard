<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Service;
use App\Http\Requests\Sale\CreateSaleRequest;
use App\Http\Requests\Sale\UpdateSaleRequest;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer','service'])->orderBy('id','desc')->get();
        return view ('admin.sale.index',[
            'sales'=>$sales
        ]);
    }
    public function create()
    {
      $customers = Customer::orderBy('id','desc')->get();

      $services = Service::orderBy('id','desc')->get();

      return view('admin.sale.create',[
        'customers'=>$customers,
        'services'=>$services
      ]);
    }
    public function store( CreateSaleRequest $request)
    {
      $sale = $request ->validated();
      Sale::create($sale);
      return redirect()->route('admin.sale.index')->with('success','Satış uğurla tamamlandı');
    }
    
    public function edit(int $sale_id)
    {
        $sale = Sale::findOrFail($sale_id);
        $customers = Customer::all();
        $services = Service::all();
         return view('admin.sale.edit',[
            'sale'=>$sale,
            'customers'=>$customers,
            'services'=>$services
         ]);
    }
    public function update(UpdateSaleRequest $request, int $sale_id)
    {
      $sale=Sale::findOrFail($sale_id);
      $sale->update($request->validated());
      return redirect()->route('admin.sale.index');

    }
    public function delete(int $sale_id)
    {
      $sale=Sale::findOrFail($sale_id);
      $sale->delete();
      return redirect()->route('admin.sale.index');
    }
}
