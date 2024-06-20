@extends('back/admin_index')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL :: to('/save-category-product')}}" method="post">
                                    {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize:none" name="category_product_desc" id="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= 'category_product_status'class=" form-control input -sm m-bot15">
                                        <option value="0">Inactive</option>
                                        <option value="1 ">Active</option>

                                    </select>
                                </div>
                                
                                <button name="add_category_product" type="submit" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection