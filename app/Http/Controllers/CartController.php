<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
    
        // Lấy thông tin sản phẩm từ bảng tbl_products
        $product_info = DB::table('tbl_products')->where('product_id', $productId)->first();
    
        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$product_info) {
            return Redirect::to('/')->withErrors('Sản phẩm không tồn tại.');
        }
    
        // Tạo mảng dữ liệu để thêm vào giỏ hàng
        $data = array();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
    
        
        // dd($data);
    
        // Thêm sản phẩm vào giỏ hàng
        try {
            Cart::add($data);
            return Redirect::to('/show-cart')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Exception $e) {
            \Log::error('Error adding product to cart: ' . $e->getMessage());
            return Redirect::to('/show-cart')->withErrors('Lỗi khi thêm sản phẩm vào giỏ hàng.');
        }
    }
    
    public function show_cart(){
        $cate_product = DB::table('tbl_category_products')->where('cate_status','1')->orderby('cate_id','desc')->get();

        $brand_product = DB::table('tbl_brands')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        return view('front.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_qty(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');

        
    }
}
