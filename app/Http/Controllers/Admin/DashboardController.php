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

        //Sale::where('id', 3)->update(['created_at' => '2026-02-21 12:00:00']);
        //Sale::where('id', 2)->update(['created_at' => '2026-04-20 12:00:00']);
        //Sale::where('id', 1)->update(['created_at' => '2026-05-21 12:00:00']);

        $customers = Customer::has('sales')->withCount('sales')->get();
        $labels = $customers->pluck('name');
        $values = $customers->pluck('sales_count');

        $totalSales = Sale::Count();
        $totalRevenue = Sale::sum('price');
        $totalCustomers = Customer::count();
        $totalServices = Service::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();

        $activeTodosCount = Todo::where('user_id', auth()->user()->id)->where('is_completed',0)->count();

        $lastTodos = Todo::where('user_id', auth()->user()->id)->latest()->take(3)->get();

        $monthlyEarnings = Sale::selectRaw('SUM(price) as total, MONTH(created_at) as month_num')
        ->whereyear('created_at',date('Y'))
        ->groupBy('month_num')
        ->orderBy('month_num','asc')
        ->get();

        $monthsAz = [
            1=>'Yanvar', 2=>'Fevral', 3=>'Mart',4=>'Aprel',
            5=>'May',6=>'İyun',7=>'İyul',8=>'Avqust',
            9=>'Sentyabr', 10=>'Oktyabr',11=>'Noyabr',12=>'Dekabr'

            ];      

        $monthlyLabels = [];
        $monthlyValues = [];

        foreach($monthlyEarnings as $earning){
            $monthlyLabels[] = $monthsAz[$earning->month_num];
            $monthlyValues[] = $earning->total;

        }

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
            'recentSales',
            'activeTodosCount'
        ));
    }
}
