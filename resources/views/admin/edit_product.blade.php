@extends('back/admin_index')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                                Cập nhật sản phẩm
                        </header>
                        <?php
	$message = Session::get('message');
	if ($message){
		echo $message;
		Session::put ('message',null);
	}
	?>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach ($edit_product as $key => $pro)
                                <form role="form" action="{{URL :: to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/front/images/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize:none" name="product_desc" id="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mô tả" >{{$pro->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize:none" name="product_content" id="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Nội dung">{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= 'product_status'class=" form-control input -sm m-bot15" value="{{$pro->product_status}}">
                                        <option value="0">Inactive</option>
                                        <option value="1 ">Active</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục</label>
                                    <select name= 'product_cate'class=" form-control input -sm m-bot15">
                                    @foreach($cate_product as $key => $cate)
                                            @if($cate->cate_id ==$pro->cate_id)
                                             <option selected value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @else
                                            <option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
                                            @endif  
                                @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Nhà phân phối</label>
                                    <select name= 'product_brand'class=" form-control input -sm m-bot15">
                                    @foreach ($brand_product as $key => $brand )
                                            @if($brand->brand_id == $pro->brand_id)
                                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                    @endforeach

                                    </select>
                                </div>
                                
                                <button name="add_product" type="submit" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection