<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){

        $cate_product = DB::table('tbl_category_products')->where('cate_status','1')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_products')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();


        // $all_product = DB::table('tbl_products')
        // ->join('tbl_category_products','tbl_category_products.cate_id','=','tbl_products.cate_id')
        // ->join('tbl_brands','tbl_brands.brand_id','=','tbl_products.brand_id')
        // ->orderby("tbl_products.product_id",'desc')->get();


        return view('front.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }


    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_products')->where('cate_status','1')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->where('brand_status','1')->orderby('brand_id','desc')->get();
        // $all_product = DB::table('tbl_products')->where('product_status','1')->orderby('product_id','desc')->limit(6)->get();


        // $all_product = DB::table('tbl_products')
        // ->join('tbl_category_products','tbl_category_products.cate_id','=','tbl_products.cate_id')
        // ->join('tbl_brands','tbl_brands.brand_id','=','tbl_products.brand_id')
        // ->orderby("tbl_products.product_id",'desc')->get();

        $search_product = DB::table('tbl_products')->where('product_name','like','%'.$keywords.'%')->get();


        return view('front.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product', $search_product);

    }
}
