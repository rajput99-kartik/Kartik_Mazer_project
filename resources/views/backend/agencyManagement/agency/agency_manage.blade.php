@extends('backend.layouts.master')

@section('title','Office Management')

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
                <li class="pending_approval"><a href="{{url('/admin/agency')}}" data-toggle="tab" aria-expanded="true">All Office</a>
                </li>
    
                    <li class="all_leave"><a href="{{url('/admin/agency/new/office')}}" data-toggle="tab" aria-expanded="false">Office Manage</a>
                    </li>
            </ul>

			<div class="card">

				<div class="table-responsive card-body">	

					<table class="table" id="carrier_table">

					<thead class="table-light">

					  <tr>
							<th>No</th>
							<th width="280px">Office </th>
							<th width="280px">User</th>
							<th>Date</th>
							<th width="154px">Action</th>
					  </tr>

						</thead>

						@php

							$i = 1;

						@endphp

						@foreach($data as $agencie)

							<tr>

								<td>{{ $i++; }}</td>
								<td>{{ $agencie->agencies_name }}</td>
								<td>{{ $agencie->name }}</td>
								<td>{{ $agencie->created_at }}</td>
								<td class="action_tooltip">
									<a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{url('admin/agency/manage/user/').'/'.$agencie->id }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>
									{{-- <button type="button" id="" class="btn btn-outline-info btn-sm radius-30 px-4" value="{{ $agencie->id }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></button> --}}

									

								</td>

							</tr>

						@endforeach

					</table>

			</div>

		</div>

		</div>

	</div>

<!--end page wrapper -->




@include('backend.common.footer')



@endsection

