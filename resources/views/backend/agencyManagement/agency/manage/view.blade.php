<div class="table-responsive card-body">	
    
    <table class="table" id="carrier_table">

    <thead class="table-light">

        <tr>
                <th>No</th>
                <th >Name</th>
                <th>Email</th>
                <th>Officerid</th>
                <!--<th>Agent</th>-->
                <th >Action</th>
        </tr>

        </thead>
        @php
            $i = 1;
        @endphp
        @if(count($dataitem) > 0)
            @foreach($dataitem as $agencie)
                @foreach($agencie['office'] as $dataag)
                    @php
                        $idi = $dataag->user_id;
                        
                        $item = App\Models\User::where('id',$idi)->where('user_type','officer')->first();
                    @endphp

                    @if($item)                                    
                        <tr>
                            <td>{{ $i++; }}</td>
                            <td>{{ isset( $item->name) ? $item->name : Null}}</td>
                            <td>{{ isset($item->email) ? $item->email : Null  }}</td>
                            <td>{{ isset($item->officerid) ? $item->officerid : Null }}</td>
                            <!--<td>{{ $item->agent }}</td>-->
                            </td></td>
                            <td class="action_tooltip">
                                <a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{url('admin/agency/manage/user/data').'/'.$item->id}}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        @else
        <h2>Data Not Found</h2> 
        @endif

    </table>

</div>



<script>
//     $(document).ready(function() {
//     $('#carrier_table').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             {
//                 extend: 'csv',
//                 exportOptions: {
//                     columns: ':visible'
//                 }
//             },
//             'colvis'
//         ],
//         columnDefs: [ {
//             // targets: -2,
//             visible: false
//         } ]
//     } );
// } );
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