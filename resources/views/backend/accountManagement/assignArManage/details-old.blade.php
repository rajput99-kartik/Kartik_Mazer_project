@extends('backend.layouts.master')
@section('title','Account Receivables')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Account Receivables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Shipment List</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
				@if ($message = Session::get('errors'))
                <div class="alert alert-danger">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							{{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Shipper"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}

						  {{-- <div class="ms-auto"><a href="{{url('admin/assignuser/add')}}"><button class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>User</button></a></div> --}}
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>#Load</th>
                                        <th>Customer Name</th>
                                        <th>Agent (User)</th>
                                        <th>Pick</th>
                                        <th>Drop</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								//dd($shipment);
								@endphp

								@foreach($shipment as $udata)
								
							@foreach($udata->accountShipments as $item)
                            

								@foreach ( $item->getShipments as $itemdata )
                                <?php 
                                
                                    $encoded_id = ($itemdata->id);
                                    $encoded_id1 = $itemdata->id;
                                    $statusdata =  isset($itemdata->ar_access_status) ? $itemdata->ar_access_status : Null;
                                    if ($statusdata == '1') {
                                        $checked = 'checked';
                                    }else {
                                        $checked = '';
                                    }
                                    // echo '<pre>',print_r($encoded_id),'</pre>'; 
                                    $status_content = '<input type="checkbox" cid="'.$encoded_id.'"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';
                                ?>
									
										<tr>
										<td>{{ ++$i }}</td>
										<td class="loadid">
												{{ isset($itemdata['id'])  ? $itemdata['id'] : Null }}
										</td>
										<td>
												@foreach ($itemdata->getCompany as $item)
												{{ isset($item['company_name'])  ? $item['company_name'] : Null }}
												@endforeach
										</td>
										
										@foreach($udata->arTeamAgent as $agent)
										<td><a href="{{ url('admin/assignuser/view',$agent->id )}}">{{ ucwords($agent['name'])  }} </a></td>
										@endforeach
										
										<td></td>
										<td></td>
										<td>
												@foreach ($itemdata->shipmentPrice as $item)
												{{ $item['customer_total'] }}
													
												@endforeach
											</td>
                                            <td class="switch-btn">
                                            {!! $status_content !!}
                                            <span class="switch"></span>
                                            </td>
										
										</tr>
									
								@endforeach
								
								@break
							@endforeach
							
							@break
							@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>

<!-- Ar payment update Modal start here -->
<div class="modal" id="ArPaymentUpt">
</div>
<!-- Ar payment update Modal end here -->

<div class="modal" id="ArCommentShow">	
</div>



{{-- for status checking start here --}}
<script>
$(function() {
    $(document).on('change','.stat_check', function() {
        var curr    = $(this).prop('checked');
        var cat     = $(this).attr('cat');
        $.ajax({
            type:"post",
            url:"{{ url('admin/ar/assignuser/details/status') }}",
            data: {'curr': curr, 'cat':cat},
            success:function(resp){
                if(resp.status == 'true'){
                    swal(resp.msg,'','success');
                } else{
                    swal(resp.msg,'','warning');
                }
            }
        })
    })
})
</script>

@include('backend.common.footer')
@endsection

