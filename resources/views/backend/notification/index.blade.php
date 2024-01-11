@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			    
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                
                <ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard </a>
                    </li>
                    <li class="all_leave active"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="javascript::void(0)" aria-expanded="false">Notifications</a></li>
                </ul>
				<div class="card">
					<div class="card-body">
					    <h4 class="text text-primary" style="margin-top:15px;">Notification <i class="bx bx-bell"></i></h4>
                        <div class="notifications">
                            @php
							$i = 0;
							@endphp
                            @foreach($userdata as $udata)
                            @php
                                $assignto_id = App\Models\User::where('id', $udata->assignto_id)->get('name');
                                $assignby_id = App\Models\User::where('id', $udata->assign_id)->get('name');

                                $ul = $udata->url;
							@endphp
                            <div class="notify-box" status="{{$udata->status}}">
                                <a href="{{ url('').'/'.$ul}}">
                                    <p>{{ ucfirst($udata->title) }} <b>{{ $udata->body }}</b></p>
                                    <span>{{ date('d M, Y', strtotime($udata->created_at)) }}</span>
                                </a>
                            </div>
                            @endforeach
                            {{ $userdata->links() }}
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

