<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }
    public function all_category_product(){

     $all_category_product = DB::table('tbl_category_products')->get();
     $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
     return view('back.admin_index')->with('admin.all_category_product', $manager_category_product);

    }
    public function save_category_product(Request $request){
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_desc'] = $request->category_product_desc;
        $data['cate_status'] = $request->category_product_status;

       DB::table('tbl_category_products')->insert($data);
       session::put('message','Thêm sản phẩm thành công');
       return Redirect::to('add-category-product');

    }
    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('tbl_category_products')->where('cate_id',$category_product_id) -> get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('back.admin_index')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $data = array();
        $data['cate_name'] = $request->category_product_name;
        $data['cate_desc'] = $request->category_product_desc;
        $data['cate_status'] = $request->category_product_status;
       DB::table('tbl_category_products')->where('cate_id',$category_product_id)->update($data);
       Session::put('message','Cập nhật sản phẩm thành công');
       return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        DB::table('tbl_category_products')->where('cate_id',$category_product_id)->delete();
       Session::put('message','Xóa sản phẩm thành công');
       return Redirect::to('all-category-product');
    }

    //het admin
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_products')
        ->where('cate_status','1')
        ->orderby('cate_id','desc')
        ->get();

        $brand_product = DB::table('tbl_brands')
        ->where('brand_status','1')
        ->orderby('brand_id','desc')
        ->get();

        $category_by_id = DB::table('tbl_products')
        ->join('tbl_category_products','tbl_products.cate_id','=','tbl_category_products.cate_id')
        ->where('tbl_products.cate_id',$category_id)
        ->get();

        $category_name = DB::table('tbl_category_products')
        ->where('tbl_category_products.cate_id',$category_id)
        ->limit(1)
        ->get();

        return view('front.category.show_category')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name);
    }
    
}
