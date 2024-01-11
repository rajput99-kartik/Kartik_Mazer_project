@extends('backend.layouts.master')

@section('title','Activity View Page')

@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/new-activity')}}" data-toggle="tab" aria-expanded="true">All Activity</a>
                    </li>
                    <li class="pending_approval active"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true">Activity Detail</a>
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
						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table" >
								<thead class="table-light">
									<tr>
                                    <th style="width: 20%;">FIELDS</th>
                                    <th style="width: 40%;">CURRENT</th>
                                    @if($data->event=='updated')
                                    <th style="width: 40%;">PREVIOUS</th>
                                    @endif
									</tr>
								</thead>
								<tbody>
								     @php
                                            $json = $data->properties;
                                            $dd = json_decode($json);
                                            $av = json_decode($json, true);
                                        @endphp
								    
                                    <tr class="activity_dt">
                                        <td>
                                            @foreach ( $av as $key => $a)
                                                @if($key == 'attributes')
                                                    @foreach($a as $key => $v)
                                                        <span><b>{{ $key}} :</b></span>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="CURRENT">
                                            @foreach ( $av as $key => $a)
                                                @if($key == 'attributes')
                                                    @foreach($a as $key => $v)
                                                        <span>{{ $v }}</span>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        @if($data->event=='updated')
                                        <td class="PREVIOUS">
                                            @foreach ( $av as $key => $a)
                                                @if($key == 'old')
                                                    @foreach($a as $key => $v)
                                                        <span> {{ $v }}</span>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        @endif
                                    </tr>
                                           
                                <!--@foreach ($data as $user)-->
                                <!--@endforeach-->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!--end page wrapper -->
@include('backend.common.footer')


{{-- <script>
    $('#carrier_table').DataTable({
        'ajax':{
            'url': "{{ url('admin/changeuserStatus/') }}",
            "error": function(reason) {
                console.log(reason);
            }
        },
        
    });




	'ajax':{
            'url': "{{ url('admin/data/categories') }}",
            "error": function(reason) {
                console.log(reason);
            },
            "complete": function (data) {
                $('.stat_check').bootstrapToggle({
                    on: 'Active',
                    off: 'Inactive'
                });
            }
        },

</script> --}}



{{-- <script>
	$(document).on('click','#check1', function(){
		
		if($(this).is(':checked')){
			var statid = $(this).data-attr(cat);
			alert(statid);
		}
        else{
            alert('unchecked');
		}
		
		//ShowLoaderTimeLine();
			$.ajax({
				url: HOSTPATH+'admin/changeuserStatus',
				type: 'get',
				cache : false,
				data: {agency_id:agency_id},
				success: function(data){
					$('#agency_detail_edit').html(data);
					setTimeout(function () {
							Swal.close();
							$('#agency_detail_edit').modal('show');
					}, 500);
				}
			});
	});
</script> --}}

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
                url:"{{ url('admin/changeuserStatus') }}",
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

{{-- swal({
	title: "User created!",
	text: "Suceess message sent!!",
	icon: "success",
	button: "Ok",
	timer: 2000
}); --}}
@endsection