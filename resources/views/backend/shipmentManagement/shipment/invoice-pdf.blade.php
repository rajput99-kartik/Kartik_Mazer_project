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
		<h2 class="heading">Invoice</h2>
		<div class="flex">
			<div class="company" style="float:left;">
			    <img src="{{url('/public/backend/assets/images/amb-logo.png')}}" style="width:100px; ">
				<div>
				    <pre style="color:#000; font-size:14px;">55 East Long Rd Suite no. 
457 Troy, MI, USA 48085
Phone: 888-538-6433
Fax: 
</pre>
				</div>
			</div>
			<div class="load" style="float:left; width:60%">
			    <table border="solid 1px #000" style="width:100%">
			        <tr>
			            <td class="head" style="width:100px"><b>Invoice #:</b></td>
			            <td>gffd453</td>
			        </tr>
			        <tr>
			            <td class="head" style="width:100px">Invoice Date: </td>
			            <td>28/12/2022</td>
			        </tr>
			        <tr>
			            <td class="head" style="width:100px">Terms: </td>
			            <td>Net 30</td>
			        </tr>
			        <tr>
			            <td class="head" style="width:100px">W/O (Ref): </td>
			            <td></td>
			        </tr>
			    </table>
			</div>
			
			<div class="flex" style="margin-top:30px;">
			    <div class="load" style="width:100%">
			        <p style="font-size:15px"><b>Bill To:</b></p>
			    </div>
			</div>
			
			<div class="flex" style="margin-top:30px;">
			    <div class="load" style="width:100%">
    			    <table style="width:100%">
    			        <tr style="background-color:#cccccc; font-size:16px;">
    			            <th>Load Details</th>
    			        </tr>
			    </table>
			    <p style="font-size:12px"><b>Load #: 2325</b></p>
			</div>
		</div>
		
		<div class="flex" style="margin-top:10px;">
		    <div class="load" style="width:100%">
			    <table style="width:100%; border:none" class="border-none">
			        <tr style="font-size:16px;">
			            <td><b>Shipper 1</b></td>
			            <td colspan="3">Savannah Ocean Termina Savannah, GA,</td>
			            <td><b>Date</b></td>
			            <td>28/12/2022</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Type</b></td>
			            <td></td>
			            <td><b>Quantity</b></td>
			            <td>dfdf</td>
			            <td><b>Weight</b></td>
			            <td>34</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Description</b></td>
			            <td colspan="4">55 East Long Rd Suite no.
                        457 Troy, MI, USA 48085
                        Phone: 888-538-6433
                        Fax:</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Purchase Order #</b></td>
			            <td colspan="4">5548085</td>
			        </tr>
		    </table>
		    
		    <table style="width:100%; border:none; background-color:#fff; margin:5px 0px" class="border-none">
			        <tr style="font-size:16px;">
			            <td><b>Consignee 1</b></td>
			            <td colspan="3">Savannah Ocean Termina Savannah, GA,</td>
			            <td><b>Date</b></td>
			            <td>28/12/2022</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Type</b></td>
			            <td></td>
			            <td><b>Quantity</b></td>
			            <td>dfdf</td>
			            <td><b>Weight</b></td>
			            <td>34</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Description</b></td>
			            <td colspan="4">55 East Long Rd Suite no.
                        457 Troy, MI, USA 48085
                        Phone: 888-538-6433
                        Fax:</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Purchase Order #</b></td>
			            <td colspan="4">5548085</td>
			        </tr>
		    </table>
		    
		    <table style="width:100%; border:none" class="border-none">
			        <tr style="font-size:16px;">
			            <td><b>Consignee 2</b></td>
			            <td colspan="3">Savannah Ocean Termina Savannah, GA,</td>
			            <td><b>Date</b></td>
			            <td>28/12/2022</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Type</b></td>
			            <td></td>
			            <td><b>Quantity</b></td>
			            <td>dfdf</td>
			            <td><b>Weight</b></td>
			            <td>34</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Description</b></td>
			            <td colspan="4">55 East Long Rd Suite no.
                        457 Troy, MI, USA 48085
                        Phone: 888-538-6433
                        Fax:</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Purchase Order #</b></td>
			            <td colspan="4">5548085</td>
			        </tr>
		    </table>
			</div>
			<p style="font-size:12px"><b>RATES AND CHANGES</b></p>
			
			<table style="width:100%; border:none; background-color:#fff; margin:5px 0px" class="border-none">
			        <tr style="font-size:16px;">
			            <td>Line Haul</td>
			            <td style="text-align:right;">$1,300.00</td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td colspan="2" style="padding:0px"><hr style="top:0"></td>
			        </tr>
			        <tr style="font-size:16px;">
			            <td><b>Total Rate</b></td>
			            <td style="text-align:right;"><b>$1,300.00</b></td>
			        </tr>
		    </table>
		</div>
	</div>
	
  </body>
</html>