<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_products')->where('cate_status','1')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        return view('front.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
}
