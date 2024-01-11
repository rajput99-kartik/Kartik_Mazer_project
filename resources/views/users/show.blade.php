@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')

<style>
    .agmain li {
            display: none;
            }

        .show_age {
        display: block !important;
        }
</style>

    <div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Show User</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Show User</li>
						</ol>
					</nav>
				</div>

				<div class="ms-auto">
					<div class="btn-group">
						<a href="{{url('/admin/users')}}" class="btn btn-primary">
                          Back
                        </a>
					</div>
				</div>
			</div>
			<div class="card">
			    <div class="card-body">
			        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                {{ $user->phone }}
                            </div>
                        </div>

                        @php
                           // $data = App\Models\User::where('id', $assignuser_id)->first();
                            // 'assignto_id'
                           // $assignto_idd = App\Models\User::where('id', $data->assignto_id)->get('name');
                           //dd($assignto_idd);
                            // $assignby_id = App\Models\User::where('id', $assignuser_id)->get('name');
                        @endphp

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Agency Name:</strong>
                                {{-- @foreach($assignto_idd as $bought)
                                    {{ $bought['name'] }}
                                @endforeach --}}


                                @php
                                    $agid = '';
                                    if(!empty( $agncydata->agency_id)){
                                        $agid = $agncydata->agency_id ;
                                    }else {
                                        $agid = '0' ;
                                    }
                                    $ages = DB::table('agencies')->get();
                                @endphp
                                
                                <div class="agmain">
                                    @foreach ($ages as $agesall)
                                        @php
                                            $matchid = $agesall->id;
                                        @endphp
                                        <li value="{{$agesall->id}}" @if($agid==$matchid) class="show_age" @endif> {{$agesall->agencies_name}}  
                                        </li>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Extension No:</strong>
                                {{ $user->ext }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Roles:</strong>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="text text-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
			    </div>
			</div>
		</div>
	</div>


@include('backend.common.footer')
@endsection