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
			border: 1px solid #000;
			text-align: left;
		}
		
		table {
			border-collapse: collapse;
			width: 100%;
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
			width: 60%;
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
			padding:2px 5px;
			height:20px;
			font-size:13px;
		}
		th{
			text-align:left;
			padding:2px 5px;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2 class="heading">Bill Of Lading</h2>
		<div class="flex">
			<div class="company" style="float:left;">
				<img src="{{url('/public/backend/assets/images/amb-logo.png')}}" style="width:100px; ">
				<div>
					<pre style="color:#000; font-size:14px;">101 W Big Beaver Rd Suite 1400,
						Troy, MI 48084,USA
						Phone: 888-538-6433
						Fax: (586) 797-9679
					</pre>
				</div>
			</div>
			<div class="load" style="float:left; width:40%">
				<table style="width:100%">


					{{-- {{ dd($shipmentData); }} --}}
					<tr>
						<td>Load Number</td>
						<td>{{ $shipmentData->id }}</td>
					</tr>
					<tr>
						<td>Bol Number</td>
						<td>N/A</td>
					</tr>
					<tr>
						<td>Ship Date</td>
						<td>{{ $shipmentData->pickready }}</td>
					</tr>
					<tr>
						<td>Delivery Date</td>
						<td>{{ $shipmentData->dropready }}</td>
					</tr>
					
					<tr>
						<td>P.O. Number</td>
						<td></td>
					</tr>
					<tr>
						<td>Freight Charges</td>
						<td>Prepaid</td>
					</tr>
				</table>
			</div>
			
			<div class="flex" style="margin-top:30px;">
				<div class="load" style="width:100%">
					<table style="width:100%">
						<tr style="background-color:#cccccc; font-size:16px;">
							<th>Shipper</th>
							<th>Consignee</th>
						</tr>
						<tr>
							<td>
								
								<pre>{{ isset($shipmentpick->p_name) ? $shipmentpick->p_name : null }}<br>
{{ isset($shipmentpick->p_address) ? $shipmentpick->p_address : null }}<br>
{{ isset($shipmentpick->p_city) ? $shipmentpick->p_city : null }} <br>
{{ isset($shipmentpick->p_state) ? $shipmentpick->p_state : null }} <br>
{{ isset($shipmentpick->p_zip) ? $shipmentpick->p_zip : null }}
								</pre>
                               
							</td>
							<td>
								<pre><?php if(!empty($shipmentdrop->d_name)){ echo $shipmentdrop->d_name; } ?>
<?php if(!empty($shipmentdrop->p_address)){ echo $shipmentdrop->p_address; } ?><br>
<?php if(!empty($shipmentdrop->d_city)){ echo $shipmentdrop->d_city.', '; } ?><br>
<?php if(!empty($shipmentdrop->d_state)){ echo $shipmentdrop->d_state.', '; } ?> <br>
<?php if(!empty($shipmentdrop->d_zip)){ echo $shipmentdrop->d_zip; } ?>
								</pre>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="flex" style="margin-top:30px;">
				<div class="load">
					<table style="width:100%">
						<tr style="background-color:#cccccc; font-size:16px;">
							<th>3rd Party Billing</th>
							<th>Transportation Company</th>
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								{{ strtoupper($shipmentData->shipment_c_carrier) }}<br>
								<strong>MC NO. </strong>{{ strtoupper($shipmentData->shipment_c_mc) }}<br>
								<strong>DOT NO. </strong>{{ strtoupper($shipmentData->shipment_c_dot) }}<br>
								<strong>Tel: </strong>{{ strtoupper($shipmentData->shipment_c_phone) }}
								{{-- <strong>Email: </strong>{{ strtoupper($shipmentData->shipment_c_email) }} --}}
									
							</td>
						</tr>
					</table>
				</div>
			</div>
			
			<div class="flex" style="margin-top:30px;">
				<div class="load">
					<table style="width:100%">
						<tr style="background-color:#cccccc; font-size:16px;">
							<th>No of pieces </th>
							<th>Description of the goods, marks, exceptions</th>
							<th>Weight in LBS.</th>
							<th>Type</th>
							<th>NMFC</th>
							<th>HM</th>
							<th>Class</th>
						</tr>
						<?php 
							$shibol =  App\Models\ShipmentBolItem::where('shipment_bolid',$shipmentid->id)->get();
							$ofpieces = 0;
						?>
						 @foreach ($shibol as $item)
						<tr>
							<td class="copy-text">{{ isset($item['ofpieces']) ? $item['ofpieces'] :Null  }}</td>
							<td class="copy-text">{{ isset($item['descriptions']) ? $item['descriptions'] :Null }}</td>
							<td class="copy-text">{{ isset($item['weight']) ? $item['weight'] :Null }}</td>
							<td class="copy-text">{{ isset($item['type']) ? $item['type'] :Null }}</td>
							<td class="copy-text">{{isset($item['nmfc']) ? $item['nmfc'] :Null }}</td>
							<td class="copy-text">{{ isset($item['hazmat']) ? $item['hazmat'] :Null }}</td>
							<td class="copy-text">{{ isset($item['productclass']) ? $item['productclass'] :Null }}</td>
						</tr>

							@php
								
								$ofpieces +=  $item['ofpieces'];
							@endphp
						@endforeach
						

						<tr>
							<td> <strong>Total Pieces :</strong> {{$ofpieces}}</td>
							<td></td>
							<td>Total Weight
								0 LBS.</td>
								<td colspan="4">Emergency Response Phone</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="flex" style="margin-top:30px;">
					<div class="load">
						<table style="width:100%">
							
							<tr>
								<td rowspan="4" style="width:60%">Note:
									@foreach ($shibol as $item)
									{{ $item->notes}} <br>
									@endforeach
								</td>
								<td>C.O.D. Amount: $0.00</td>
							</tr>
							<tr>
								<td>C.O.D. Fee: Prepaid</td>
							</tr>
							<tr>
								<td>Declared Value: $0.00</td>
							</tr>
							<tr>
								<td>If at consignor's risk, write or stamp here</td>
							</tr>
							
						</table>
					</div>
				</div>
				
				<div class="flex" style="margin-top:30px;">
					<div class="load">
						<table style="width:100%">
							<tr>
								<td>Shipper</td>
								<td>Carrier</td>
								<td>Date</td>
								<td rowspan="2" style="width:30%">Number Of Pieces Received</td>
							</tr>
							<tr>
								<td>Per</td>
								<td>Per</td>
								<td>Time</td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="flex" style="margin-top:30px;">
					<div class="load">
						<table style="width:100%">
							<tr>
								<td>Consignee Name</td>
								<td>Date</td>
								<td>Signature</td>
								<td style="width:30%">Number Of Pieces Received</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			
		</body>
		</html>