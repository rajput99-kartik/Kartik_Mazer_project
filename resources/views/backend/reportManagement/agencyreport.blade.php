

                


                <div id="carrier_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
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
                                    $ee = '';

                                    $acb = 0;
                                    //$cnt = count($i); 
                                @endphp

                                @foreach($data as $agencie)
                                    @foreach($agencie['office'] as $dataag)
                                        @php
                                            $idi = $dataag->user_id;
                                            $item = App\Models\User::where('id',$idi)->first();

                                           $ee = $item->user_type == 'officer' ;
                                        @endphp


                                        @if($item->user_type == 'officer')                                    
                                            <tr>
                                                @php
                                                    $acb++ ;
                                                @endphp
                                                  
                                                <td>{{ $i++; }}</td>
                                                <td>{{  isset( $item->name) ? $item->name : Null}}</td>
                                                <td>{{ isset($item->email) ? $item->email : Null  }}</td>
                                                <td>{{ isset($item->officerid) ? $item->officerid : Null }}</td>
                                                <td>{{ isset($item->created_at) ? $item->created_at : Null }}</td>
                                                <td class="action_tooltip">
                                                    <a href="{{url('admin/agency/manage/user/data').'/'.$item->id}}" target="_blank" class="btn btn-outline-info btn-sm radius-30 px-4"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
				</div>



                



                

{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
<script>


    $(document).ready(function () {
        // Create DataTable
        var table = $('#carrier_table').DataTable({
            dom: 'Pfrtip',
        });
     
        // Create the chart with initial data
        var container = $('<div/>').insertBefore(table.table().container());
     
        var chart = Highcharts.chart(container[1], {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Agency Report',
            },
            series: [
                {
                    data: chartData(table),
                },
            ],
        });
     
        // On each draw, update the data in the chart
        table.on('draw', function () {
            chart.series[1].setData(chartData(table));
        });
    });
     
    function chartData(table) {
        var counts = {};
     
        // Count the number of entries for each position
        table
            .column(2, { search: 'applied' })
            .data()
            .each(function (val) {
                if (counts[val]) {
                    counts[val] += 1;
                } else {
                    counts[val] = 1;
                }
            });
     
        // And map it to the format highcharts uses
        return $.map(counts, function (val, key) {
            return {
                name: key,
                y: val,
            };
        });
    }
</script>
                        