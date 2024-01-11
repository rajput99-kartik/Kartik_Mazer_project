@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')
<style>
    /*.col-md-7.dashboard_truck img {*/
    /*    width: 100%;*/
    /*    border-radius: 10px;*/
    /*}*/
    /*.col-md-5.dashboard_logo img {*/
    /*    margin-top: -40px;*/
    /*    width:100%;*/
    /*}*/
    /*.new_dashboard {*/
    /*    background-image: url(https://ambcrm.com//public/backend/assets/images/truck.jpg) !important;*/
    /*    text-align: center;*/
    /*    background-position: center;*/
    /*    background-repeat: no-repeat;*/
    /*    background-size: cover;*/
    /*    padding: 100px 0px;*/
    /*}*/
    /*.new_dashboard div {background: none;}*/
    /*.col-md-12.dashboard_logo img {*/
    /*    background-color: #ffffffe8;*/
    /*    width: 30%;*/
    /*    border-radius: 10px;*/
    /*}*/
    /*.form_box img {*/
    /*    width: 40%;*/
    /*}*/
    /*.dashboard_search {*/
    /*    position: relative;*/
    /*}*/
    /*.dashboard_search input {*/
    /*    padding: 12px;*/
    /*}*/
    /*.dashboard_search span {*/
    /*    right: 0;*/
    /*    left: auto;*/
    /*    top: 25px !important;*/
    /*    color: #fff;*/
    /*    height: 49px;*/
    /*    padding-top: 12px;*/
    /*    font-size: 20px;*/
    /*    width: 50px;*/
    /*    text-align: center;*/
    /*    background: linear-gradient( 45deg , #035a95 , #2575fc)!important;*/
    /*    cursor: pointer;*/
    /*}*/
    /*.form-body {*/
    /*    padding: 45px 20px;*/
    /*}*/
    /*section.login-page {*/
    /*    box-shadow: inset 0px 0px 0px 700px #00000063;*/
    /*    padding-top: 140px;*/
    /*}*/
    /*section.login-page .row {*/
    /*    width: 100%;*/
    /*}*/
    /*.page-content {*/
    /*    padding: 0px;*/
    /*}*/
    /*.page-wrapper {*/
    /*    margin-left: 50px !important;*/
    /*    margin-top: 0px;*/
    /*}*/
    /*h4.search-heading {*/
    /*    padding: 0px;*/
    /*    font-size: 22px;*/
    /*    padding-bottom: 10px;*/
    /*}*/
    /*.row.dashboard {*/
    /*    background-color: #ffffffeb;*/
    /*    padding: 20px 0px;*/
    /*    border-radius: 5px;*/
    /*}*/
    /*.col-md-2.search-or {*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    align-items: center;*/
    /*}*/
    /*.site-logo img {*/
    /*    width: 100%;*/
    /*    margin-left: 30px;*/
    /*    margin-top: -20px;*/
    /*}*/
    /*.form-body {*/
    /*    padding-left: 0px;*/
    /*    padding-top: 34%;*/
    /*}*/
    
    /*@media (max-width:767px){*/
    /*    .page-wrapper {*/
    /*        margin-left: 0px !important;*/
    /*    }*/
    /*    section.login-page .row {margin: 0px;}*/
    /*    .col-md-2.search-or {*/
    /*        display: none;*/
    /*    }*/
    /*    .form-body {*/
    /*        padding-top: 0px;*/
    /*    }*/
    /*    .site-logo img {*/
    /*        margin: 0px;*/
    /*    }*/
    /*    .form-body {*/
    /*        padding-right: 0px;*/
    /*    }*/
    /*}*/
</style>
	<!-- <div class="container">-->
	<!--	<div class="row justify-content-center">-->
	<!--		<div class="col-md-8">-->
	<!--			<div class="card">-->
	<!--				<div class="card-header">Dashboard</div>-->
	
	<!--				<div class="card-body">-->
	<!--					@if(auth()->user()->is_admin == 1)-->
	<!--					<a href="{{url('admin/routes')}}">Super Admin</a>-->
	<!--					@else-->
	<!--					<div class=”panel-heading”>Normal User</div>-->
	<!--					@endif-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->

	<div class="page-wrapper">
		<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 bg-gradient-deepblue">
							<div class="card-body">
							<div class="d-flex align-items-center">
								<h5 class="mb-0 text-white">{{$tloads}}</h5>
								<div class="ms-auto">
									<i class='bx bx-plus fs-3 text-white'></i>
								</div>
							</div>
							<div class="progress my-2 bg-white-transparent" style="height:4px;">
								<div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="d-flex align-items-center text-white">
								<p class="mb-0">Total Loads</p>
								<p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
							</div>
						</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-gradient-ohhappiness">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<h5 class="mb-0 text-white">{{$tusers}}</h5>
								<div class="ms-auto">
									<i class='bx bx-group fs-3 text-white'></i>
								</div>
							</div>
							<div class="progress my-2 bg-white-transparent" style="height:4px;">
								<div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="d-flex align-items-center text-white">
								<p class="mb-0">Total Users</p>
								<p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
							</div>
						</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-gradient-ibiza">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<h5 class="mb-0 text-white">6200</h5>
								<div class="ms-auto">
									<i class='bx bx-show fs-3 text-white'></i>
								</div>
							</div>
							<div class="progress my-2 bg-white-transparent" style="height:4px;">
								<div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="d-flex align-items-center text-white">
								<p class="mb-0">Total Visitors</p>
								<p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
							</div>
						</div>
					</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-gradient-moonlit">
							<div class="card-body">
							<div class="d-flex align-items-center">
								<h5 class="mb-0 text-white">5630</h5>
								<div class="ms-auto">
									<i class='bx bx-envelope fs-3 text-white'></i>
								</div>
							</div>
							<div class="progress my-2 bg-white-transparent" style="height:4px;">
								<div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="d-flex align-items-center text-white">
								<p class="mb-0">Messages</p>
								<p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
							</div>
						</div>
						</div>
					</div>
				</div>
			
				<div class="row">
				<div class="col-12 col-lg-8 col-xl-8 d-flex">
					<div class="card radius-10 w-100">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="mb-0">Site Traffic</h5>
							</div>
							<div class="dropdown options ms-auto">
								<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
									<i class='bx bx-dots-horizontal-rounded'></i>
								</div>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="javascript:;">Action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
								</ul>
								</div>
						</div>
						<div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
							<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-primary"></i>New Visitor</span>
							<span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-success"></i>Old Visitor</span>
						</div>
						<div class="chart-container-1">
							<canvas id="chart1"></canvas>
						</div>
					</div>
					<div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
						<div class="col">
						<div class="p-3">
							<h5 class="mb-0">45.87M</h5>
							<small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
						</div>
						</div>
						<div class="col">
						<div class="p-3">
							<h5 class="mb-0">15:48</h5>
							<small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
						</div>
						</div>
						<div class="col">
						<div class="p-3">
							<h5 class="mb-0">245.65</h5>
							<small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
						</div>
						</div>
					</div>
					</div>
				</div>
			
				<div class="col-12 col-lg-4 col-xl-4 d-flex">
					<div class="card radius-10 overflow-hidden w-100">
						<div class="card-body">
						<div class="d-flex align-items-center mb-2">
							<div>
								<h5 class="mb-0">Referrers</h5>
							</div>
							<div class="dropdown options ms-auto">
								<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
									<i class='bx bx-dots-horizontal-rounded'></i>
								</div>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="javascript:;">Action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
								</ul>
								</div>
						</div>
						<div class="chart-js-container3">
							<canvas id="chart2"></canvas>
							</div>
						</div>
					</div>
				</div>
				</div>


				<div class="row row-cols-1 row-cols-lg-3">
				<div class="col">
					<div class="card radius-10">
						<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="w_chart easy-dash-chart1" data-percent="60">
							<span class="w_percent"></span>
							</div>
							<div class="ms-3">
							<h6 class="mb-0">Facebook Followers</h6>
							<small class="mb-0">22.14% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
							</div>
							<div class="ms-auto fs-1 text-facebook"><i class='bx bxl-facebook'></i></div>
						</div>
						</div>
					</div>
					</div>
					<div class="col">
					<div class="card radius-10">
						<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="w_chart easy-dash-chart2" data-percent="65">
							<span class="w_percent"></span>
							</div>
							<div class="ms-3">
							<h6 class="mb-0">Twitter Tweets</h6>
							<small class="mb-0">32.15% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
							</div>
							<div class="ms-auto fs-1 text-twitter"><i class='bx bxl-twitter'></i></div>
						</div>
						</div>
					</div>
					</div>
					<div class="col">
					<div class="card radius-10">
						<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="w_chart easy-dash-chart3" data-percent="75">
							<span class="w_percent"></span>
							</div>
							<div class="ms-3">
							<h6 class="mb-0">Youtube Subscribers</h6>
							<small class="mb-0">58.24% <i class='bx bxs-up-arrow align-middle me-1'></i>Since Last Week</small>
							</div>
							<div class="ms-auto fs-1 text-youtube"><i class='bx bxl-youtube'></i></div>
						</div>
						</div>
					</div>
					</div>
				</div>


				<div class="row">
					<div class="col-12 col-lg-12 col-xl-6">
						<div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center mb-3">
								<div>
									<h5 class="mb-0">Selling Region</h5>
								</div>
								<div class="dropdown options ms-auto">
									<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
										<i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
									</ul>
								</div>
							</div>
							<div id="dashboard-map" style="height: 335px;"></div>
						</div>
						<div class="table-responsive">
							<table class="table table-hover align-items-center mb-0">
								<thead class="table-light">
									<tr>
										<th>Country</th>
										<th>Income</th>
										<th>Trend</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><i class="flag-icon flag-icon-ca me-2"></i> USA</td>
										<td>$4,586</td>
										<td><span id="trendchart1"></span></td>
									</tr>
									<tr>
										<td><i class="flag-icon flag-icon-us me-2"></i>Canada</td>
										<td>$2,089</td>
										<td><span id="trendchart2"></span></td>
									</tr>
				
									<tr>
										<td><i class="flag-icon flag-icon-in me-2"></i>India</td>
										<td>$3,039</td>
										<td><span id="trendchart3"></span></td>
									</tr>
				
									<tr>
										<td><i class="flag-icon flag-icon-gb me-2"></i>UK</td>
										<td>$2,309</td>
										<td><span id="trendchart4"></span></td>
									</tr>
				
									<tr>
										<td><i class="flag-icon flag-icon-de me-2"></i>Germany</td>
										<td>$7,209</td>
										<td><span id="trendchart5"></span></td>
									</tr>
									
								</tbody>
							</table>
							</div>
						</div>
					</div>
					
					<div class="col-12 col-lg-12 col-xl-6">
						<div class="row">
							<div class="col-12 col-lg-6">
							<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<p class="mb-2">Page Views</p>
								<h4 class="mb-0">8,293 <small class="font-13 text-success">5.2% <i class="bx bx-up-arrow-alt"></i></small></h4>
							</div>
							<div class="chart-container-2">
								<canvas id="chart3"></canvas>
							</div>
							</div>
							</div>
							<div class="col-12 col-lg-6">
							<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<p class="mb-2">Total Clicks</p>
								<h4 class="mb-0">7,493 <small class="font-13 text-success">1.4% <i class="bx bx-up-arrow-alt"></i></small></h4>
								
							</div>
							<div class="chart-container-2">
								<canvas id="chart4"></canvas>
							</div>
							</div>
							</div>
							<div class="col-12 col-lg-6">
							<div class="card radius-10">
							<div class="card-body text-center">
								<p class="mb-4">Total Downloads</p>
								<input class="knob" data-width="190" data-height="190" data-readOnly="true" data-thickness=".15" data-angleoffset="90" data-linecap="round" data-bgcolor="rgba(0, 0, 0, 0.08)" data-fgcolor="#843cf7" data-max="15000" value="8550"/>
								<hr>
								<p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since yesterday</p>
							</div>
							</div>
							</div>
							<div class="col-12 col-lg-6">
							<div class="card radius-10">
							<div class="card-body">
								<p>Device Storage</p>
								<h4 class="mb-3">42620/50000</h4>
								<hr>
								<div class="progress-wrapper mb-4">
									<p>Documents <span class="float-end">12GB</span></p>
									<div class="progress" style="height:5px;">
										<div class="progress-bar bg-success" style="width:80%"></div>
									</div>
								</div>
								
								<div class="progress-wrapper mb-4">
									<p>Images <span class="float-end">10GB</span></p>
									<div class="progress" style="height:5px;">
										<div class="progress-bar bg-danger" style="width:60%"></div>
									</div>
								</div>
								
								<div class="progress-wrapper mb-4">
									<p>Mails <span class="float-end">5GB</span></p>
									<div class="progress" style="height:5px;">
										<div class="progress-bar bg-primary" style="width:40%"></div>
									</div>
								</div>
								
							</div>
							</div>
							</div>
						</div>
					</div>
					</div>

					<div class="row">
					<div class="col-12 col-lg-6 col-xl-4 d-flex">
						<div class="card radius-10 overflow-hidden w-100">
							<div class="card-body">
							<p>Total Earning</p>
							<h4 class="mb-0">$287,493</h4>
							<small>1.4% <i class='bx bx-up-arrow-alt'></i> Since Last Month</small>
							<hr>
							<p>Total Sales</p>
							<h4 class="mb-0">$87,493</h4>
							<small>5.43% <i class='bx bx-up-arrow-alt'></i> Since Last Month</small>
							<div class="mt-5">
							<div class="chart-container-4">
								<canvas id="chart5"></canvas>
							</div>
							</div>
							</div>
						</div>
					</div>
				
					<div class="col-12 col-lg-6 col-xl-8 d-flex">
						<div class="card radius-10 w-100">
							<div class="card-header border-bottom bg-transparent">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Customer Review</h5>
								</div>
								<div class="dropdown options ms-auto">
									<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
										<i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="javascript:;">Action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
										<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
									</ul>
									</div>
							</div>
						</div>
							<ul class="list-group list-group-flush review-list">
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
								<img src="{{ url('public/backend/assets/images/avatars/avatar-1.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
								<h6 class="mb-0">iPhone X <small class="ms-4">08.34 AM</small></h6>
								<p class="mb-0 small-font">Sara Jhon : This is svery Nice phone in low budget.</p>
								</div>
								<div class="ms-auto star">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-light-4'></i>
								<i class='bx bxs-star text-light-4'></i>
								</div>
							</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
								<img src="{{ url('public/backend/assets/images/avatars/avatar-2.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
								<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
								<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
								</div>
								<div class="ms-auto star">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-light-4'></i>
								<i class='bx bxs-star text-light-4'></i>
								</div>
							</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
								<img src="{{ url('public/backend/assets/images/avatars/avatar-3.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
								<h6 class="mb-0">Mackbook Pro <small class="ml-4">06.45 AM</small></h6>
								<p class="mb-0 small-font">Jhon Doe : Excllent product and awsome quality</p>
								</div>
								<div class="ms-auto star">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-light-4'></i>
								<i class='bx bxs-star text-light-4'></i>
								</div>
							</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
								<img src="{{ url('public/backend/assets/images/avatars/avatar-4.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
								<h6 class="mb-0">Air Pod <small class="ml-4">08.34 AM</small></h6>
								<p class="mb-0 small-font">Christine : The brand apple is original !</p>
								</div>
								<div class="ms-auto star">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-light-4'></i>
								<i class='bx bxs-star text-light-4'></i>
								</div>
							</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="{{ url('public/backend/assets/images/avatars/avatar-9.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
									<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
									<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
								</div>
								<div class="ms-auto star">
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-light-4'></i>
									<i class='bx bxs-star text-light-4'></i>
								</div>
								</div>
								</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
								<img src="{{ url('public/backend/assets/images/avatars/avatar-7.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
								<h6 class="mb-0">Mackbook <small class="ml-4">08.34 AM</small></h6>
								<p class="mb-0 small-font">Michle : The brand apple is original !</p>
								</div>
								<div class="ms-auto star">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-light-4'></i>
								<i class='bx bxs-star text-light-4'></i>
								</div>
							</div>
							</li>
							<li class="list-group-item bg-transparent">
								<div class="d-flex align-items-center">
									<img src="{{ url('public/backend/assets/images/avatars/avatar-8.png') }}" alt="user avatar" class="rounded-circle" width="55" height="55">
								<div class="ms-3">
									<h6 class="mb-0">Air Pod <small class="ml-4">05.26 PM</small></h6>
									<p class="mb-0 small-font">Danish Josh : The brand apple is original !</p>
								</div>
								<div class="ms-auto star">
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-warning'></i>
									<i class='bx bxs-star text-light-4'></i>
									<i class='bx bxs-star text-light-4'></i>
								</div>
								</div>
								</li>
							</ul>
						</div>
					</div>
					</div>


					<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="mb-0">Orders Summary</h5>
							</div>
							<div class="dropdown options ms-auto">
								<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
									<i class='bx bx-dots-horizontal-rounded'></i>
								</div>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="javascript:;">Action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
									<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
								</ul>
								</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
										<th>Order id</th>
										<th>Product</th>
										<th>Customer</th>
										<th>Date</th>
										<th>Price</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>#897656</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/chair.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Light Blue Chair</h6>
												</div>
											</div>
										</td>
										<td>Brooklyn Zeo</td>
										<td>12 Jul 2020</td>
										<td>$64.00</td>
										<td>
											<div class="badge rounded-pill bg-light-info text-info w-100">In Progress</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#987549</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/shoes.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Green Sport Shoes</h6>
												</div>
											</div>
										</td>
										<td>Martin Hughes</td>
										<td>14 Jul 2020</td>
										<td>$45.00</td>
										<td>
											<div class="badge rounded-pill bg-light-success text-success w-100">Completed</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#685749</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/headphones.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Red Headphone 07</h6>
												</div>
											</div>
										</td>
										<td>Shoan Stephen</td>
										<td>15 Jul 2020</td>
										<td>$67.00</td>
										<td>
											<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#887459</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/idea.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Mini Laptop Device</h6>
												</div>
											</div>
										</td>
										<td>Alister Campel</td>
										<td>18 Jul 2020</td>
										<td>$87.00</td>
										<td>
											<div class="badge rounded-pill bg-light-success text-success w-100">Completed</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#335428</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/user-interface.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Purple Mobile Phone</h6>
												</div>
											</div>
										</td>
										<td>Keate Medona</td>
										<td>20 Jul 2020</td>
										<td>$75.00</td>
										<td>
											<div class="badge rounded-pill bg-light-info text-info w-100">In Progress</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#224578</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/watch.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">Smart Hand Watch</h6>
												</div>
											</div>
										</td>
										<td>Winslet Maya</td>
										<td>22 Jul 2020</td>
										<td>$80.00</td>
										<td>
											<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
									<tr>
										<td>#447896</td>
										<td>
											<div class="d-flex align-items-center">
												<div class="recent-product-img">
													<img src="{{ url('public/backend/assets/images/icons/tshirt.png') }}" alt="">
												</div>
												<div class="ms-2">
													<h6 class="mb-1 font-14">T-Shirt Blue</h6>
												</div>
											</div>
										</td>
										<td>Emy Jackson</td>
										<td>28 Jul 2020</td>
										<td>$96.00</td>
										<td>
											<div class="badge rounded-pill bg-light-success text-success w-100">Completed</div>
										</td>
										<td>
											<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
												<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<!--<div class="new_dashboard">-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <div  class="row">-->
				<!--                <div class="col-md-12 dashboard_logo">-->
				<!--                    <img src="https://ambcrm.com/public/backend/assets/images/logo-icon.png">-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--</div>-->
				
				<!--<section class="login-page">-->
    <!--        	    <div class="row">-->
    <!--        	        <div class="col-md-1"></div>-->
    <!--        	        <div class="col-md-10">-->
    <!--        	            <div class="row dashboard">-->
    <!--                	        <div class="col-md-5">-->
    <!--                	             <div class="site-logo">-->
    <!--            	                    <img src="https://ambcrm.com/public/backend/assets/images/logo-icon.png">-->
    <!--            	                </div>-->
    <!--                	        </div>-->
    <!--                	        <div class="col-md-2 search-or">-->
    <!--                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></span>-->
    <!--                            </div>-->
    <!--                	        <div class="col-md-5">-->
    <!--                	            <div class="form-body">-->
    <!--        	                        <h4 class="search-heading">Search Loads</h4>-->
    <!--        	                        <div class="dashboard_search">-->
    <!--            							<input type="number" class="form-control" id="referenc" placeholder="Load Referenc...">-->
    <!--            							<span class="position-absolute top-50 translate-middle-y search_icon"><i class="bx bx-search"></i></span>-->
    <!--            						</div>-->
    <!--        	                    </div>-->
    <!--                	        </div>-->
    <!--                	    </div>-->
    <!--        	        </div>-->
    <!--        	        <div class="col-md-1"></div>-->
    <!--        	    </div>-->
    <!--        	</section>-->
		</div>
	</div>
  	@include('backend.common.footer')
@endsection