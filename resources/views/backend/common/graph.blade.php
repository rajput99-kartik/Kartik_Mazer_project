@php
    $user_loads_data = App\Models\Load::groupBy('load_state_origin')->select('load_state_origin', 
                                DB::raw('count(*) as total')          
                    )->get();
@endphp

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

{{-- this is working on dashboard  = Loads Report By Origin start --}}
<script>
    google.charts.load('current', {packages:['corechart','line']});
        google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Origin');
            data.addColumn('number', 'load');
            data.addRows([
                <?php 
                foreach($user_loads_data as $load){
                   if($load->total > 19){
                       echo "['$load->load_state_origin', $load->total],";
                   }
                }  
                ?>
            ]);

            var options = {
            title: 'Loads Report By Origin',
            // width: 830,
            height: 415,
            legend: 'none',
            bar: {groupWidth: '95%'},
            vAxis: { gridlines: { count: 40 } }
            
            };

            var chart = new google.visualization.LineChart(document.getElementById('number_format_chart'));
            chart.draw(data, options);
        };
</script>
{{-- this is working on dashboard  = Loads Report By Origin end --}}

<!--// Notworking start-->
<script>
    google.charts.load('current', {
    packages: ['corechart', 'line']
    });
    google.charts.setOnLoadCallback(drawLineColors);

    function drawLineColors() {
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'DATA');
    // data.addColumn('string', 'Origin');
    data.addColumn('number', 'loads')

    data.addRows([
        <?php 
            $i = 1;
        foreach($user_loads_data as $load){
            $a = ++$i;
         echo "[ $a, $load->total],";
        }  
        ?>
    ]);

    var options = {
        hAxis: {

        title: 'Time'
        },
        vAxis: {
        title: 'Load Of Origin'
        },
        colors: ['#a52714', '#097138']
        
    };
    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    }

</script>
<!--// Notworking end-->