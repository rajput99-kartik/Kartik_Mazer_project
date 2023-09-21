@extends('backend.layouts.master')

@section('title','Office Management')

@section('content')

<style>
	.thumbnail {
		margin-top: 10px;
		margin-left: 50px;
		margin-bottom: 15px;
	}
</style>


<!--start page wrapper -->



<div class="page-wrapper">
	
	<div class="page-content">
		
		
		
		<!--end breadcrumb-->
		
		@if ($message = Session::get('success'))
		
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
		@endif
		
		
		@php
		$numOfCols = 3;
		$rowCount = 0;
		$bootstrapColWidth = 12 / $numOfCols;
		@endphp 
		<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/agency')}}" data-toggle="tab" aria-expanded="true">All Office</a>
                </li>
                    <li class="all_leave active"><a href="{{url('/admin/agency/new/office')}}" data-toggle="tab" aria-expanded="false">Office Manage</a>
                    </li>
            </ul>
		<div class="card">
			<div class="card-body" style="padding: 50px 0px;">	
				<div class="row">
					@foreach($data as $agencie)
					<div class="col-md-3">
						<a href="javascript:void(0)" id="agencyManager" value="{{$agencie->id}}">
							 <i class="fadeIn animated bx bx-buildings"></i>
							<span>{{ isset($agencie->agencies_name) ?  $agencie->agencies_name : Null }}</span>
							
							
						</a>
					</div>
					@endforeach
					
				</div>
				
			</div>
			
			
			
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div id="agencyManagerForm">
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>

{{-- {{url('admin/agency/manage/user/').'/'.$agencie->id }} --}}
<!--end page wrapper -->




@include('backend.common.footer')
@endsection

