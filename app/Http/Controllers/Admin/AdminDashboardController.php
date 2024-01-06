<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $categories = Categories::all();
        $products = Products::all();
        return view('admin.dashboard',compact('products','categories'));
    }
}
