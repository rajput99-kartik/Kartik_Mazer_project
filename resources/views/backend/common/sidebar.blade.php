	@php
		$ip = getenv("REMOTE_ADDR") ;
		$ipchecker =   App\Models\IpChecker::where('ip_address', $ip)->where('whitelisted', 1)->first();
			//dd($ipchecker);
		

		//$usr = Auth::guard('web')->user();
		//$roles = Role::orderBy('id','DESC')->paginate(5);

		//for logout if user inactive
		$session_id = Session::all();
		$authstatus = Auth::user()->status ;
		$url = url('login');
		if ($authstatus == 0){
			Session::flush();
			Route::resource('login', 'LoginController'); 
		}
	@endphp

  <!--      $ipchecker = 0;-->
  <!--      if($ipchecker == null){-->
		<!--	Session::flush();-->
		<!--	return  Route::resource('login', 'LoginController');-->
		<!--}-->


<div class="sidebar-wrapper" data-simplebar="true">

			<div class="sidebar-header">
				<div>
					<?php 
						$company_detaills = App\Models\Companydetail::first();
						$clogo = isset($company_detaills->company_logo) ? $company_detaills->company_logo : Null ;
					?>
					@if($clogo)					
					<a href="{{url('/admin/dashboard')}}">
					<img src="{{url('public/backend/assets/office')."/".$company_detaills->company_logo}}"   class="logo-icon" alt="logo icon"></a>
					@endif
				</div>
				<div>
					<h4 class="logo-text">
					</h4>
				</div>

				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>

			<!--navigation-->

			

			<ul class="metismenu" id="menu">
				<li>
					<a href="{{url('admin/dashboard')}}" class="">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				

				@can('loads-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-plus"></i>
						</div>
						<div class="menu-title">Manage Loads</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/loads')}}"><i class="bx bx-right-arrow-alt"></i>All Loads</a></li>
						<li> <a href="{{url('admin/load/search_truck')}}"><i class="bx bx-right-arrow-alt"></i>Search Truck</a></li>
						@can('loads-team-agent')
						<li> <a href="{{url('admin/load/manager/loadslist')}}"><i class="bx bx-right-arrow-alt"></i>Team Load List</a></li>
						<!--<li> <a href="{{url('admin/load/manager/list')}}"><i class="bx bx-right-arrow-alt"></i>Team Loads</a></li>-->
						@endcan
						@can('loads-reports')
						<li> <a href="{{url('admin/load/reports/list')}}"><i class="bx bx-right-arrow-alt"></i>Load Reports</a></li>
						@endcan
						<li> <a href="{{url('admin/old/loads')}}"><i class="bx bx-right-arrow-alt"></i>Old Loads</a></li>
					</ul>
				</li>
				@endcan

				

				<!-- Shipment -->
				@can('shipment-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-car"></i></div>
						<div class="menu-title">Shipment </div>
					</a>
					<ul>
						@can('shipment-all')
						<li> <a href="{{url('admin/shipment/list')}}"><i class="bx bx-right-arrow-alt"></i>All Shipments</a></li>
						@endcan

						@can('shipment-agentshipment')
						<li> <a href="{{url('admin/shipment/manager/shipmentlist')}}"><i class="bx bx-right-arrow-alt"></i>Team Shipment List</a></li>
						<!--<li> <a href="{{url('admin/shipment/manager/list')}}"><i class="bx bx-right-arrow-alt"></i>Team Shipment</a></li>-->
						@endcan
						
						@can('shipment-create')
						<li> <a href="{{url('admin/shipment')}}"><i class="bx bx-right-arrow-alt"></i>Shipments</a></li>
						<li><a href="{{url('admin/create-shipment')}}"><i class="bx bx-right-arrow-alt"></i>Create Shipments</a></li>
						@endcan
					</ul>
				</li>
				@endcan
				<!-- End Shipment -->


				

				<!-- Shipper -->

				@can('shipper-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">

						<div class="parent-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></div>
						<div class="menu-title">Manage Shipper</div>
					</a>

					<ul>
						@can('shipper-all')
						<li> <a href="{{url('admin/shipper/list')}}"><i class="bx bx-right-arrow-alt"></i>All Shipper</a></li>
						@endcan

						@can('shipper-agentshipper')
						<li> <a href="{{url('admin/shipper/manager/list')}}"><i class="bx bx-right-arrow-alt"></i>Team Shipper</a></li>
						@endcan

						@can('shipper-create')
						<li> <a href="{{url('admin/shipper')}}"><i class="bx bx-right-arrow-alt"></i>Shipper</a></li>
						<li> <a href="{{url('admin/shipper/add')}}"><i class="bx bx-right-arrow-alt"></i>Create Shipper</a></li>
						@endcan

						@can('shipper-request')
        				<li> <a href="{{url('admin/shipper/request')}}"> <i class="bx bx-right-arrow-alt"></i>Shipper Request</a></li>
        				@endcan
					</ul>

				</li>
				@endcan

				

				<!-- End Shipper -->
				
				@can('carrier-list')
				<li>

					<a href="javascript:void(0);" class="has-arrow">

						<div class="parent-icon"><i class="lni lni-graduation"></i></div>
						<div class="menu-title">Manage Carrier</div>

					</a>

					<ul>

					    @can('carrier-all')
					    <li> <a href="{{url('admin/carrier/list')}}"><i class="bx bx-right-arrow-alt"></i>All Carriers</a></li>
					    @endcan
						@can('carrier-agentcarrier')
						<li> <a href="{{url('admin/carrier/manager/list')}}"><i class="bx bx-right-arrow-alt"></i>Team Carriers</a></li>
						@endcan
						
						@can('carrier-view')
						<li> <a href="{{url('admin/carrier')}}"><i class="bx bx-right-arrow-alt"></i>Carriers</a></li>
						@endcan
						

						@can('carrier-create')
						<li> <a href="{{url('admin/new/carrier/detail')}}"><i class="bx bx-right-arrow-alt"></i>Create Carrier</a></li>
						@endcan

						<li> <a href="{{url('admin/carrier/myCarrierPacket')}}"><i class="bx bx-right-arrow-alt"></i>MyCarrierPacket</a></li>

						@can('carrier-request')
						<li> <a href="{{url('admin/carrier/requests')}}"><i class="bx bx-right-arrow-alt"></i>Carriers Requests</a></li>
						@endcan

					</ul>

				</li>

				@endcan

				
			<!--Office-->
				@can('agency-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-buildings"></i>
						</div>
						<div class="menu-title">Manage Office</div>
					</a>

					<ul>
						<li> <a href="{{url('admin/agency')}}"><i class="bx bx-right-arrow-alt"></i>Office</a></li>
						<li> <a href="{{url('admin/agency/new/office')}}"><i class="bx bx-right-arrow-alt"></i>Office Manage</a></li>
					</ul>

				</li>
				@endcan
			<!--Office End-->

			<!--AR Start-->
				@can('managear-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-rupee"></i>
						</div>
						<div class="menu-title">Manage Ar</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/ar/shipment-list')}}"><i class="bx bx-right-arrow-alt"></i>Ar Dashboard</a></li>
						<li> <a href="{{url('admin/ar/assign/shipmentlist')}}"><i class="bx bx-right-arrow-alt"></i>Ar Shipment List</a></li>
						@can('managear-invoices')
						<li> <a href="{{url('admin/ar/aging/invoiceGenerated')}}"><i class="bx bx-right-arrow-alt"></i>Invoice Generated</a></li>
						<li> <a href="{{url('admin/ar/pay/completed')}}"><i class="bx bx-right-arrow-alt"></i>Pay Completed</a></li>
						@endcan
					</ul>
				</li>
				@endcan
			<!--AR End-->

			<!--AP Start-->
				@can('manageap-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-laptop"></i>
						</div>
						<div class="menu-title">Manage Ap</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/accountap/shipment/list')}}"><i class="bx bx-right-arrow-alt"></i>AP Shipment List</a></li>
						<!--<li> <a href="{{url('admin/accountap')}}"><i class="bx bx-right-arrow-alt"></i>AP List</a></li>-->
						<li> <a href="{{url('admin/carrier/payment/aging')}}"><i class="bx bx-right-arrow-alt"></i>Payment Aging</a></li>
					</ul>
				</li>

				@endcan

				@can('carrieraccount-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-graduation"></i>
						</div>
						<div class="menu-title">Carrier Acc.</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/carrierac')}}"><i class="bx bx-right-arrow-alt"></i>Carrier List</a></li>
					</ul>
				</li>
				@endcan

				@can('carrierpayment-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-dollar"></i>
						</div>
						<div class="menu-title">Carrier Payments</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/carrier/payment/updates')}}"><i class="bx bx-right-arrow-alt"></i>Payment Updates</a></li>
					</ul>
				</li>
				@endcan
			<!--AP End-->

			@can('pendingpay-ap-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-alarm-clock"></i>
						</div>
						<div class="menu-title">Pending Pay(AP)</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/carrier/pending/payment')}}"><i class="bx bx-right-arrow-alt"></i>Updated Payments</a></li>
						<li> <a href="{{url('admin/carrier/done/payment')}}"><i class="bx bx-right-arrow-alt"></i>Done Payments</a></li>
					</ul>
				</li>
			@endcan
				
			<!--User Start-->
				@can('user-list')
				<li>

					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-users"></i>
						</div>
						<div class="menu-title">Manage User</div>
					</a>

					<ul>
						<li> <a href="{{url('admin/users')}}"><i class="bx bx-right-arrow-alt"></i>All User</a></li>
						@can('user-create')
						<li> <a href="{{url('admin/users/create')}}"><i class="bx bx-right-arrow-alt"></i>Add New</a></li>
						@endcan
					</ul>

				</li>
				@endcan
			<!--User End-->

			<!--AR/AP Users-->
				@can('uagent-list')
				<li>

					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-task"></i>
						</div>
						<div class="menu-title">Manage AR/AP/Assign</div>
					</a>

					<ul>
						<li> <a href="{{url('admin/assignacp/all/shipment')}}"><i class="bx bx-right-arrow-alt"></i>Assign Shipment List(AP)</a></li>
						<li> <a href="{{url('admin/assignacp')}}" ><i class="bx bx-right-arrow-alt"></i>Assign Shipment (AP)</a></li>
						
						<li> <a href="{{url('admin/ar/assign/all/shipment')}}" ><i class="bx bx-right-arrow-alt"></i>Assign Shipment List(AR)</a></li>
						<li> <a href="{{url('admin/assign/ar')}}" ><i class="bx bx-right-arrow-alt"></i>Assign Shipment (AR)</a></li>
					</ul>

				</li>
				@endcan 
			<!--AR/AP End-->


			<!--AR/AP Users-->
			@can('manageap-assign')
				<li>

					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-task"></i>
						</div>
						<div class="menu-title">Assign Shipment(Payable)</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/assignacp/add')}}"><i class="bx bx-right-arrow-alt"></i>Assign Agent(AP)</a></li>
					</ul>
				</li>
			@endcan

			@can('managear-assign')
				<li>

					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-task"></i>
						</div>
						<div class="menu-title">Assign Shipment(AR)</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/assign/ar/add')}}"><i class="bx bx-right-arrow-alt"></i>Assign Agent(AR)</a></li>
					</ul>
				</li>
			@endcan

			<!--Roles-->
				@can('role-list')
				<li>

					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-user-plus"></i>
						</div>
						<div class="menu-title">Manage Roles</div>
					</a>

					<ul>
						<li> <a href="{{url('admin/roles')}}"><i class="bx bx-right-arrow-alt"></i>All Roles</a></li>
						@can('role-create') 
						<li> <a href="{{url('admin/roles/create')}}"><i class="bx bx-right-arrow-alt"></i>Add New</a></li>
						@endcan
					</ul>

				</li>
				@endcan
			<!--Roles End-->

			<!--Agents-->
				@can('uagent-list') 
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-users"></i>
						</div>
						<div class="menu-title">Manage Agent</div>
					</a>
					<ul>
						@can('uagent-all')
						<li> <a href="{{url('admin/assignuser/list')}}"><i class="bx bx-right-arrow-alt"></i>All Agent</a></li>
						@endcan
						
						<li> <a href="{{url('admin/assignuser')}}"><i class="bx bx-right-arrow-alt"></i>User Agent</a></li>
						@can('uagent-create')
						<li> <a href="{{url('admin/assignuser/add')}}"><i class="bx bx-right-arrow-alt"></i>Add New</a></li>
						@endcan
						
					</ul>
				</li>
				@endcan
			<!--Agents End-->

				@can('activity-list')
				<li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-loader'></i></div>
						<div class="menu-title">User Activity</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/new-activity')}}"><i class="bx bx-right-arrow-alt"></i>Activity</a>
						</li>
						<!--<li> <a href="{{url('admin/user-activity')}}"><i class="bx bx-right-arrow-alt"></i>Activity</a>-->
						<!--</li>-->
					</ul>
				</li>
                <li>
					<a href="javascript:void(0);" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cog'></i></div>
						<div class="menu-title">Settings</div>
					</a>
					<ul>
						<li> <a href="{{url('admin/setting/company-details')}}"><i class="bx bx-right-arrow-alt"></i>Setting</a>
						</li>
					</ul>
				</li>
				
				@endcan
				
				<li>
                     <a href="javascript:void(0);" class="has-arrow">
                         <div class="parent-icon"><i class='bx bx-cog'></i></div>
                         <div class="menu-title">DAT Setting</div>
                     </a>
                     <ul>
                         <li> <a href="{{ url('admin/setting/dat/user/api') }}"><i class="bx bx-right-arrow-alt"></i>DAT User
                                 List</a>
                         </li>
                         
                         <!--<li> <a href="{{ url('admin/setting/dat/user/auth/api') }}"><i class="bx bx-right-arrow-alt"></i>DAT Auth</a>-->
                         <!--</li>-->
                     </ul>
                 </li>
				
				
				<!--report-->
				@can('report')
				<li>
					<a href="{{url('admin/report')}}">
						<div class="parent-icon"><i class='bx bx-file'></i></div>
						<div class="menu-title">Report</div>
					</a>
					{{-- <ul>
						<li> <a href="{{url('admin/report')}}"><i class="bx bx-right-arrow-alt"></i>View Report</a>
						</li>
					</ul> --}}
				</li>
				@endcan
				
			</ul>

			<!--end navigation-->

		</div>