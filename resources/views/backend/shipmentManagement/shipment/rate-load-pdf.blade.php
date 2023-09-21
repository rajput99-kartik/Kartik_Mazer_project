<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Rate & Load Confirmation</title>
    
	<style>
		body {
		  position: relative;
		  width: 21cm;  
		  height: 29.7cm; 
		  margin: 0 auto; 
		  color: #001028;
		  background: #FFFFFF; 
		  font-family: Arial, sans-serif; 
		  font-size: 12px; 
		  font-family: sans-serif !important;
		}
		table, td, th {  
          border: 1px solid #0000002e;
          text-align: left;
        }
        .head, th{
            background-color:#fafafa;
        }
        table {
          border-collapse: collapse;
          width: 100%;
        }
        table.border-none{
            border-collapse: unset;
            background-color:#fafafa;
        }
        table.border-none td{
            padding:2px;
        }
		h2.heading {
			text-align: center;
			margin-bottom:30px;
			font-family: sans-serif !important;
		}
		.flex {
			display: flex;
			align-items: center;
			clear:both;
		}
		.logo img {
			width: 160px;
		}
		.logo {
			width: 50%;
			text-align: right;
		}
		.company {
			width: 40%;
			text-align: left;
		}
		#customers {
		  font-family: Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		#customers td, #customers th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		#customers tr:nth-child(even){background-color: #f2f2f2;}

		#customers tr:hover {background-color: #ddd;}
		table h6 {
			font-size: 18px;
			margin: 0px;
		}
		h4 {
			font-size: 22px;
			color: #0273bf;
		}
		table.border-none td {
            border: none !important;
        }
        table.border-none {
            border: solid 1px #0000001f;
        }
        td{
            padding:5px 8px;
            height:20px;
            font-size:13px;
        }
        th{
            text-align:center;
            padding:4px 5px;
            font-size:13px;
        }
        hr {
            position: relative;
            top: 12px;
            border: none;
            height: 1px;
            background: black;
        }
	</style>
  </head>
  <body>
    <div class="header">
		<h2 class="heading">Rate & Load Confirmation</h2>
		<div class="flex">
			<div class="company" style="float:left;">
			    <img src="{{url('/public/backend/assets/images/amb-logo.png')}}" style="width:100px; ">
				<div>
				    <pre style="color:#000; font-size:14px;">55 East Long Rd Suite no. 
457 Troy, MI, USA 48085
Phone: 888-538-6433
Fax: 32678
</pre>
				</div>
			</div>
			<div class="load" style="float:left; width:60%">
			    <table border="solid 1px #000" style="width:100%">
			        <tr>
			            <td class="head" style="width:60px">Dispatcher:</td>
			            {{-- <td>{{ isset($user->name) ? $user->name : null }}</td> --}}
						<td>{{ isset($shipmentData->shipment_c_dispatcher) ? $shipmentData->shipment_c_dispatcher : null }}</td>
			            <td class="head"><b>LOAD #</b></td>
			            <td>{{ $shipmentData->id }}</td>
			        </tr>
			        <tr>
			            <td class="head" style="width:60px">Phone #: </td>
			            <td>{{ isset($shipmentData->shipment_c_phone) ? $shipmentData->shipment_c_phone : null }}</td>
			            <td class="head">Pickup Date:</td>
			            <td>
							@php
								$ship_pick = App\Models\Shipmentpick::where('shipment_id',$shipmentData->id)->orderBy('manage_order','DESC')->first();
							@endphp
							{{ isset($ship_pick->p_ready) ? $ship_pick->p_ready : null }}
						</td>
			        </tr>
			        <tr>
			            <td class="head" style="width:60px">Fax #:</td>
			            <td></td>
			            <td class="head">Today's Date:</td>
			            <td>{{ $todaydate }}</td>
			        </tr>
			       
			        <tr>
			            <td class="head" style="width:60px">W/O:</td>
			            <td colspan="1"></td>
						<td class="head">Shipment Ref #</td>
			            <td>{{ $shipmentData->ref_loads }}</td>
			        </tr>
					<tr>
			            <td class="head" style="width:60px">Email:</td>
			            <td colspan="3">{{ isset($shipmentData->shipment_c_email) ? $shipmentData->shipment_c_email : null }}</td>
			        </tr>
			    </table>
			</div>
			
			<div class="flex" style="margin-top:30px;">
			    <div class="load" style="width:100%">
    			    <table style="width:100%">
    			        <tr style="background-color:#cccccc; font-size:16px;">
    			            <th>Carrier</th>
    			            <th>Phone #</th>
    			            <th>Fax #</th>
    			            <th>Equipment</th>
    			            <th>Agreed Amount</th>
    			            <th>Load Status</th>
    			        </tr>
    			        <tr>
						<td>{{ isset($carriersData->c_company_name) ? $carriersData->c_company_name : null }} </td>
						<td>{{ isset($carriersData->phone_no) ? $carriersData->phone_no : null }}</td>
						<td>{{ isset($carriersData->carrier_fax) ? $carriersData->carrier_fax : null }}</td>
						<td>{{ isset($shipmentData->equipment_loads) ? $shipmentData->equipment_loads : null }} </td>
						<td><?php if(!empty($shipmentrate->carrier_total)){ echo '$'.$shipmentrate->carrier_total; } ?></td>
						<td>{{ isset($shipmentData->shipment_statue) ? $shipmentData->shipment_statue : null }}</td>
    			        </tr>
			    </table>
			</div>
		</div>
		
		<div class="flex" style="margin-top:30px;">
			    <div class="load">
    			    <table style="width:100%" class="border-none">
    			        <tr>
    			            <td rowspan="5" valign="top" style="width:200px">
							 @php
							 $i = 1;
							 @endphp
								@foreach($shipmentpick as $pickdata)
									{{-- <h6>Shipper {{$i++}}</h6> --}}
									<h6>Pickup Address</h6>
									{{ isset($pickdata['p_name']) ? $pickdata['p_name'] : null }}<br>
									{{ isset($pickdata['p_address']) ? $pickdata['p_address'] : null }}<br>
									{{ isset($pickdata['p_city']) ? $pickdata['p_city'] : null }}<br>
									{{ isset($pickdata['p_state']) ? $pickdata['p_state'] : null }}<br>
									{{ isset($pickdata['p_zip']) ? $pickdata['p_zip'] : null }}
								
    			            </td>
    			            <td><b>Date:</b> </td>
    			            <td>{{ isset($pickdata->p_ready) ? $pickdata->p_ready : null }}</td>
    			            <td><b>Purchase Order #:</b> </td>
    			            <td>{{ isset($pickdata->p_ref) ? $pickdata->p_ref : null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Time:</b> </td>
    			            <td>{{ isset($pickdata->p_rtime) ? $pickdata->p_rtime : null }}</td>
    			            <td><b>Major Intersection:</b> </td>
    			            <td></td>
    			        </tr>
    			        <tr>
    			            <td><b>Load Type:</b></td>
    			            <td>{{ isset($shipmentData->full_partial) ? $shipmentData->full_partial : null }}</td>
    			            <td><b>Receiving Hours:</b> </td>
    			            <td>{{ isset($pickdata->p_rtime) ? $pickdata->p_rtime : null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Quantity:</b> </td>
    			            <td>{{ isset($shipmentData->pieces_laod) ? $shipmentData->pieces_laod : null }}</td>
    			            <td><b>Appointment:</b> </td>
    			            <td>{{ isset($pickdata->p_appt_note) ? $pickdata->p_appt_note : null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Weight:</b> </td>
    			            <td>{{ isset($shipmentData->weight_loads) ? $shipmentData->weight_loads : null }}</td>
    			            <td valign="top"><b>Description:</b> </td>
    			            <td style="width:150px;">{{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : null }}
                            </td>
    			        </tr>
					@endforeach	 
			    </table>
			</div>
		</div>
		
		<div class="flex" style="margin-top:30px;">
			    <div class="load">
    			    <table style="width:100%" class="border-none">
    			        <tr>
    			            <td rowspan="5" valign="top" style="width:200px">
							@php
							$j = 1;
							@endphp
							@foreach($shipmentdrop as $dropdata)
							{{-- <h6>Consignee {{$j++}}</h6> --}}
							<h6>Drop Address</h6>
										<?php if(!empty($dropdata->d_name)){ echo $dropdata->d_name; } ?></br>
										<?php if(!empty($dropdata->p_address)){ echo $dropdata->p_address; } ?></br>
										<?php if(!empty($dropdata->d_city)){ echo $dropdata->d_city; } ?> </br>
										<?php if(!empty($dropdata->d_state)){ echo $dropdata->d_state; } ?> </br>
										<?php if(!empty($dropdata->d_zip)){ echo $dropdata->d_zip; } ?>
							
    			            </td>
    			            <td><b>Date:</b> </td>
    			            <td><?php if(!empty($dropdata->d_ready)){ echo $dropdata->d_ready; } ?></td>
    			            <td><b>Purchase Order #:</b> </td>
    			            <td>{{ isset($dropdata->d_ref) ? $dropdata->d_ref : null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Time:</b> </td>
    			            <td><?php if(!empty($dropdata->d_rtime)){ echo $dropdata->d_rtime; } ?></td>
    			            <td><b>Major Intersection:</b> </td>
    			            <td></td>
    			        </tr>
    			        <tr>
    			            <td><b>Load Type:</b> </td>
    			            <td>{{ isset($shipmentData->full_partial) ? $shipmentData->full_partial : null }}</td>
    			            <td><b>Receiving Hours:</b> </td>
    			            <td>{{ isset($dropdata->d_rtime) ? $dropdata->d_rtime :  null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Quantity:</b> </td>
    			            <td>{{ isset($shipmentData->pieces_laod) ? $shipmentData->pieces_laod : null }}</td>
    			            <td><b>Appointment:</b> </td>
    			            <td>{{ isset($dropdata->d_appt_note) ? $dropdata->d_appt_note : null }}</td>
    			        </tr>
    			        <tr>
    			            <td><b>Weight:</b> </td>
    			            <td>{{ isset($shipmentData->weight_loads) ? $shipmentData->weight_loads : null }}</td>
    			            <td valign="top"><b>Description:</b> </td>
    			            <td style="width:150px;">{{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : null }}
                            </td>
    			        </tr>
					@endforeach	  
			    </table>
			</div>
		</div>
		
		<div class="flex" style="margin-top:30px;">
		    <div class="load">
		        <p style="font-size:14px">
				<b>Carrier Pay:</b>
							   Line Haul: <?php if(!empty($shipmentrate->lh_carrier)){ echo '$'.$shipmentrate->lh_carrier.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul1)){  echo '<b>'. $shipmentrate->line_haul1 .':</b> $'.$shipmentrate->carrier1.', '; } ?>			
										  <?php if(!empty($shipmentrate->line_haul2)){ echo '<b>'.$shipmentrate->line_haul2 .':</b> $'.$shipmentrate->carrier2.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul3)){ echo '<b>'.$shipmentrate->line_haul3 .':</b> $'.$shipmentrate->carrier3.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul4)){ echo '<b>'.$shipmentrate->line_haul4 .':</b> $'.$shipmentrate->carrier4; } ?>
										  <?php if(!empty($shipmentrate->line_haul5)){ echo '<b>'.$shipmentrate->line_haul5 .':</b> $'.$shipmentrate->carrier5; } ?>
										  <?php if(!empty($shipmentrate->line_haul6)){ echo '<b>'.$shipmentrate->line_haul6 .':</b> $'.$shipmentrate->carrier6; } ?>
										  <b>TOTAL: <?php if(!empty($shipmentrate->carrier_total)){ echo '$'.$shipmentrate->carrier_total; } ?></b>
										</p>
		    </div>
		</div>
		
		<div class="flex" style="margin-top:30px;">
			    <div class="load">
    			    <table style="width:100%; background:none; border:none" class="border-none">
    			        <tr>
    			            <td style="width:90px"><b>Accepted By:</b> </td>
    			            <td><hr></td>
    			            <td style="width:40px"><b>Date:</b> </td>
    			            <td><hr></td>
    			            <td style="width:70px"><b>Signature:</b> </td>
    			            <td><hr></td>
    			        </tr>
			    </table>
			</div>
		</div>
		
		<div class="flex" style="margin-top:20px;">
		    <div class="load">
			    <table style="width:100%; background:none; border:none" class="border-none">
			        <tr>
			            <td style="width:90px"><b>Driver Name:</b> </td>
			            <td style="width:200px"> {{ isset($shipmentData->shipment_c_driver_n) ? $shipmentData->shipment_c_driver_n : null }}<hr></td>
			            <td style="width:70px"><b>Cell #:</b> </td>
			            <td style="width:200px">{{ isset($shipmentData->shipment_c_driver_p) ? $shipmentData->shipment_c_driver_p : null }}<hr></td>
			            <td style="width:60px"><b>Truck #:</b> </td>
			            <td><hr></td>
			            <td style="width:6	0px"><b>Trailer #:</b> </td>
			            <td><hr></td>
			        </tr>
			    </table>
			</div>
		</div>
	</div>
	
  </body>
</html>