<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class ProductController extends Controller
{
    public function add_product(){
        $cate_product = DB::table('tbl_category_products')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->orderby('brand_id','desc')->get();
   
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    
    public function all_product(){

     $all_product = DB::table('tbl_products')
     ->join('tbl_category_products','tbl_category_products.cate_id','=','tbl_products.cate_id')
     ->join('tbl_brands','tbl_brands.brand_id','=','tbl_products.brand_id')
     ->orderby("tbl_products.product_id",'desc')->get();
     $manager_product = view('admin.all_product')->with('all_product', $all_product);
     return view('back.admin_index')->with('admin.all_product', $manager_product);

    }
    // public function save_product(Request $request){
    //     $data = array();
    //     $data['product_name'] = $request->product_name;
    //     $data['product_price'] = $request->product_price;
    //     $data['product_desc'] = $request->product_desc;
    //     $data['product_content'] = $request->product_content;
    //     $data['cate_id'] = $request->product_cate;
    //     $data['brand_id'] = $request->product_brand;
    //     $data['product_status'] = $request->product_status;

    //     $get_image = $request -> file('product_image');
    //     if($get_image){
    //         $get_name_image = $get_image -> getClientOriginalName();
    //         $name_image = current(explode('.',$get_name_image));
    //         $new_image = $name_image.rand(0,99).'.'.$get_image -> getClientOriginalExtension();
    //         $get_image->move('public/uploads/product',$new_image);
    //         $data['product_image'] = $new_image;
    //         DB::table('tbl_products')->insert($data);
    //         session::put('message','Thêm sản phẩm thành công');
    //         return Redirect::to('add-product');
    //     }
    //     $data['product_image'] = '';
    //    DB::table('tbl_products')->insert($data);
    //    session::put('message','Thêm sản phẩm thành công');
    //    return Redirect::to('add-product');

    // }
    public function save_product(Request $request) {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['cate_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
    
        $get_image = $request->file('product_image');
        
        if ($get_image) {
   
            if ($get_image->isValid()) {
         
                $get_name_image = $get_image->getClientOriginalName();
                $extension = $get_image->getClientOriginalExtension();
                
      
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . Str::random(10) . '.' . $extension;
                
       
                $destinationPath = public_path('public/front/images/uploads/product');
                
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
            
                try {
                    $get_image->move($destinationPath, $new_image);
                    
              
                    $data['product_image'] = $new_image;
                    DB::table('tbl_products')->insert($data);
                    Session::put('message', 'Thêm sản phẩm thành công');
                    return Redirect::to('add-product');
                } catch (\Exception $e) {
                    Session::put('message', 'Lỗi: Không thể lưu tệp. ' . $e->getMessage());
                    return Redirect::to('add-product');
                }
            } else {
                Session::put('message', 'Tệp tải lên không hợp lệ');
                return Redirect::to('add-product');
            }
        }
    
        // Nếu không có tệp nào được tải lên
        $data['product_image'] = '';
        DB::table('tbl_products')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }

    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_products')->orderby('cate_id','desc')->get();
        $brand_product = DB::table('tbl_brands')->orderby('brand_id','desc')->get();


        $edit_product = DB::table('tbl_products')->where('product_id',$product_id) -> get();

        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('back.admin_index')->with('admin.edit_product', $manager_product) ;
    }
    public function update_product(Request $request, $product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['cate_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
    
        if ($get_image) {
   
            if ($get_image->isValid()) {
                $get_name_image = $get_image->getClientOriginalName();
                $extension = $get_image->getClientOriginalExtension();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('public/front/images/uploads/product');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                try {
                    $get_image->move($destinationPath, $new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_products')->where('product_id',$product_id)->update($data);
                    Session::put('message', 'Cập nhật sản phẩm thành công');
                    return Redirect::to('add-product');
                } catch (\Exception $e) {
                    Session::put('message', 'Lỗi: Không thể lưu tệp. ' . $e->getMessage());
                    return Redirect::to('add-product');
                }
            } else {
                Session::put('message', 'Tệp tải lên không hợp lệ');
                return Redirect::to('add-product');
            }
        }
  
        DB::table('tbl_products')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        DB::table('tbl_products')->where('product_id',$product_id)->delete();
       Session::put('message','Xóa sản phẩm thành công');
       return Redirect::to('all-product');
    }

    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_products')
        ->where('cate_status','1')
        ->orderby('cate_id','desc')
        ->get();

        $brand_product = DB::table('tbl_brands')
        ->where('brand_status','1')
        ->orderby('brand_id','desc')
        ->get();


        $details_product = DB::table('tbl_products')
        ->join('tbl_category_products','tbl_category_products.cate_id','=','tbl_products.cate_id')
        ->join('tbl_brands','tbl_brands.brand_id','=','tbl_products.brand_id')
        ->where('tbl_products.product_id',$product_id)->get();


        return view('front.sanpham.show_details')->with('category',$cate_product)
        ->with('brand',$brand_product)->with('product_details',$details_product);
    }
   
}
