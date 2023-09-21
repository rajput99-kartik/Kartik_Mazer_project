@empty ($record) 
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
                        <li class="all_leave active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="false">Agent Detail</a>
                        </li>
                </ul>
                <div class="card">
                    <div class="table-responsive card-body">	
                        <table class="table" id="carrier_table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name </th>
                                <th>Email</th>
                                <th>Officerid</th>
                                <th>Load</th>
                            </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                            @foreach($item as $agencie)  
                                @php
                                    $id = $agencie->id ;
                                    $data = App\Models\Load::where('user_id',$id)->get();
                                @endphp
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{  isset( $agencie['name']) ?  $agencie['name'] : Null}}</td>
                                    <td>{{ isset($agencie->email) ? $agencie->email : Null  }}</td>
                                    <td>{{ isset($agencie->officerid) ? $agencie->officerid : Null }}</td>
                                    <td>{{ count($data) }}</td>
                                    {{-- <td>{{ isset($agencie->created_at) ? $agencie->created_at : Null }}</td> --}}
                                </tr>
                            @endforeach
                        </table>
    
                </div>
    
            </div>
    
            </div>
    
        </div>
    
    <!--end page wrapper -->
    
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
@endempty