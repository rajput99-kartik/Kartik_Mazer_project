@extends('backend.layouts.master')
@section('title','Clock View')
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
                  
                  
                     <li class="pending_approval active"><a href="{{url('/admin/clockin/view')}}" data-toggle="tab" aria-expanded="true">All Clock</a>
                    </li>


                    <li class="pending_approval"><a href="{{ url('admin/dashboard') }}" data-toggle="tab" aria-expanded="true">Dasboard</a>
                    </li>
                  
                </ul>
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Time IN</th>
                                        <th>Time Out</th>
                                        <th>Date</th>
                                     
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($data as $udata)
                                            @php
                                                $id = $udata->user_id;
                                                $uname = App\Models\User::where('id',$udata->user_id)->first();
                                                $name = $uname->name ?? Null ;
                                                $officerid = $uname->officerid ?? Null ;
                                            @endphp
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$name }}</td>
                                            
                                            @if(empty($udata->brackin))
                                            <td> 00:00 </td>
                                            @else
                                                <td >{{ isset($udata->brackin) ? $udata->brackin : Null}}</td>
                                            @endif


                                            @if(empty($udata->brackout))
                                                <td> 00:00 </td>
                                              @else
                                                <td id="demo_{{$i}}" class="req_date">{{ isset($udata->brackout) ? $udata->brackout : Null}}</td>
                                            @endif
                                            <td>{{ $udata->created_at }}</td>
                                            
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
@include('backend.common.footer')
@endsection

