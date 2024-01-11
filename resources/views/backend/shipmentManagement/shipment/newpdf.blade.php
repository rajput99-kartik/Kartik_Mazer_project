@php
										//dd($shipmentpick);

										// $shipbo =  App\Models\ShipmentBol::where('shipment_id',$shipmentData->id)->get();
										// dd($shipbo); 
									@endphp

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
							@php
								// dd($shipmentid);
								$shippdfpick = DB::table('shipment_lanes_picks')->where('shipment_id', $shipmentid )->get();
								$shippdfdrop = DB::table('shipment_lanes_drops')->where('shipment_id', $shipmentid )->get();
								$shipboldata = App\Models\ShipmentBol::where('shipment_id',$shipmentid)->get();
								//dd($shipboldata);
								$i = 1;
							@endphp
							<td>
								@foreach($shippdfpick as $pickdata)
								<pre><strong>{{$i++}}.</strong>{{ isset($pickdata->p_name) ? $pickdata->p_name : Null }} 
{{ isset($pickdata->p_address) ? $pickdata->p_address : Null }}
{{ isset($pickdata->p_city) ? $pickdata->p_city : Null }} {{ isset($pickdata->p_state) ? $pickdata->p_state : Null }} {{ isset($pickdata->p_zip) ? $pickdata->p_zip : Null }}
								</pre>
								@endforeach	
							</td>
							@php
								$j = 1;
							@endphp
							<td>
								@foreach($shippdfdrop as $dropdata)
								<pre><strong>{{$j++}}.</strong><?php if(!empty($dropdata->d_name)){ echo $dropdata->d_name; } ?> 
<?php if(!empty($dropdata->p_address)){ echo $dropdata->p_address; } ?> <?php if(!empty($dropdata->d_city)){ echo $dropdata->d_city.', '; } ?>  <?php if(!empty($dropdata->d_state)){ echo $dropdata->d_state.', '; } ?> <?php if(!empty($dropdata->d_zip)){ echo $dropdata->d_zip; } ?>
								</pre>
								@endforeach	
								
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
								<strong>MC NO.</strong>{{ strtoupper($shipmentData->shipment_c_mc) }}<br>
								<strong>DOT NO.</strong>{{ strtoupper($shipmentData->shipment_c_dot) }}<br>
								<strong>Tel: </strong>{{ strtoupper($shipmentData->shipment_c_phone) }}
								<strong>Email: </strong>{{ strtoupper($shipmentData->shipment_c_email) }}
									
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
                                                    
						// $shipboldata = App\Models\ShipmentBol::where('shipment_id',$shipmentData->id)->get();

						$shipboldata =  App\Models\ShipmentBolItem::where('shipment_id',$shipmentData->id)->get(); 
					  //  dd($shipboldata);
					  	$ofpieces = 0;
					  	$weight = 0;
						?>
						 @foreach ($shipboldata as $shibol)
						<tr>
							<td>{{ $shibol->ofpieces }}</td>
							<td>{{ $shibol->descriptions}}</td>
							<td>{{ $shibol->weight}}</td>
							<td>{{ $shibol->type}}</td>
							<td>{{ $shibol->nmfc}}</td>
							<td>{{ $shibol->hazmat}}</td>
							<td>{{ $shibol->productclass}}</td>
						</tr>
						@php
							$ofpieces+=  $shibol->ofpieces;
							$weight+=  $shibol->weight;
						@endphp
						@endforeach
						
						<tr>
							<td><strong>Total Pieces</strong> {{ $ofpieces}}</td>
							<td></td>
							<td><strong>Total Weight</strong> {{$weight}} LBS.</td>
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
									@foreach ($shipboldata as $shibol)
									{{ $shibol->notes}} 
									<strong><span style="margin-left: 2%;">...</span></strong><br><br>
									{{-- <strong><span style="margin-left: 30%;">Signature...</span></strong><br><br> --}}
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

			<div class="flex" style="margin-top:20px">
				
				<h2>Consignee Details & Signature</h2>
				<div class="load">
					<table style="width:100%">
						<tr style="background-color:#cccccc; font-size:16px;">
							<th>No of pieces </th>
							<th>Description</th>
							<th>Consignee</th>
							<th>Signature</th>
						</tr>
						<?php 
							$shipboldata =  App\Models\ShipmentBolItem::where('shipment_id',$shipmentData->id)->get(); 
							$ofpieces = 0;
							$weight = 0;
						?>
						 	@foreach ($shipboldata as $shibol)

								@php
								// dd($shibol);
								// $shipboldata =  App\Models\Shipmentdrop::where('id',$shibol['consignee'])->get(); 
									//dd($shipboldata);

									$dropad =   App\Models\Shipmentdrop::where('id',$shibol['consignee'])->first();

								@endphp
								<tr>
									<td>{{ $shibol->ofpieces }}</td>
									<td>{{ $shibol->descriptions}}</td>
									<td>{{isset($dropad['d_name']) ? $dropad['d_name']: null}}</td>
									
									<td></td>
								</tr>
							@endforeach
						
							
							
						</table>
					</div>
				</div>
			</div>
			
		</body>
		</html>