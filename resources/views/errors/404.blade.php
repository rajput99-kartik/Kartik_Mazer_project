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
	<link href="{{ url('public/frontend/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ url('public/frontend/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ url('public/frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ url('public/frontend/assets/css/icons.css') }}" rel="stylesheet">
	<title>Login Page</title>
	
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-white rounded fixed-top rounded-0 shadow-sm">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">
					<img src="assets/images/logo-img.png" width="140" alt="" />
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
				</button>
				{{-- <div class="collapse navbar-collapse" id="navbarSupportedContent1">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item"> <a class="nav-link active" aria-current="page" href="#"><i class='bx bx-home-alt me-1'></i>Home</a>
						</li>
						<li class="nav-item"> <a class="nav-link" href="#"><i class='bx bx-user me-1'></i>About</a>
						</li>
						<li class="nav-item"> <a class="nav-link" href="#"><i class='bx bx-category-alt me-1'></i>Features</a>
						</li>
						<li class="nav-item"> <a class="nav-link" href="#"><i class='bx bx-microphone me-1'></i>Contact</a>
						</li>
					</ul>
				</div> --}}

                
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>

                            @if (Route::has('register'))
                                <!--<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>-->
                            @endif
                        @endauth
                    </div>
               
			</div>
		</nav>
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="card py-5">
					<div class="row g-0">
						<div class="col col-xl-5">
							<div class="card-body p-4">
								<h1 class="display-1"><span class="text-primary">4</span><span class="text-danger">0</span><span class="text-success">4</span></h1>
								<h2 class="font-weight-bold display-4">Lost in Space</h2>
								<!--<p>You have reached the edge of the universe.-->
								<!--	<br>The page you requested could not be found.-->
								<!--	<br>Dont'worry and return to the previous page.</p>-->
								<div class="mt-5"> 
                                    
                                    @if (Route::has('login'))
                                    @auth
                                    <a href="{{ url('/home') }}" class="btn btn-primary btn-lg px-md-5 radius-30">Go Home</a>
                                    @else
									<a href="{{ url('/home') }}" class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Back</a>
                                    @endauth
                                    @endif
								</div>
							</div>
						</div>
						<div class="col-xl-7">
							<img src="https://cdn.searchenginejournal.com/wp-content/uploads/2019/03/shutterstock_1338315902.png" class="img-fluid" alt="">
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
		<div class="bg-white p-3 fixed-bottom border-top shadow">
			<div class="d-flex align-items-center justify-content-between flex-wrap">
				<ul class="list-inline mb-0">
					<li class="list-inline-item">Follow Us :</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-facebook me-1'></i>Facebook</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-twitter me-1'></i>Twitter</a>
					</li>
					<li class="list-inline-item"><a href="javascript:;"><i class='bx bxl-google me-1'></i>Google</a>
					</li>
				</ul>
				<p class="mb-0"></p>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- Bootstrap JS -->
	

<script src="{{ url('public/backend/assets/js/broker/broker.js') }}"></script>
	<!--end switcher-->
	
	<script src="{{ url('public/frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ url('public/frontend/assets/js/jquery.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ url('public/frontend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!--Password show & hide js -->
	
	<script src="{{ url('public/frontend/assets/js/app.js') }}"></script>
</body>

</html>