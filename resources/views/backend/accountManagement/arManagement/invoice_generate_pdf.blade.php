<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Customer Invoice</title>
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
		<h2 class="heading">Customer Invoice</h2>
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
				<img src="https://crmonline.co.in/public/backend/assets/images/logo-icon.png">
			</div>
		</div>
	</div>
	<div class="main">
		<table id="customers">
		  <tr>
			<td>Dispatcher</td>
			<td>
                @foreach($shipments as $ship_data)
                
                    @foreach($ship_data->UserDetail as $asdata)
                    {{ ucwords($asdata['name'])}}
                    @endforeach
                @endforeach
            </td>
			<td><b>LOAD #</b></td>
			<td> @foreach($shipments as $ship_data) {{ $ship_data['id'] }} @endforeach</td>
		  </tr>
		  <tr>
			<td>Phone #:</td>
			<td>
                @foreach($shipments as $ship_data)
                    @foreach($ship_data->UserDetail as $asdata)
                        {{ $asdata['phone'] }}, {{ $asdata['ext'] }}
                    @endforeach
                @endforeach
            </td>
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
			<td colspan="3">
                @foreach($shipments as $ship_data)
                    @foreach($ship_data->UserDetail as $asdata)
                        {{ $asdata['email'] }}
                    @endforeach
                @endforeach
            </td>
		  </tr>
		  <tr>
			<td>W/O:</td>
			<td colspan="3"></td>
		  </tr>
		</table>
		<h4>Customer Details</h4>
		<table id="customers">
		  <tr>
			<th>Name</th>
			<th>Phone # </th>
			<th>Fax #</th>
			<th>Address</th>
			<th></th>
		  </tr>
		  <tr>
			<td>
                @foreach($shipments as $ship_data)
                        {{ $ship_data->companyDetail['company_name'] }}
                @endforeach
            </td>
			<td>
                @foreach($shipments as $ship_data)
                        {{ $ship_data->companyDetail['phone_number'] }}
                @endforeach
            </td>
			<td>
                
            </td>
			<td>@foreach($shipments as $ship_data)
                        {{ $ship_data->companyDetail['address'] }}, {{ $ship_data->companyDetail['shipper_city'] }}
                @endforeach
            </td>
			<td></td>
		  </tr>
		</table>
		
		<table id="customers" class="border-none" style="margin-top:20px;">
		  <tr>
			<td width="35%">
				<h6>Shipper</h6>
				<pre>
</pre>
			</td>
			<td width="25%">
				<p><b>Date:</b> </p>
				<p><b>Time:</b> </p>
				<p><b>Type:</b> </p>
				<p><b>Quantity:</b> </p>
				<p><b>Weight:</b>  </p>
			</td>
			<td width="40%">
				<p><b>Major Intersection:</b> </p>
				<p><b>Shipping Hours:</b> </p>
				<p><b>Appointment:</b> </p>
				
			</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="2"><p><b>Notes:</b> </p></td>
			<td></td>
		  </tr>
		</table>
		
		<table id="customers" class="border-none" style="margin-top:20px;">
		  <tr>
			<td width="35%">
				<h6>Consignee</h6>
				<pre>
</pre>
			</td>
			<td width="25%">
				<p><b>Date:</b> </p>
				<p><b>Time:</b> </p>
				<p><b>Type:</b> </p>
				<p><b>Quantity:</b> </p>
				<p><b>Weight:</b> </p>
			</td>
			<td width="40%">
				<p><b>Major Intersection:</b> </p>
				<p><b>Shipping Hours:</b></p>
				<p><b>Appointment:</b> </p>
				
			</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="2"><p><b>Notes:</b> @foreach($shipments as $ship_data) {{ $ship_data['shipment_shipper_instruction'] }} @endforeach</p></td>
			<td></td>
		  </tr>
		</table>
	</div>
	<div class="footer">
		<p><b>Customer Pay:</b> Line Haul: @foreach($shipments as $key => $ship_data) {{ '$'.$ship_data->shipmentPrice[$key]['lh_customer'] }} @endforeach <b>TOTAL: @foreach($shipments as $key => $ship_data) {{ '$'.$ship_data->shipmentPrice[$key]['customer_total'] }} @endforeach</b></p>
	</div>
  </body>
</html>