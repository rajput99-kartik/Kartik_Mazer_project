
<style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    p {
        margin: 0pt;
    }

    table.items {
        border: 0.1mm solid #e7e7e7;
    }

    td {
        vertical-align: top;
    }

    .items td {
        border-left: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    table thead td {
        text-align: center;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #e7e7e7;
        background-color: #FFFFFF;
        border: 0mm none #e7e7e7;
        border-top: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    .items td.totals {
        text-align: right;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.cost {
        text-align: "."center;
    }
	table {
  border-spacing: 0px;
}
    </style>


<table width="100%" style="font-family: sans-serif;" cellpadding="0">
	<tr>
		<td width="49%" style="border:none;">
		<img src="<?php echo url('/img/logo-new.jpg'); ?>" width="270" height="110" alt="Logo" align="center" border="0">
	    </td>
		<td width="2%">&nbsp;</td>
		<td width="49%" style="text-align: right;" cellpadding="0">
		<table width="100%" align="right" style="font-family: sans-serif; font-size: 14px; margin-top: 10px;"  cellpadding="0">
			<tr>
				<td width="100%" style="text-align: right; font-size: 25px; font-weight: bold; padding: 0px;">
				<b>Rate Confirmation</b>
				</td>
			</tr>
				<tr>
					<td style="padding: 8px 0px 0px 1px; line-height: 20px;text-align: right;font-size: 20px; font-weight: bold;"><strong>Load Number #<?php echo $shipmentData->id; ?></strong></td>
					
				</tr>
				<tr>
				
					<td style="padding: 0px 0px 0px 1px;font-size: 16px; line-height: 20px;text-align: right;">Created Date <?php echo $todaydate; ?></td>
				</tr>
			</table>
	    </td>
	</tr>
</table>

<table width="100%" style="font-family: sans-serif; font-size: 14px; margin-top: 10px;" cellpadding="0">
	<tr>
		<td>
			<table width="100%" align="left" style="font-family: sans-serif; font-size: 14px;" cellpadding="0">
				<tr>
				<td style="padding: 0px; line-height: 0px;">&nbsp;</td>
					<strong>8 THE GRN SITE B Dover, DE19901 <br>MC#: 1228885 P: 385-381-0007 Web: www.adroitlogisticsus.com</strong>
				</tr>
			</table>
			
		</td>
	</tr>
</table>
<table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;margin-top: 10px;" cellpadding="8">
	<thead>
		<tr>
			<td width="25%" style="text-align: left;background-color:#8f8f8f;"><strong>Carrier </strong></td>
			<td width="20%" style="text-align: left;background-color:#8f8f8f;"><strong>Email</strong></td>
			<td width="15%" style="text-align: left;background-color:#8f8f8f;"><strong>Phone</strong></td>
			<td width="10%" style="text-align: left;background-color:#8f8f8f;"><strong>MC#</strong></td>
			<td width="10%" style="text-align: left;background-color:#8f8f8f;"><strong>DOT#</strong></td>
			<td width="10%" style="text-align: left;background-color:#8f8f8f;"><strong>Equipment</strong></td>
		</tr>
	</thead>
	<tbody>
		<!-- ITEMS HERE -->
		<tr>
			<td style="padding: 10px 7px; line-height: 20px;"><?php if(!empty($carriersData->company_name)){ echo $carriersData->company_name; } ?> </td>
			<td style="padding: 10px 7px; line-height: 20px;max-width: 10%;"><?php if(!empty($carriersData->email)){ echo $carriersData->email; } ?></td>
			<td style="padding: 10px 7px; line-height: 20px;"><?php if(!empty($carriersData->phone_no)){ echo $carriersData->phone_no; } ?></td>
			<td style="padding: 10px 7px; line-height: 20px;"><?php if(!empty($carriersData->mc_no)){ echo $carriersData->mc_no; } ?></td>
			<td style="padding: 10px 7px; line-height: 20px;"><?php if(!empty($carriersData->dot_no)){ echo $carriersData->dot_no; } ?></td>
			<td style="padding: 10px 7px; line-height: 20px;"><?php if(!empty($carriersData->equipments)){ echo $carriersData->equipments; } ?></td>
		</tr>
	</tbody>
</table>





<table width="100%" style="font-family: sans-serif; font-size: 14px;" >
	<tr>
		<td>
			
			
			
			<table width="60%" align="right" style="font-family: sans-serif; font-size: 14px;" cellpadding="10">
				<thead>
					<tr>
						<td width="100%" style="text-align: left;background-color:#8f8f8f;"><strong>Carrier Notes:</strong></td>
					</tr>
				</thead>
				<tr>
					<td style="padding: 0px 8px; line-height: 20px;"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<div class="table-min-height" style="page-break-after : always">
	
</div>

<table class="items" width="100%" style="font-size: 14px;" cellpadding="8">
		<tr>
			<td style="padding: 12px 7px; line-height: 20px;text-align: left;"><strong>Dispatch Notes:</strong></td>
		</tr>
		<tr>
			<td style="padding: 12px 7px; line-height: 20px;text-align: left;">ALL SERVICES PROVIDED BY ADROIT LOGISTICS LLC TO ANY CARRIER OR VICE VERSA WILL BE GOVERNED
				BY THE BROKER CARRIER AGREEMENT SIGNED BY CARRIER WITH ADROIT LOGISTICS LLC.
				Quick Pay will be done within 24 to 48 hour after recieving the invoice and POD for load @ 3%.
				All POD's must be sent within 5 Days from the date of delivery else Adroit
				Logistics LLC will deduct $50 per day for delayed POD for that load.
				For Payment questions or any complaints call 385-381-0007 ext 405.Please <br>send the POD's and the invoices at accounts@adroitlogisticsus.com
				</td>
		</tr>
</table>


<br>
<br>
<br>
<table class="items" width="100%" style="font-size: 14px;margin-top: 10px;border: none;" cellpadding="8">

	
	<tr>
		<td width="50%" style="padding: 0px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Accepted By:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
		<td width="50%" style="padding: 0px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Date:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
		
	</tr>
	<br>
	<tr>
	<td width="50%" style="padding: 12px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Signature:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
	<td width="50%" style="padding: 12px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Driver Name:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
	</tr>
	<tr>
		
		<td width="50%" style="padding: 12px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Cell #:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
		<td width="50%" style="padding: 12px 7px; line-height: 20px;text-align: left;border: none;overflow: hidden;"><strong>Truck #:</strong><input type="text" style="border: none;border-bottom: 1px #000 solid;width: 100%;max-width: 100%;"></td>
	</tr>
</table>

<br>
<br>
<table class="items" width="100%" style="font-size: 14px;margin-top: 10px;border: none;" cellpadding="8">
	<tr>
		<td style="padding: 0px 7px; line-height: 20px;text-align: left;border: none;"><strong>Signature:</strong></td>
	</tr>
	<tr>
		<td style="padding: 0px 7px; line-height: 20px;text-align: left;border: none;">Carrier will perform the transportation described in this load confirmation subject to and in accordance with the Motor Carrier
			Transportation Agreement between Carrier and Adroit (the "Agreement"), which is incorporated herein by reference. Carrier
			acknowledges that Adroit customers or shippers may have special requirements for this shipment. By accepting the shipment
			described in this load confirmation, Carrier agrees to the rates and charges stated in this load confirmation and to special requirements
			communicated to Carrier by Adroit, its customer or the shipper.</td>
	</tr>
</table>






