<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){

     $all_brand_product = DB::table('tbl_brands')->get();
     $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
     return view('back.admin_index')->with('admin.all_brand_product', $manager_brand_product);

    }
    public function save_brand_product(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

       DB::table('tbl_brands')->insert($data);
       session::put('message','Thêm sản phẩm thành công');
       return Redirect::to('add-brand-product');

    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('tbl_brands')->where('brand_id',$brand_product_id) -> get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('back.admin_index')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
       DB::table('tbl_brands')->where('brand_id',$brand_product_id)->update($data);
       Session::put('message','Cập nhật sản phẩm thành công');
       return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brands')->where('brand_id',$brand_product_id)->delete();
       Session::put('message','Xóa sản phẩm thành công');
       return Redirect::to('all-brand-product');
    }

    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_products')->where('cate_status','1')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_products')->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')->where('tbl_products.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brands')
        ->where('tbl_brands.brand_id',$brand_id)
        ->limit(1)
        ->get();
        return view('front.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    
    }

}
