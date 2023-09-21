@empty ($record) 
    @extends('backend.layouts.master')
    
    @section('title','Office Management')
    
    @section('content')
    
    
    
        <!--start page wrapper -->
    
    
    
        <div class="page-wrapper">
    
            <div class="page-content">
    
                <!--breadcrumb-->
    
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    
                    <div class="breadcrumb-title pe-3">Manager List</div>
    
                    <div class="ps-3">
    
                        <nav aria-label="breadcrumb">
    
                            <ol class="breadcrumb mb-0 p-0">
    
                                <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
    
                                </li>
    
                                <li class="breadcrumb-item active" aria-current="page">Office Management</li>
    
                            </ol>
    
                        </nav>
    
                    </div>
    
    
    
                    <div class="ms-auto">
    
                        <div class="btn-group">
    
                            <a class="btn btn-primary" href="{{ URL::previous() }}"> Go Back </a>
                            <!--<a class="btn btn-primary" href="{{ url('admin/agency/manage_edit') }}"> Office Manage</a>-->
    
                            <!-- @can('shipment-create') -->
    
                            <!-- @endcan -->
    
                        </div>
    
                    </div>
    
                </div>
    
    
    
                <!--end breadcrumb-->
    
                @if ($message = Session::get('success'))
    
                <div class="alert alert-success">
    
                    <p>{{ $message }}</p>
    
                </div>
    
                @endif
    
                
    
                <div class="card">
    
                    <div class="table-responsive card-body">	
    
                        <table class="table" id="carrier_table">
    
                        <thead class="table-light">
    
                            <tr>
                                    <th>No</th>
                                    <th width="280px">Name </th>
                                    <th width="280px">Email</th>
                                    <th>officerid</th>
                                    <th>Date</th>
                                    <th width="154px">Action</th>
                            </tr>
    
                            </thead>
                            @php
                                $i = 1;
                            @endphp
    
                            @foreach($data as $agencie)
                                @foreach($agencie['office'] as $dataag)
                                    @php
                                        $idi = $dataag->user_id;
                                        
                                        $item = App\Models\User::where('id',$idi)->where('user_type','officer')->first();
                                    @endphp

                                    @if($item)                                    
                                        <tr>
                                            <td>{{ $i++; }}</td>
                                            <td>{{  isset( $item->name) ? $item->name : Null}}</td>
                                            <td>{{ isset($item->email) ? $item->email : Null  }}</td>
                                            <td>{{ isset($item->officerid) ? $item->officerid : Null }}</td>
                                            <td>{{ isset($item->created_at) ? $item->created_at : Null }}</td>
                                            
                                            @php
                                            	//$roleid = Crypt::encrypt($role->id);
                                            	$nm= 'cmslogisticinfo';
                                            	$agencyid = base64_encode($nm.$item->id);
                                            	
                                            	
                                            @endphp
                                            <td class="action_tooltip">
                                                <!--<a href="{{url('admin/agency/manage/user/data').'/'.$item->id}}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>-->
                                                <a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{url('admin/agency/manage/user/data').'/'.$agencyid}}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
    
                </div>
    
            </div>
    
            </div>
    
        </div>
    
    <!--end page wrapper -->
    
    @include('backend.common.footer')
    
    
    
    @endsection
    
    
@endempty