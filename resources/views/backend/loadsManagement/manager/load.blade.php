@extends('backend.layouts.master')



<!--<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />-->
<!--<link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet" />-->

@section('title','Loads Management')
@section('content')


<style>
    button#reset {
        position: absolute;
        right: 20px;
        background: none;
        top: 13px;
        width: fit-content !important;
        border: none;
        color: red;
        display:none;
    }
</style>

	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			<ul class="nav nav-tabs">
                <li class="pending_approval "><a href="{{url('/admin/loads')}}" data-toggle="tab" aria-expanded="true">All Loads</a>
                </li>
                
                <li class="pending_approval"><a href="{{url('/admin/load/manager/list')}}" data-toggle="tab" aria-expanded="true">Assign User</a>
                </li>

                <li class="active"><a href="{{url('/admin/load/manager/assignuser/loads',$userid)}}" aria-expanded="false">Posted Loads</a>
                    </li>
            </ul>
			

			{{-- filtter start --}}

			     <!-- <div class="card card-primary ar">-->
    				<!--<div class="card-body">-->
    				<!--   <div class="row">-->
    						   
    				<!--		  {{-- <div class="col-md-3 col-sm-3 col-xs-12">-->
    				<!--			  <label>Status</label>-->
    				<!--			  <select class="allcust form-control" id="ShipperStatus">-->
    				<!--				 <option value="">All</option>-->
    				<!--				  <option value="0">Pending</option>-->
    				<!--				  <option value="1">Approved</option>-->
    				<!--				  <option value="2">Dis-Approve</option>-->
    				<!--			  </select>-->
    				<!--		  </div> --}}-->
    
    						
    
    				<!--		  {{-- <div class="col-md-3 col-sm-3 col-xs-12">-->
    				<!--			  <label>Truck</label>-->
    				<!--				  <select class="allcust form-control" id="ShipperName">-->
    				<!--						  <option value="">All</option>-->
    				<!--					  @foreach($comp_data as $company) -->
    				<!--						  <option value="{{ $company->id }}">{{ $company->company_name }}</option>-->
    				<!--					  @endforeach-->
    				<!--				  </select>-->
    				<!--		  </div> --}}-->
    						  
    
    				<!--		  <div class="col-md-3 col-sm-3 col-xs-12">-->
    				<!--			  <label>Load Type</label>-->
    				<!--			  <select class="allcust form-control" id="lodetypeerStatus">-->
    				<!--				 <option selected>- Select -</option>-->
    				<!--				  <option value="FULL">Full</option>-->
    				<!--				  <option value="PARTIAL">Partial</option>-->
    				<!--			  </select>-->
    				<!--		  </div>-->
    
    				<!--		  <div class="col-md-3 col-sm-3 col-xs-12">-->
    				<!--			<label>From Date</label>-->
    							
    
    				<!--			<input type="date" name="ldate" id="from_date" style="width: 100%;">-->
    				<!--				{{-- <select class="allcust form-control" id="ShipperName">-->
    				<!--						<option value="">All</option>-->
    				<!--					@foreach($comp_data as $company) -->
    				<!--						<option value="{{ $company->id }}">{{ $company->company_name }}</option>-->
    				<!--					@endforeach-->
    				<!--				</select> --}}-->
    				<!--		</div>-->
    				<!--		<div class="col-md-3 col-sm-3 col-xs-12">-->
    							
    				<!--			<label>To Date</label>-->
    				<!--			<input type="date" name="ldate" id="to_date" style="width: 100%;">-->
    				<!--				{{-- <select class="allcust form-control" id="ShipperName">-->
    				<!--						<option value="">All</option>-->
    				<!--					@foreach($comp_data as $company) -->
    				<!--						<option value="{{ $company->id }}">{{ $company->company_name }}</option>-->
    				<!--					@endforeach-->
    				<!--				</select> --}}-->
    				<!--				<button type="button" id="reset">Reset Filter</button>-->
    				<!--		</div>-->
    				<!--		  <div class="col-md-3 col-sm-3 col-xs-12">-->
    				<!--		  <label style="visibility: hidden;display: block;">buttonrefresh</label>-->
    				<!--			  <a href="javascript:void(0);" id="LoadRefreshB" load-data="{{base64_encode($user_id)}}" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</a>-->
    					
    				<!--		  </div>-->
    				<!--	  </div>-->
    				<!--	</div>-->
    			 <!-- </div>-->

			{{-- fillter end --}}
			

			<!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			@if ($message = Session::get('error'))
			<div class="alert alert-danger">
			    <p>{{ $message }}</p>
			</div>
			@endif
			

<!--<button class="btn btn-primary">Import Users</button>-->
            <!--<a class="btn btn-success" href="{{ url('export-users') }}">Export Users</a>-->


			<div class="card">
				<div class="card-body table-responsive">	
					<table class="table mb-0" id="carrier_table">
    					<thead class="table-light">
    					  <tr>
    						 <th>#</th>
    						 <th>Referenc</th>
    						 <th>Pick Date</th>
    						 <th>Origin</th>
    						 <th>Drop</th>
    						 <th>Truck</th>
    						 <th>Load Type</th>
    						 <th>Broker</th>
    						 <th>Status</th>
    						 <th>Date</th>
    						 <th>Action</th>
    					  </tr>
    					</thead>

						<tbody id="lodetypeerStatus">
						
						@php $i=1;
						@endphp
							@foreach($user_loads as $user_load)
    						
    					<tr class="odd">
							
							<td>{{ $i++ }}</td>
							<td class="copy-text">{{ $user_load->ref_no }}</td>
							<td class="copy-text">{{ $user_load->post_date }}</td>
							<td class="copy-text">{{ $user_load->load_state_origin }}</td>
							<td class="copy-text">{{ $user_load->load_city_desti }}</td>
							<td class="copy-text">{{ $user_load->equipments }}</td>
							<td class="copy-text">{{ $user_load->full_partial_tl_ltl }}</td>
							
							
							@php
								$user =  App\Models\User::where('id',$user_load['user_id'])->first();
								$name= isset($user['name']) ? $user['name'] : null;
							@endphp
							<td>{{ucfirst($name)}}</td>
							
							
							<?php
								
								$status= $user_load->load_status;
								
								$date_pick= explode("T",$user_load->dat_pick_date);
								$date_pick1= strtotime($date_pick['0']);
								$today= strtotime(date('Y-m-d'));
								$lstatus= '';
								if($today > $date_pick1){
									$lstatus = 'Expire'; 
								}else{
									if($status == 1){
											$lstatus = 'Delete'; 
									}else{
										$lstatus = 'Active';
									}
								}
							?>
							<td>{{ $lstatus }}</td>
							<td>{{ date('d M, Y', strtotime($user_load->created_at) )}}</td>
    						<td style="width: 80px;" class="action_tooltip classToInclude"  >
								<input type="hidden" value="{{ $user_load->load_dat_id }}" id="load_dat_id">
								
								<button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4" id="load_update_form_btn"><i class="bx bx-edit"></i><span class="tooltip">Edit</span></button>
								
								
							</td> 
    					  </tr>
						  
							@endforeach
						</tbody>
					</table>
			</div>
		</div>

		</div>
	</div>
	
	<!--loads edit model start-->
	<div class="modal" id="LoadUpdateForm">
	</div>
	<!--loads edit model end-->
	
	<script>
        $(document).ready(function(){
            
            $("a#LoadRefreshB").click(function(){
                if($("select#lodetypeerStatus").val()=='' || $("input#from_date").val()=='' || $("input#to_date").val()==''){
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Please Select Load Type, From Date & To Date..'
                    })
                }else{
                    var lodetypeerStatus = $("select#lodetypeerStatus").val();
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    var userid = $(this).attr('load-data');
                    $.ajax({
                      url: "{{url('/admin/load/manager/assignuser/loadsfilter')}}",
                      type:"POST",
                      data:{
                        "_token": "{{ csrf_token() }}",
                        lodetypeerStatus:lodetypeerStatus,
                        from_date:from_date,
                        to_date:to_date,
                        userid:userid,
                      },
                      success:function(response){
                        $("tbody#lodetypeerStatus").html(response);
                        $("#reset").fadeIn();
                        $("div#carrier_table_paginate").hide();
                      },
                      error: function(response) {
                        console.log(response.responseJSON.errors);
                       }
                     });
                     
                     
                }
                
            })
            
            $("#reset").click(function(){
                let timerInterval
                Swal.fire({
                  title: 'Wait..',
                  html: 'I will Reset Filter in <b></b> milliseconds.',
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 500)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
                setTimeout(function(){
                    window.location.reload();
                }, 500)
                 
             })
            
            $('.search_input input').keyup(function(){
                $('#'+$(this).attr('for')).show();

                var value = $(this).val().toLowerCase();
                $('#'+$(this).attr('for')+' li').filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            })
            
            $("ul#lane_drop li").click(function(){
                $('input[name="lane_drop"]').val($(this).text());
                $("ul#lane_drop").hide();
            })
            
            $("ul#lane_origin li").click(function(){
                $('input[name="lane_origin"]').val($(this).text());
                $("ul#lane_origin").hide();
            })
            
            //-----JS for Price Range slider-----

$(function() {
	$( "#slider-range" ).slider({
	  range: true,
	  min: 130,
	  max: 500,
	  values: [ 130, 250 ],
	  slide: function( event, ui ) {
		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	  }
	});
	$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
});
        })
    </script>
<!--end page wrapper -->
		<script>

			/* Admin shipper list filter funcation Start Here*/
			$(document).on('click','#LoadRefreshB', function(){
				
			var lodetypeerStatus = $('#lodetypeerStatus').val();
			// var ShipperName = $('#ShipperName').val();
			// var AgentName = $('#AgentName').val();
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();


			if((lodetypeerStatus != '') || (ShipperName != '') || (AgentName != '')){


			$.ajax({
					url: HOSTPATH+'admin/load/loadFilterAdmin',
					type: 'get',
					cache : false,
					data: {lodetypeerStatus:lodetypeerStatus,ShipperName:ShipperName,AgentName:AgentName},
					success: function(data){
						
						$('#lodetypeerStatus').html(data);			
						setTimeout(function () {
								Swal.close();
						}, 500);
					
					}	
				});
				
			}else{

				Swal.fire({
					position: 'center',
					icon: 'warning',
					title: 'Select some details first!',
					showConfirmButton: false,
					timer: 1000
				})

			}
				
				
			});
			/* Admin shipper list filter funcation End Here*/
		</script>


<script>
    $(document).ready(function() {
    $('#carrier_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            // targets: -2,
            visible: false
        } ]
    } );
} );
</script>


<!--<script>-->
<!--    $(document).ready(function() {-->
<!--    $('#carrier_table').DataTable( {-->
<!--        dom: 'Bfrtip',-->
<!--        buttons: [-->
<!--        'copy', 'csv', 'excel', 'pdf', 'print',-->
        
<!--        ]-->
        
       
<!--    } );-->
<!--} );-->
<!--</script>-->


    


@include('backend.common.footer')
@endsection
