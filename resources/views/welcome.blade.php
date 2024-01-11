<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!-- <link rel="icon" href="{{ url('public/frontend/assets/images/favicon-32x32.png') }}" type="image/png" /> -->
	<!--plugins-->
	<link href="{{ url(BACKEND_IMG_PATH.'/logo-icon.png') }}" rel="icon"/>
	<link href="{{ url('public/frontend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ url('public/frontend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ url('public/frontend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<!--<link href="{{ url('public/frontend/assets/css/pace.min.css') }}" rel="stylesheet" />-->
	<!--<script src="{{ url('public/frontend/assets/js/pace.min.js') }}"></script>-->
	<!-- Bootstrap CSS -->
	<link href="{{ url('public/frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/icons.css') }}" rel="stylesheet">
	<link href="{{ url('public/backend/assets/css/custom-style.css') }}" rel="stylesheet">
	<title>AMB Logistic</title>
	
</head>

<body>
    
	<section class="login-page">
	    <div class="row">
	        <div class="col-md-4"></div>
	        <div class="col-md-4" style="padding: 40px 40px;">
	            <div class="form_box">
	                <div class="site-logo">
	                    <img src="{{url('public/backend/assets/images/logo-icon.png')}}">
	                </div>
	                <div class="card-box">
	                    <div class="form-body">
	                        <form class="row g-4" method="POST" action="{{ route('login') }}">
                            @csrf
        						<div class="col-12">
        							<label for="inputEmailAddress" class="form-label">Email Address</label>
        							<!-- <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address"> -->
                                    <input id="email" type="email"  placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
        
        						</div>
        						<div class="col-12">
        							<label for="inputChoosePassword" class="form-label">Enter Password</label>
        							<div class="input-group" id="show_hide_password">
        								<!-- <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a> -->
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Your Password" required autocomplete="current-password"> <a href="javascript:;" class="input-group-text"><i class='bx bx-hide'></i></a>
        
        							</div>
        						</div>
        						<!-- <div class="col-md-6">
        							<div class="form-check form-switch">
        								<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked {{ old('remember') ? 'checked' : '' }}>
        								<label class="form-check-label" for="flexSwitchCheckChecked">{{ __('Remember Me') }}</label>
        							</div>
        						</div>
        						<div class="col-md-6 text-end">	
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
        						</div> -->
                                <div class="remamber-sec">
        						    <div class="remamber-me">
        						        <label><input type="checkbox"> Remember Me</label>
        						    </div>
        						    <div class="forgot-pass">
        						        <a href="#">Forgot password?</a>
        						    </div>
        						</div>
        						<div class="col-12">
        							<div class="d-grid">
        								<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i> {{ __('Login') }}</button>
        							</div>
        							
        							@error('email')
                                        <span class="invalid-feedback" role="alert" style="display: block;margin: 10px 0px 10px 0px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    
                                 
                                    
                                    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        						</div>
        						
        						
        					
                          
        						<!-- <div class="col-12 text-center">
        							<p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
        							</p>
        						</div> -->
                                <!--<div class="acc_option">-->
								<!--    <h6 class="or">OR</h6>-->
								<!--    <p>Do not have an account? <a href="#">Create Account</a></p>-->
								<!--</div>-->
        					</form>
        					@error('email')
                                @if($message=='You Are Unauthorized.')
                                <form method="post" action="{{url('/request-access-ip')}}">
                                    
                                    <input type="hidden" value="<?php echo $_COOKIE['UnathorizedUser']; ?>" name="email">
                                    <button type="submit" class="btn btn-warning btn-sm">Request to Access</button>
                                    
                                </form>
                                @endif
                            @enderror
	                    </div>
	                </div>
	                <div class="login-copyright">
	                    Copyright © 2022. All right reserved.
	                </div>
	            </div>
	        </div>
	        <div class="col-md-4"></div>
	    </div>
	</section>
	<div class="wrapper" style="display:none;">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
					
						<div class="card shadow-none">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center mb-4">
										<h3 class="">Sign in</h3>
										<p class="mb-0">Login to your account</p>
									</div>
									<div class="d-grid gap-3">
										<a href="javascript:void()" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Login with facebook</a>
										<a href="javascript:void()" class="btn btn-google-plus"><i class="bx bxl-google-plus"></i> <span>Login with google+</span></a>
									</div>
									<div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
										<hr/>
									</div>
									<div class="form-body">
                                        <form class="row g-4" method="POST" action="{{ route('login') }}">
                                        @csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<!-- <input type="email" class="form-control" id="inputEmailAddress" placeholder="Email Address"> -->


                                                <input id="email" type="email"  placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<!-- <input type="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a> -->
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
												</div>
											</div>
											<!-- <div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked {{ old('remember') ? 'checked' : '' }}>
													<label class="form-check-label" for="flexSwitchCheckChecked">{{ __('Remember Me') }}</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	
                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
											</div> -->
                                
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i> {{ __('Login') }}</button>
												</div>
											</div>
											<!-- <div class="col-12 text-center">
												<p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
												</p>
											</div> -->
										</form>
										@error('email')
                                            @if($message=='You Are Unauthorized.')
                                            <form method="post" action="{{url('/request-access-ip')}}">
                                                <button type="submit" class="btn btn-warning btn-sm">Request to Access</button>
                                            </form>
                                            @endif
                                        @enderror
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!--broker/broker end wrapper-->
	<script src="{{ url('public/backend/assets/js/broker/broker.js') }}"></script>
	<!--end switcher-->
	
	<script src="{{ url('public/frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ url('public/frontend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="{{ url('public/frontend/assets/js/app.js') }}"></script>
</body>

</html>