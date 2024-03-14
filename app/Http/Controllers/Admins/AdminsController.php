<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Order;
use App\Models\Admin\Admin;
use App\Models\Product\Category;
class AdminsController extends Controller
{
    public function viewLogin(){
        return view('admins.login');
    }

    public function checkLogin(Request $request){
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }
    
    public function index(){

        $productsCount =Product::select()->count();
        $ordersCount =Order::select()->count();
        $categoriesCount =Category::select()->count();
        $adminsCount =Admin::select()->count();
        return view('admins.index',compact('productsCount','ordersCount','categoriesCount','adminsCount'));
    }

    public function displayAdmins(){
        $allAdmins =Admin::all();
        return view('admins.alladmins',compact('allAdmins'));
    }
    public function displayCategories(){
        $allCategories =Category::select()->orderby('id')->get();
        return view('admins.allcategories',compact('allCategories'));
    }
    public function displayProducts(){
        $allProducts =Product::select()->orderby('id')->get();
        return view('admins.allproducts',compact('allProducts'));
    }
    
 }
