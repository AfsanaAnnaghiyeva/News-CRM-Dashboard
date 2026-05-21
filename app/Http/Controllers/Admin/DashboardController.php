<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Service;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Todo;


class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('sales')->get();
        $labels = $customers->pluck('name');
        $values = $customers->pluck('sales_count');

        $totalSales = Sale::Count();
        $totalRevenue = Sale::sum('price');
        $totalCustomers = Customer::count();
        $totalServices = Service::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();

        $lastTodos = Todo::latest()->take(3)->get();

    

        $monthlyEarings = Sale::selectRaw('SUM(price) as total, MONTHNAME(created_at) as month')
        ->groupBy('month')
        ->orderBy('created_at')
        ->take(6)
        ->get();
        $monthlyLabels = $monthlyEarings->pluck('month');
        $monthlyValues = $monthlyEarings->pluck('total');

        $recentSales = Sale::with(['customer','service'])->latest()->take(5)->get();
        return view('admin.dashboard.index',compact(
            'labels',
            'values',
            'totalSales',
            'totalRevenue',
            'totalCustomers',
            'totalServices',
            'totalPosts',
            'totalComments',
            'lastTodos',
            'monthlyLabels',
            'monthlyValues',
            'recentSales'
        ));
    }
}
