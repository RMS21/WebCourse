@extends('../partial/layout')

@section('title', 'ثبت نام')

@section('css')
        <link rel="stylesheet" href="{{ URL::to('assets/css/register.css') }}">
@endsection


@section('content')
        <div class="container-fluid">
            <div id="navbar">
	            <div class="navigation-example">
                    <nav class="navbar">
						<div class="container">
							<div class="navbar-header navbar-right">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-info">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="home.html">
                                    <img src="{{ URL::to('assets/img/logo.png') }}" alt="">
                                </a>
							</div>
                            <ul class="nav navbar-nav navbar-left">
                                <li class="active">
                                    <a href="#">
                                        ثبت نام
                                    </a>
                                </li>
                                <li >
                                    <a href="{{ route('get_login') }}" >
                                        ورود
                                    </a>
                                </li>
                            </ul>
						</div>
					</nav>
	            </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-7 register">
                    <h3>ثبت نام</h3>
                    <h4>برای بهره مندی از تمامی امکانات سایت باید ثبت نام نمایید</h4>
                    <form action="" method="POST" id="registerForm">
                        <div class="row name-family">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
								    <label class="control-label">نام خانوادگی</label>
								    <input type="text" class="form-control" tabindex="2" id="lastname" name="lname">
							    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
								    <label class="control-label">نام</label>
								    <input type="text" class="form-control" tabindex="1" id="firstname" name="fname">
							    </div>
                            </div>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">ایمیل</label>
                            <input type="email" class="form-control" tabindex="3" id="email" name="email">
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">نام کاربری</label>
                            <input type="text" class="form-control" tabindex="4" id="username" name="username">
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">گذر واژه</label>
                            <input type="password" class="form-control" tabindex="5" id="password" name="password">
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">تکرار گذر واژه</label>
                            <input type="password" class="form-control" tabindex="6" id="confirm-password" name="password_confirmation">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" id="submit" value="ثبت نام کن" name="submit">
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-7 not-found">
                        <div>
                            <p>اطلاعات وارد شده را کنترل کنید</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('js')
            <script src="{{ URL::to('assets/js/register.js') }}"></script>
        @endsection

@endsection
