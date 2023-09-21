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
	<title>Login Page</title>
	
</head>

<body>
    
	<section class="login-page">
	    <div class="row">
	        <div class="col-md-5">
	            <div class="container">
	                <div class="form_box">
    	                <div class="site-logo">
    	                    <img src="{{url('public/backend/assets/images/logo-icon.png')}}">
    	                </div>
    	                <div class="card-box">
    	                    <h2>Amb Logistic</h2>
    	                    <div class="form-body">
    	                        <form class="row g-4" action="#">
                                @csrf
            						<div class="col-12">
            							<label for="inputEmailAddress" class="form-label">Password Rest</label>
            							
                                        <input id="rest_password" type="text"  placeholder="New Password" class="form-control" name="rest_password" required>
            
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
            
            						</div>
            						
            						
                                    <div class="remamber-sec">
            						    <div class="remamber-me">
            						        <label><input type="checkbox"> Remember Me</label>
            						    </div>
            						</div>
            						<div class="col-12">
            							<div class="d-grid">
            								<button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i> {{ __('Login') }}</button>
            							</div>
            						</div>
            						<!-- <div class="col-12 text-center">
            							<p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
            							</p>
            						</div> -->
            						<div class="acc_option">
									    <h6 class="or">OR</h6>
									    <p>Do not have an account?</p>
									</div>
            					</form>
    	                    </div>
    	                </div>
    	                <div class="login-copyright">
    	                    Copyright © 2022. All right reserved.
    	                </div>
    	            </div>
	            </div>
	        </div>
	        <div class="col-md-7 truck_img">
	            
	        </div>
	    </div>
	</section>
	
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