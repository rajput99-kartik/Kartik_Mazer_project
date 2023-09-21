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
		  font-family: Arial;
		}
		h2.heading {
			background-color: #0273bf;
			text-align: center;
			color: #fff;
			padding: 12px;
			border-radius: 4px;
		}
		.flex {
			display: flex;
			align-items: center;
			border-bottom: solid 1px #00000026;
		}
		.logo img {
			width: 160px;
		}
		.logo {
			width: 50%;
			text-align: right;
		}
		.company {
			width: 50%;
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
	</style>
  </head>
  <body>
    <div class="header">
		<h2 class="heading">Rate & Load Confirmation</h2>
		<div class="flex">
			<div class="company">
				<b>AMB Logistic</b>
				<pre>55 East Long Rd Suite no. 457
Troy, MI, USA 48085
Phone: 888-538-6433
Fax: 
</pre>
			</div>
			<div class="logo" style="float:right;margin-top:-130px">
				<img src="{{url('/public/backend/assets/images/logo-icon.png')}}">
			</div>
		</div>
	</div>
	<div class="main">
		<table id="customers">
		  <tr>
			<td>Dispatcher</td>
			<td>{{ $user->name }}</td>
			<td><b>LOAD #</b></td>
			<td>{{ $shipmentData->id }}</td>
		  </tr>
		  <tr>
			<td>Phone #:</td>
			<td>313-432-7848 x484</td>
			<td>Ship Date:</td>
			<td>{{ $todaydate }}</td>
		  </tr>
		  <tr>
			<td>Fax #: </td>
			<td></td>
			<td>Today's Date:</td>
			<td>{{ $todaydate }}</td>
		  </tr>
		  <tr>
			<td>Email:</td>
			<td colspan="3">{{ $user->email }}</td>
		  </tr>
		  <tr>
			<td>W/O:</td>
			<td colspan="3"></td>
		  </tr>
		</table>
		<h4>Carrier Details</h4>
		<table id="customers">
		  <tr>
			<th>Carrier</th>
			<th>Phone # </th>
			<th>Fax #</th>
			<th>Equipment</th>
			<th>Load Status</th>
		  </tr>
		  <tr>
			<td>{{ isset($carriersData->c_company_name) ? $carriersData->c_company_name : null }} </td>
			<td>{{ isset($carriersData->phone_no) ? $carriersData->phone_no : null }}</td>
			<td>{{ isset($carriersData->carrier_fax) ? $carriersData->carrier_fax : null }}</td>
			<td>{{ isset($shipmentData->equipment_loads) ? $shipmentData->equipment_loads : null }} </td>
			<td>{{ isset($shipmentData->shipment_statue) ? $shipmentData->shipment_statue : null }}</td>
		  </tr>
		</table>
		
		<table id="customers" class="border-none" style="margin-top:20px;">
		  <tr>
			<td width="35%">
				
				@php
				$i = 1;
				@endphp
			@foreach($shipmentpick as $pickdata)
			<h6>Shipper {{$i++}}</h6>
				<pre>{{ isset($pickdata['p_name']) ? $pickdata['p_name'] : null }}<br>
{{ isset($pickdata['p_address']) ? $pickdata['p_address'] : null }}<br>
{{ isset($pickdata['p_city']) ? $pickdata['p_city'] : null }} {{ isset($pickdata['p_state']) ? $pickdata['p_state'] : null }} {{ isset($pickdata['p_zip']) ? $pickdata['p_zip'] : null }}
</pre>
			</td>
			<td width="25%">
				<p><b>Date:</b> {{ isset($pickdata->p_ready) ? $pickdata->p_ready : null }}</p>
				<p><b>Time:</b> {{ isset($pickdata->p_rtime) ? $pickdata->p_rtime : null }}</p>
				<p><b>Type:</b> {{ isset($pickdata->full_partial) ? $pickdata->full_partial : null }}</p>
				<p><b>Quantity:</b> </p>
				<p><b>Weight:</b> {{ isset($pickdata->weight_loads) ? $pickdata->weight_loads : null }} </p>
			</td>
			<td width="40%">
				<p><b>Major Intersection:</b> </p>
				<p><b>Shipping Hours:</b> {{ isset($pickdata->p_rtime) ? $pickdata->p_rtime : null }} </p>
				<p><b>Appointment:</b> {{ isset($pickdata->p_appt_note) ? $pickdata->p_appt_note : null }}</p>
				
			</td>
		  </tr>
	@endforeach	  
		  
		  <tr>
			<td></td>
			<td colspan="2"><p><b>Notes:</b> {{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : null }}</p></td>
			<td></td>
		  </tr>
		</table>
		
		
		<table id="customers" class="border-none" style="margin-top:20px;">
	
		<tr>
			<td width="35%">
				
				@php
				$j = 1;
				@endphp
	@foreach($shipmentdrop as $dropdata)
	<h6>Consignee {{$j++}}</h6>
				<pre><?php if(!empty($dropdata->d_name)){ echo $dropdata->d_name; } ?></br>
<?php if(!empty($dropdata->p_address)){ echo $dropdata->p_address; } ?>
<?php if(!empty($dropdata->d_city)){ echo $dropdata->d_city.', '; } ?> <?php if(!empty($dropdata->d_state)){ echo $dropdata->d_state.', '; } ?> <?php if(!empty($dropdata->d_zip)){ echo $dropdata->d_zip; } ?>
</pre>
			</td>
			<td width="25%">
				<p><b>Date:</b> <?php if(!empty($dropdata->d_ready)){ echo $dropdata->d_ready; } ?></p>
				<p><b>Time:</b> <?php if(!empty($dropdata->d_rtime)){ echo $dropdata->d_rtime; } ?></p>
				<p><b>Type:</b> <?php if(!empty($dropdata->full_partial)){ echo $dropdata->full_partial; } ?></p>
				<p><b>Quantity:</b> </p>
				<p><b>Weight:</b> <?php if(!empty($dropdata->weight_loads)){ echo $dropdata->weight_loads.' lbs'; } ?></p>
			</td>
			<td width="40%">
				<p><b>Major Intersection:</b> </p>
				<p><b>Shipping Hours:</b> {{ isset($dropdata->d_rtime) ? $dropdata->d_rtime :  null }} </p>
				<p><b>Appointment:</b> {{ isset($dropdata->d_appt_note) ? $dropdata->d_appt_note : null }} </p>
				
			</td>
		  </tr>
	@endforeach	  
	
	
		  <tr>
			<td></td>
			<td colspan="2"><p><b>Notes:</b> {{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : null }} </p></td>
			<td></td>
		  </tr>
		</table>
	</div>
	<div class="footer">
		<p><h4>Carrier Pay:</h4> <b>Line Haul:</b> <?php if(!empty($shipmentrate->lh_carrier)){ echo '$'.$shipmentrate->lh_carrier.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul1)){  echo '<b>'. $shipmentrate->line_haul1 .':</b> $'.$shipmentrate->carrier1.', '; } ?>			
										  <?php if(!empty($shipmentrate->line_haul2)){ echo '<b>'.$shipmentrate->line_haul2 .':</b> $'.$shipmentrate->carrier2.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul3)){ echo '<b>'.$shipmentrate->line_haul3 .':</b> $'.$shipmentrate->carrier3.', '; } ?>
										  <?php if(!empty($shipmentrate->line_haul4)){ echo '<b>'.$shipmentrate->line_haul4 .':</b> $'.$shipmentrate->carrier4; } ?>
										  <?php if(!empty($shipmentrate->line_haul5)){ echo '<b>'.$shipmentrate->line_haul5 .':</b> $'.$shipmentrate->carrier5; } ?>
										  <?php if(!empty($shipmentrate->line_haul6)){ echo '<b>'.$shipmentrate->line_haul6 .':</b> $'.$shipmentrate->carrier6; } ?>
										  <b>TOTAL: <?php if(!empty($shipmentrate->carrier_total)){ echo '$'.$shipmentrate->carrier_total; } ?></b>
		</p>
	</div>
  </body>
</html>