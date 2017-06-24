@extends('../partial.layout')

@section('title', 'Login')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('assets/css/login.css') }}">
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
                                    <img src="assets/img/logo.png" alt="">
                                </a>
							</div>
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="register.png">
                                        ثبت نام
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#" >
                                        ورود
                                    </a>
                                </li>
                            </ul>

						</div>
					</nav>
	            </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-7  login">
                    <h3>ورود با نام کاربری در سایت</h3>
                    <h4>در صورتی که در سایت ثبت نام نموده اید می توانید از طریق فرم زیر وارد شوید</h4>
                    <form action="" method="POST" id="loginForm">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="نام کاربری">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="گذر واژه">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" id="submit" value="ورود به حساب کاربری" name="submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-7 not-found">
                    <div>
                        <p>کاربری با این مشخصات یافت نشد</p>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script src="{{ URL::to('assets/js/login.js') }}"></script>
@endsection
