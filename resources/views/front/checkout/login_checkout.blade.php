@extends('welcome')
@section('content')

<section id="form">
    <!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form action="#">
							
							<input type="text" name="email_account" placeholder="Email Address" />
							<input type="password" name='password_account' placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<!--sign up form-->
					<div class="signup-form">
						<h2>Cung cấp thông tin</h2>
						<form action="#">
							<input type="text" placeholder="Họ và Tên"/>
							<input type="text" placeholder="Địa chỉ cụ thể"/>
							<input type="text" placeholder="Số điện thoại"/>
							<input type="email" placeholder="Email"/>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
					<!--/sign up form-->
				</div>
			</div>
		</div>
	</section>
    <!--/form-->
	
	

@endsection
