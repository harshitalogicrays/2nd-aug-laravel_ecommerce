<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $ordercount=Order::count();
        $productcount=Product::count();
        $totalcategories=Category::count();
        $totalAllUsers=User::count();
        $totalUser=User::where('role_as','0')->count();
        $totalAdmin=User::where('role_as','1')->count();
        $todayDate=Carbon::now()->format('Y-m-d');
        $todaysorder=Order::whereDate('created_at',$todayDate)->count();
        $thisMonth=Carbon::now()->format('m');
        $thismonthorder=Order::whereMonth('created_at',$thisMonth)->count();
        $thisYear=Carbon::now()->format('Y');
        $thisyearorder=Order::whereYear('created_at',$thisYear)->count();

        return view('admin.dashboard',compact('ordercount','productcount','totalcategories','totalAllUsers','totalUser','totalAdmin','todaysorder','thismonthorder','thisyearorder'));
    }
}
