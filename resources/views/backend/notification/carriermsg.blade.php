@extends('backend.layouts.master')

@section('title','Shipper Management')

@section('content')

		<!--start page wrapper -->

		<div class="page-wrapper">

			<div class="page-content">

				<!--breadcrumb-->
				
				
			<ul class="nav nav-tabs">
                <li class="active"><a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">Carrier Message</a>
                </li>
				<li class=""><a href="{{url('admin/notification/messsage/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper Message</a>
                </li>
				<li class=""><a href="{{url('admin/notification/messsage/load')}}" data-toggle="tab" aria-expanded="false">Load Message</a>
                </li>
            </ul>

				

				<!--end breadcrumb-->

                @if ($message = Session::get('success'))

                <div class="alert alert-success">

                <p>{{ $message }}</p>

                </div>

                @endif



				<div class="card">

					<div class="card-body">

						<div class="d-lg-flex align-items-center mb-4 gap-3">

						

						</div>



						<div class="table-responsive3">

							<table class="table mb-0" id="carrier_table">

								<thead class="table-light">

									<tr>

                                        <th>No</th>

                                        <th>Notification</th>

                                        <th>Details</th>

                                        <th>Date</th>

                                       <!--<th>Status</th>-->

                                        <th style="width: 200px;">Action</th>

									</tr>

								</thead>

								<tbody>

								@php

								$i = 0;

								@endphp

                                @foreach($message_data as $udata)

                                            @php

                                                $assignto_id = App\Models\User::where('id', $udata->assignto_id)->get('name');

                                                $assignby_id = App\Models\User::where('id', $udata->assign_id)->get('name');



                                                $ul = $udata->url;

											@endphp

                                        <tr status="{{$udata->status}}">

                                            <td>{{ ++$i }}</td>

                                            <td>

                                                 Carrier MC: {{ $udata->mc_no }}

                                            </td>

                                            <td>{{ $udata->comment }}</td>

											<td>{{ date('d M, Y', strtotime($udata->created_at)) }}</td> 



                                            <?php 

                                            $encoded_id = base64_encode($udata->id);


                                            if($udata['status'] == '1'){
                                                $checked = 'checked';
                                            } else{
                                                $checked = '';
                                            }

                                                $status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

                                            ?>




                                            <td>

                                                <?php

                                                    $notifyst = $udata->status;
                                                    $status = $udata->status;

                                                ?>

                                                <!--a href="{{ url('').'/'.$ul}}" action="{{url('admin/notification/update'."/".$udata->id)}}" notifid="{{$udata->id}}" class="text text-info" style="font-size: 22px;" id="notif_status03" ntfid="{{$status}}" > 

                                                     <i class="bx bx-message-square-edit"></i>

                                                </a --> 


											</td>

                                        </tr>

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

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



<script>

$(function() {

    $(document).on('change','.stat_check', function() {

        var curr    = $(this).prop('checked');

        var cat     = $(this).attr('cat');

        $.ajax({

            type:"post",

            url:"{{ url('admin/notification/update') }}",

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







<script>

    // $(function() {

    //     $(document).on('click','#notif_status', function() {

    //         var curr    = $(this).attr('curr');

    //         var cat     = $(this).attr('cat');

    //         $.ajax({

    //             type:"post",

    //             url:"{{ url('admin/notification/update') }}",

    //             data: {'curr': curr, 'cat':cat},

    //             success:function(resp){

    //                 if(resp.status == 'true'){

    //                     alert('hell') ;

    //                     swal(resp.msg,'','success');

    //                 } else{

    //                     alert('h2') ;

    //                     swal(resp.msg,'','warning');

    //                 }

    //             }

    //         })

    //     })

    // })

</script>





@include('backend.common.footer')



@include('backend.common.notification') 



	

@endsection



