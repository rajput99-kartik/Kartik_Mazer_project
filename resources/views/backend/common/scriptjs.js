

// if(window.location.protocol!="https:")
// // var HOSTPATH="http://"+window.location.host +"/";
// var HOSTPATH = "http://localhost/amb/";
// else
// // var HOSTPATH="https://"+window.location.host +"/";
// var HOSTPATH = "http://localhost/amb/";




/*Loader function start here */
function ShowLoaderTimeLine(){
Swal.fire({
title: "Please Wait...",
text: "Loading TImeline Data",
imageUrl: "https://i.gifer.com/EXfj.gif",
showConfirmButton: false,
allowOutsideClick: false,
});
} 




function ShowLoader(){
	Swal.fire({
		  title: "Checking...",
		  text: "Please wait",
		  imageUrl: "<?php echo url('/'); ?>/assets/img/ajax-loader.gif",
		  showConfirmButton: false,
		  allowOutsideClick: false,
	});
}
/*Loader function end here */


/* Create load form validation funcation Start */
// jQuery("#").validate({
 
//     rules: {
		
// 	lane_origin_truck : {
//         required: true
//       },
//     lane_drop_truck: {
//         required: true
        
//       },
//       length: {
//         required: true
//       },
//       weight: {
//         required: true
//       },
//       availability: {
//         required: true
//       },
//       maxOriginDead: {
//         required: true
//       },
//       maxDestinationDead: {
//         required: true
//       },
//       maxAgeMinutes: {
//         required: true
//       }
      
//     },
//     messages : {
		
// 	 lane_origin_truck: {
//         required: "Origin required"
//       },
//       lane_drop_truck: {
//         required: "Drop required"
       
//       },
//       length: {
//         required: "Length required"
//       },
//       weight: {
//         required: "Weight required"
//       },
//       availability: {
//         required: "Date required"
//       },
//       maxOriginDead: {
//         required: "MaxOrigin required"
//       },
//       maxDestinationDead: {
//         required: "MaxDestination required"
//       },
//       maxAgeMinutes: {
//         required: "Age required"
//       }
	  
//     }
//   });

jQuery('#TruckSearchForm').validate({
	rules:{
				  
				equipment_type : {
					required: true
				},
				lane_origin_truck : {
			     	required: true
			      },
			    	lane_drop_truck: {
			        required: true
					
			      },
			      length: {
			        required: true
			      },
			      weight: {
			        required: true
			      },
			      availability: {
			        required: true
			      },
			      maxOriginDead: {
			        required: true
			      },
			      maxDestinationDead: {
			        required: true
			      },
			      maxAgeMinutes: {
			        required: true
			      }
	},
	errorPlacement: function errorPlacement(error, element) { 
		error.appendTo(element.parent().parent().after());
	},            
});


/* New lane post form validation function start*/
jQuery("#new_lanes_post").validate({
	
    rules: {
		lane_origin : {
			required: true
		},
		lane_drop: {
			required: true
			
		},
		lengthFeet: {
			required: true
		},
		weightPounds: {
			required: true
		},
		pick_date: {
			required: true
		},
		// offer_rate: {
		// 	required: true
		// },
		comment1: {
			required: true,
			minlength: 2,
			maxlength: 70
		},
		commodity: {
			required: true
		}
		
    },
    messages : {
		lane_origin: {
			required: "Please enter lane origin"
		},
		lane_drop: {
			required: "Please enter lane drop"
			
		},
		lengthFeet: {
			required: "Please enter length"
		},
		weightPounds: {
			required: "Please enter weight"
		},
		pick_date: {
			required: "Please enter date"
		},
		// offer_rate: {
		// 	required: "Please enter price"
		// },
		comment1: {
			required: "Please enter some input"
		},
		commodity: {
			required: "Please enter commodity value"
		}
		
    }
});
/* New lane post form validation function end*/


  jQuery("#load_lane_update_form").validate({
 
    rules: {
      lane_origin : {
        required: true
      },
      lane_drop: {
        required: true
        
      },
      lengthFeet: {
        required: true
      },
      weightPounds: {
        required: true
      },
      pick_date: {
        required: true
      },
      comment1: {
        required: true,
		minlength: 5,
        maxlength: 70
      },
      commodity: {
        required: true
      }
      
    },
    messages : {
      lane_origin: {
        required: "Please enter lane origin"
      },
      lane_drop: {
        required: "Please enter lane drop"
       
      },
      lengthFeet: {
        required: "Please enter length"
      },
      weightPounds: {
        required: "Please enter weight"
      },
      pick_date: {
        required: "Please enter date"
      },
	  comment1: {
        required: "Please enter some input"
      },
	  commodity: {
        required: "Please enter commodity value"
      }
	  
    }
  });
/* Create load form validation funcation End */


/* Broker carrier search result funcation Start */

$(document).on('click','#carrier_search', function(){
	
	var carrier_name = $('.carrier_name').val();	
	var carrier_mc = $('.carrier_mc').val();	
	var carrier_dot = $('.carrier_dot').val();	


	if((carrier_name != '') || (carrier_mc != '') || (carrier_dot != '')){
	ShowLoaderTimeLine(); 
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carriers-find',
			type: 'get',
			cache : false,
			dataType : 'json',
			data: {carrier_name : carrier_name, carrier_mc:carrier_mc, carrier_dot:carrier_dot},

			success: function(data){
				
				setTimeout(function () {
						Swal.close();
				 }, 200); 
				 
				if(data != '')
				{
					setTimeout(function () {
						
						 Swal.fire({
							  title: "Carrier Added!",
							  text: "Carrier Already Register!",
							  icon: "success",
							  button: "Ok",
						 // timer: 1000
						}); 
						
					}, 500);
					
					
							
							$('#add_new_carrier_form').css('display','none');
						
				}else{
					
							//$('#AddCarrierButton').css('display','block');
					$.ajax({
						url: '<?php echo url('/'); ?>/admin/carrier/add-carrier-form',
						type: 'get',
						cache : false,
						data: {carrier_name : carrier_name, carrier_mc:carrier_mc, carrier_dot:carrier_dot},

						success: function(data){
							
							$('#add_new_carrier_form').html(data);
							
							setTimeout(function () {
								Swal.close();
								$('#add_new_carrier_form').modal('show');
							 }, 200); 
							
							
							}
					})
				}
				
				
					
			}       
		})
	}else{
		
		
		Swal.fire({
		  title: "Carrier Not Find!",
		  text: "Add carrier details first!",
		  icon: "warning",
		  button: "Ok",
		});
		
	}
	 
});
/* Broker carrier search result funcation End */


/* Broker Shipment create form validation funcation Start */
jQuery("#createshipmentsubmit").validate({
    rules: {
      shippername : {
        required: true,
      },
      pickready: {
        required: true,
        
      },
      dropready: {
        required: true,
      },
      carrier_mc: {
        required: true,
      },
      carrier_dot: {
        required: true,
      }
      
    },
    messages : {
      shippername: {
        required: "Please enter shipper name",
      },
      pickready: {
        required: "Please enter pick-up date",
       
      },
      dropready: {
        required: "Please enter drop date",
      },
      carrier_mc: {
        required: "Please enter Carrier MC",
      },
      carrier_dot: {
        required: "Please enter Carrier DOT",
      }
    }
  });
/* Broker Shipment create form validation funcation End */


/* Broker Carrier create form validation funcation Start */
jQuery("#add-new-carrier").validate({
    rules: {
      
		company_name: {
        required: true,
        
      },
      carrier_city: {
        required: true,
      },
      carrier_city_main: {
        required: true,
      },
      carrier_state: {
        required: true,
      },
      carrier_zip: {
        required: true,
      },
      phone_no: {
        required: true,
      }
      
    },
    messages : {
      
		company_name: {
        required: "Please enter Company name",
       
      },
      carrier_city: {
        required: "Please enter address"
      },
      carrier_city_main: {
        required: "Please enter city"
      },
      carrier_state: {
        required: "Please enter State"
      },
      carrier_zip: {
        required: "Please enter ZipCode"
      },
      phone_no: {
        required: "Please enter phone number"
      }
    }
  }); 
/* Broker Carrier create form validation funcation End */


/* Broker new carrier details verify function Start here*/
$(document).on('blur','#mc_no', function(){
	var carrier_mc = $('#mc_no').val();	
	var carrier_dot = $('#dot_no').val();	

	if((carrier_mc != '') || (carrier_dot != '')){
	//ShowLoaderTimeLine(); 
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carriers-find',
			type: 'get',
			cache : false,
			dataType : 'json',
			data: { carrier_mc:carrier_mc, carrier_dot:carrier_dot},
			success: function(data){
				setTimeout(function () {
						//Swal.close();
				 }, 200); 
				 
				if(data != '')
				{
					setTimeout(function () {
						 /* Swal.fire({
							  title: "Carrier Added!",
							  text: "Carrier Already Register!",
							  icon: "success",
							  button: "Ok",
						 // timer: 1000
						}); */ 
					}, 500);
						$('#carrier-form-submit').css('display','none');
				}else{
						$('#carrier-form-submit').css('display','block');
				}
				
			}
		})
	}
});


$(document).on('blur','#dot_no', function(){
	var carrier_mc = $('#mc_no').val();	
	var carrier_dot = $('#dot_no').val();	

	if((carrier_mc != '') || (carrier_dot != '')){
	//ShowLoaderTimeLine(); 
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carriers-find',
			type: 'get',
			cache : false,
			dataType : 'json',
			data: { carrier_mc:carrier_mc, carrier_dot:carrier_dot},
			success: function(data){
				setTimeout(function () {
						//Swal.close();
				 }, 200); 
				if(data != '')
				{
					setTimeout(function () {
						/*  Swal.fire({
							  title: "Carrier Added!",
							  text: "Carrier Already Register!",
							  icon: "success",
							  button: "Ok",
						 // timer: 1000
						});  */
					}, 500);
						$('#carrier-form-submit').css('display','none');
				}else{
						$('#carrier-form-submit').css('display','block');
				}
			}
		})
	}
});
/* Broker new carrier details verify function End here*/


/* Broker shipemt shipper get funcation End here*/
$(document).on('change','#shipper_name', function(){

	var shipper_name = $(this).val();

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipper/ShipperNameCheck',
		type: 'get',
		cache : false,
		dataType : 'json',
		data: {shipper_name:shipper_name},
		success: function(data)
		{
			//alert(data);
			if(data != ''){	

				$('#shipper_name').val('');
				$('#shipper_address').val('');
				$('#shipper_state').val('');
				$('#shipper_city').val('');
				$('#shipper_zip').val('');
				$('#shipper_persone').val('');
				$('#shipper_email').val('');
				$('#shipper_phone').val('');


			}
		}

	})
});

$(document).on('change','#shipper_name_testamb', function(){

	var shipper_name = $(this).val();

	   $('#shipperaddress').val('');
	   $('#shippercity').val('');
	   $('#shipperstate').val('');              
	   $('#shipperzip').val('');
	   $('#shipperphone').val('');
	   $('#customer_c_name').val('');
	   
	   
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/GetShipperDataShipment',
			type: 'get',
			cache : false,
			dataType:'json',
			data: {shipper_name:shipper_name},
			success: function(data)
			{
			
			 if(data != ''){	

				   $('#ShipperName').val(data.company_name);
				   $('#companies_id').val(data.id);
				   $('#shipperaddress').val(data.address);
				   $('#shippercity').val(data.shipper_city);
				   $('#shipperstate').val(data.shipper_state);
				   $('#shipperzip').val(data.shipper_zipcode);
				   $('#shipperphone').val(data.phone_number);
				   $('#customer_c_name').val(data.contact_name);
				   
				   $('#billname').val(data.company_name);
				   $('#billaddress').val(data.address);
				   $('#billcity').val(data.shipper_city);
				   $('#billstate').val(data.shipper_state);
				   $('#billzip').val(data.shipper_zipcode);
				   $('#billphone').val(data.phone_number);
				   $('#b_customer_c_name').val(data.contact_name);
				
			 }
			 
			 
			}
			
		});
	
});
/* Broker shipemt shipper get funcation End here*/


/* Carrier details view funcation Start here*/
$(document).on('click','.carrier_edit', function(){
	
	var carrier_id = $(this).val();
	
	//ShowLoaderTimeLine();
	
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carrier/carriers_edit',
			type: 'get',
			cache : false,
			data: {carrier_id:carrier_id},
			success: function(data){
				
				$('#edit_carrier_form').html(data);
				
				setTimeout(function () {
						
						$('#edit_carrier_form').modal('show');
				 }, 500);
				 
			}
			
		});
	
});
/* Carrier details view funcation End here*/



/* Agency details form funcation Start here*/
$(document).on('click','.agency_detail_form', function(){
	
	var agency_id = $(this).val();
	
	//ShowLoaderTimeLine();
	
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/agency/agency_details',
			type: 'get',
			cache : false,
			data: {agency_id:agency_id},
			success: function(data){
				
				$('#agency_detail_edit').html(data);
				
				setTimeout(function () {
						//Swal.close();
						$('#agency_detail_edit').modal('show');
				 }, 500);
				 
			}
			
		});
	
});
/* Agency details form funcation End here*/


/* Broker shipment get mc details function Start here*/
$(document).on('blur','#shipment_mc', function(){
	
	var shipment_mc = $('#shipment_mc').val();	
	//var carrier_dot = $('#dot_no').val();	
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/carrier_mc',
			type: 'get',
			cache : false,
			dataType : 'json',
			data: { shipment_mc:shipment_mc},

			success: function(data){
				
				if(data != ''){

					if(data.status == 1){
						$('#carriers_id').val(data.id);
						$('#shipment_mc').val(data.mc_no);
						$('#carrier_dot').val(data.dot_no);
						$('#carrier_name').val(data.c_company_name);
						$('#dispatched').val(data.dispatcher);
						$('#shipment_c_phone').val(data.phone_no);
						$('#shipment_c_email').val(data.email);
						$('#shipment_c_driver_n').val(data.d_name);
						$('#shipment_c_driver_p').val(data.d_phone);
						$('#carrier_status').text('');
				 	}else{
						$('#carrier_status').text('Carrier approval is pending.');
						$('#carriers_id').val('');
						$('#shipment_mc').val('');
				    	$('#carrier_dot').val('');
				    	$('#carrier_name').val('');
				    	$('#shipment_c_driver_n').val('');
					}

				}
				if(data = ''){
					$('#carriers_id').val('');
				    $('#shipment_mc').val('');
				}
				
			}
		})
		
	
	
});



$(document).on('blur','#carrier_dot', function(){
	
	var shipment_mc = $('#carrier_dot').val();	
	//var carrier_dot = $('#dot_no').val();	
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/carrier_dot',
			type: 'get',
			cache : false,
			dataType : 'json',
			data: { shipment_mc:shipment_mc},

			success: function(data){
				
				if(data != ''){

					if(data.status == 1){
						$('#carriers_id').val(data.id);
						$('#shipment_mc').val(data.mc_no);
						$('#carrier_dot').val(data.dot_no);
						$('#carrier_name').val(data.c_company_name);
						$('#dispatched').val(data.dispatcher);
						$('#shipment_c_phone').val(data.phone_no);
						$('#shipment_c_email').val(data.email);
						$('#shipment_c_driver_n').val(data.d_name);
						$('#shipment_c_driver_p').val(data.d_phone);
						$('#carrier_status').text('');
				 	}else{
						$('#carrier_status').text('Carrier approval is pending.');
						$('#carriers_id').val('');
						$('#shipment_mc').val('');
				    	$('#carrier_dot').val('');
				    	$('#carrier_name').val('');
				    	$('#shipment_c_driver_n').val('');
					}

				}
				if(data = ''){
					$('#carriers_id').val('');
				    $('#shipment_mc').val('');
				}
				
			}
		})
		
	
	
});
/* Broker shipment get mc details function End here*/

/* Broker shipenmt doc delete funcation Start Here*/
$(document).on('click','#Carrier_Doc_Del', function(){
	
	var shipper_doc_id = $(this).parent('.shipper_doc_id');
	var ShipperDocId = shipper_doc_id.attr('value');
	
	//alert(ShipperDocId); 
	//ShowLoaderTimeLine(); 
	
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/shipment_doc_del',
			type: 'get',
			cache : false,
			data: {ShipperDocId:ShipperDocId},
			success: function(data){
				
				if(data == 1)
				{
					location.reload(true);
				}
				setTimeout(function () {
						Swal.close();
				 }, 500);
				 
			}
			
		})
	
});
/* Broker shipemnt doc delete funcation End Here*/


/* Broker Add Loads Origin Start Here */	
$(document).on('keyup', '#lane_origin_input', function(e) { 
        var query = $(this).val();
		if(query != '')
        {
			
			$.ajax({
			   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
			   type:'get',
			   cache : false,
			   data:{query:query},
			   success:function(data){
				   //console.log(data);
				   $('#lane_origin').html(data);
			   }
			   
			})
			
		}else{
			   $('#lane_origin').fadeOut();
		}
		
});


$(document).on('click', '#lane_origin li', function(){
	 
        $('#lane_origin').val($(this).text()); 
        var load_origin = $('#lane_origin').val();	
		$('input[name="lane_origin"]').val($(this).text());
		$('#origin_place_value').val($(this).val());
        $('#lane_origin').fadeOut();
		
});
/* Broker Add Loads Origin End Here */


/* Broker Add Loads Destination Start Here */	
$(document).on('keyup', '#lane_drop_input', function(e) { 
        var query = $(this).val();
		if(query != '')
        {
			
			$.ajax({
			   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
			   type:'get',
			   cache : false,
			   data:{query:query},
			   success:function(data){
				   //console.log(data);
				   $('#lane_drop').html(data);
			   }
			   
			})
			
		}else{
			   $('#lane_drop').fadeOut();
		}
		
}); 

$(document).on('click', '#lane_drop li', function(){
	 
        $('#lane_drop').val($(this).text()); 
        var load_origin = $('#lane_drop').val();	
		$('input[name="lane_drop"]').val($(this).text());
		$('#drop_place_value').val($(this).val());
        $('#lane_drop').fadeOut();
		
});

/* Broker Add Loads Destination End Here */




/* Broker Update Loads Origin Start Here */	
$(document).on('keyup', '#lane_origin_input_update', function(e) { 
	var query = $(this).val();
	
	if(query != '')
	{
		
		$.ajax({
		   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
		   type:'get',
		   cache : false,
		   data:{query:query},
		   success:function(data){
			   //console.log(data);
			   $('#lane_origin_update').html(data);
		   }
		   
		})
		
	}else{
		   $('#lane_origin_update').fadeOut();
	}
	
});


$(document).on('click', '#lane_origin_update li', function(){
 
	$('#lane_origin_update').val($(this).text()); 
	var load_origin = $('#lane_origin_update').val();	
	$('input[name="lane_origin_update"]').val($(this).text());
	$('#origin_place_value_update').val($(this).val());
	$('#lane_origin_update').fadeOut();
	
});
/* Broker Update Loads Origin End Here */


/* Broker Update Loads Destination Start Here */	
$(document).on('keyup', '#lane_drop_input_update', function(e) { 
	var query = $(this).val();
	if(query != '')
	{
		
		$.ajax({
		   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
		   type:'get',
		   cache : false,
		   data:{query:query},
		   success:function(data){
			   //console.log(data);
			   $('#lane_drop_update').html(data);
		   }
		   
		})
		
	}else{
		   $('#lane_drop_update').fadeOut();
	}
	
}); 

$(document).on('click', '#lane_drop_update li', function(){
 
	$('#lane_drop_update').val($(this).text()); 
	var load_origin = $('#lane_drop_update').val();	
	$('input[name="lane_drop_update"]').val($(this).text());
	$('#drop_place_value_update').val($(this).val());
	$('#lane_drop_update').fadeOut();
	
});

/* Broker Update Loads Destination End Here */


/* Broker Search truck Origin Start Here */	
$(document).on('keyup', '#lane_origin_trcuk_input', function(e) { 
	var query = $(this).val();
	if(query != '')
	{
		
		$.ajax({
		   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
		   type:'get',
		   cache : false,
		   data:{query:query},
		   success:function(data){
			   //console.log(data);
			   $('#lane_origin_truck').html(data);
		   }
		   
		})
		
	}else{
		   $('#lane_origin_truck').fadeOut();
	}
	
});


$(document).on('click', '#lane_origin_truck li', function(){
 
	$('#lane_origin').val($(this).text()); 
	var load_origin = $('#truck_lane_origin_id').val();	
	$('input[name="lane_origin_truck"]').val($(this).text());
	$('#truck_lane_origin_id').val($(this).val());
	$('#lane_origin_truck').fadeOut();
	
});
/* Broker Search truck Origin End Here */


/* Broker Search truck drop Start Here */	
$(document).on('keyup', '#lane_drop_trcuk_input', function(e) { 
	var query = $(this).val();
	if(query != '')
	{
		
		$.ajax({
		   url: '<?php echo url('/'); ?>/admin/load/GetLoadOriginData',
		   type:'get',
		   cache : false,
		   data:{query:query},
		   success:function(data){
			   //console.log(data);
			   $('#lane_drop_truck').html(data);
		   }
		   
		})
		
	}else{
		   $('#lane_drop_truck').fadeOut();
	}
	
});


$(document).on('click', '#lane_drop_truck li', function(){
 
	$('#lane_drop_trcuk_input').val($(this).text()); 
	var load_origin = $('#truck_lane_origin_id').val();	
	$('input[name="lane_drop_truck"]').val($(this).text());
	$('#truck_lane_drop_id').val($(this).val());
	$('#lane_drop_truck').fadeOut();
	
});
/* Broker Search truck drop End Here */


/* Broker Dat load age refresh funcation start Here */
$(document).on('click', '#load_refresh_btn', function(){
	 
        var dat_id = $(this).parent().find('#load_dat_id');
		 var datId = dat_id.val();
		 
		$.ajax({
			   url: '<?php echo url('/'); ?>/admin/load/LoadAgeRefresh',
			   type:'get',
			   cache : false,
			   data:{datId:datId},
			   success:function(data){
				   
				   if(data == '1')
				   {
					   Swal.fire({
							  title: "Load refresh!",
							  text: "Load refresh successfully.",
							  icon: "success",
							  confirmButtonText: "Ok",
						});
				   }
				   if(data != '1')
				   {
					   Swal.fire({
							  title: "Load refresh!",
							  text: "Load already refreshed, try some time later.",
							  icon: "warning",
							  confirmButtonText: "Ok",
						});
				   }
				   
			   }
		})
		
});

/* Broker Dat load age refresh funcation End Here */


/* Broker Dat load delete funcation start Here */


  
// function confirmation(){
// 	var result = confirm("Are You Sure Delete This Record..!");
// 	if (result==true) {
// 		alert('yes');
// 	}else{
// 		alert('no');
// 		return false;
// 	}


$(document).on('click', '#load_repost_btn', function(){
	
	
	var result = confirm("Are You Sure This Load Re-post..!");
	if (result==true) {
		

	var dat_id = $(this).parent().find('#load_dat_id');
	var datId = dat_id.val();

		$.ajax({
			    url: '<?php echo url('/'); ?>/admin/load/repost',
		   		type:'get',
		   		cache : false,
		   		data:{datId:datId},
		   		success:function(data){
					
					window.location.href = '<?php echo url('/'); ?>/admin/loads';
		   }
		})

		}else{
			return false;
		}
		
});
	

$(document).on('click', '#load_delete_btn', function(){
	
	
		var result = confirm("Are You Sure Delete This Record..!");
		if (result==true) {
			

        var dat_id = $(this).parent().find('#load_dat_id');
		 var datId = dat_id.val();

		$.ajax({
			   url: '<?php echo url('/'); ?>/admin/load/LoadPostDelete',
			   type:'get',
			   cache : false,
			   data:{datId:datId},
			   success:function(data){
				   
				   if(data == '1')
				   {
					   Swal.fire({
							  title: "Load Deleted!",
							  text: "Load delete successfully.",
							  icon: "success",
							  confirmButtonText: "Ok",
						});
						
						setTimeout(function () {
							location.reload(true);
						 }, 500);
						
				   }
				   if(data != '1')
				   {
				// 	   Swal.fire({
				// 			  title: "Load Delete!",
				// 			  text: "Load deleted not working, try some time later.",
				// 			  icon: "warning",
				// 			  confirmButtonText: "Ok",

				// 		});
				
				        Swal.fire({
							  title: "Load Deleted!",
							  text: "Load delete successfully.",
							  icon: "success",
							  confirmButtonText: "Ok",
						});
						
						setTimeout(function () {
							location.reload(true);
						 }, 500);
						
						
				   }
				   
			   }
		})



		}else{
			return false;
		}
	
	
		
});


	


/* Broker Dat load delete funcation End Here */


/* Broker Dat load age refresh funcation start Here */
$(document).on('click', '#load_update_form_btn', function(){
	alert(HOSTPATH);
	 
	var dat_id = $(this).parent().find('#load_dat_id');
	 var datId = dat_id.val();

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	 
	$.ajax({
		   url: '<?php echo url('/'); ?>/admin/load/LodePostUpdateForm',
		   type:'get',
		   cache : false,
		   data:{datId:datId},
		   success:function(data){

			$('#LoadUpdateForm').html(data);
			setTimeout(function () {
				$('#LoadUpdateForm').modal('show');
		 	}, 500);
			

		   }

		})

	});
/* Broker Dat load age refresh funcation End Here */


/* Broker Dat load retaview funcation Start Here */	
	$(document).on('click', '#LoadPostRateBtn', function(e) { 

	var origin = $('#origin_place_value').val();
	var destination = $('#drop_place_value').val();
	var equipment_type = $('#equipment_type').find(":selected").val();
	var csrf_id = $('#new_lanes_post').children('input[name="_token"]').val();
	
	if (origin.length == "") {
		$("#origincheck").text("Enter origin value");
		$("#origincheck").css('display','block');
		return false;
	  }else{ $("#origincheck").hide(); }

	  if (destination.length == "") {
		$("#dropcheck").text("Enter drop value");
		$("#dropcheck").css('display','block');
		return false; 
	  }else{ $("#dropcheck").hide(); }

	  if (equipment_type.length == "") {
		$("#equipmentcheck").text("Enter equipment value");
		$("#equipmentcheck").css('display','block');
		return false;
	  }else{ $("#equipmentcheck").hide(); }

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/LoadPostRateView',
		method:'POST',
		data:{origin:origin,destination:destination,equipment_type:equipment_type,csrf_id:csrf_id},
		cache : false,
		success:function(data){
		    
		    console.log(data['Spot']) ;
		    $("div#rateview3").fadeIn()
			$('#reports').html(data['CONTRACT']['Reports']);
			$('#companies').html(data['CONTRACT']['Companies']);
			$('#cont_price').html(data['CONTRACT']['MaxPrice']);
			$('#avg_price').html(data['CONTRACT']['FinalPrice']);
			$('#cont_mileage').html(data['CONTRACT']['Mileage']);
			$('.market_type_origin').html(data['CONTRACT']['Origin']);
			$('.market_type_drop').html(data['CONTRACT']['Destination']);

			$('#spot_reports').html(data['Spot']['Reports']);
			$('#spot_companies').html(data['Spot']['Companies']);
			$('#spot_avg_price').html(data['Spot']['FinalPrice']);
			$('#spot_price').html(data['Spot']['MaxPrice']);
			$('#spot_mileage').html(data['Spot']['Mileage']);
		}

	})



});


$(document).on('click', '#LoadPostRateUpdateBtn', function(e) { 

	var origin = $('#origin_place_value_update').val();
	var destination = $('#drop_place_value_update').val();
	var equipment_type = $('#equipment_type_update').find(":selected").val();

	// alert(origin);
	// alert(destination);
	if (origin.length == "") {
		$("#origincheck").text("Enter origin value");
		return false;
	  }else{ $("#origincheck").hide(); }

	  if (destination.length == "") {
		$("#dropcheck").text("Enter drop value");
		return false; 
	  }else{ $("#dropcheck").hide(); }

	  if (equipment_type.length == "") {
		$("#equipmentcheck").text("Enter equipment value");
		return false;
	  }else{ $("#equipmentcheck").hide(); }

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/LoadPostRateView',
		method:'POST',
		data:{origin:origin,destination:destination,equipment_type:equipment_type},
		cache : false,
		success:function(data){

			$('.default').css('display','none');
			$('#up_reports').html(data['CONTRACT']['Reports']);
			$('#up_companies').html(data['CONTRACT']['Companies']);
			$('#up_cont_price').html(data['CONTRACT']['Highprice']);
			$('#up_cont_mileage').html(data['CONTRACT']['Mileage']);
			$('.time_frame').html(data['CONTRACT']['Timeframe']);
			$('.market_type_origin').html(data['CONTRACT']['Origin']);
			$('.market_type_drop').html(data['CONTRACT']['Destination']);

			$('#up_spot_reports').html(data['Spot']['Reports']);
			$('#up_spot_companies').html(data['Spot']['Companies']);
			$('#up_spot_price').html(data['Spot']['Highprice']);
			$('#up_spot_mileage').html(data['Spot']['Mileage']);
			$('.market_type_origin').html(data['Spot']['Origin']);
			$('.market_type_drop').html(data['Spot']['Destination']);
		}

	})



});
/* Broker Dat load retaview funcation End Here */



/* Broker Dat load retaview funcation Start Here */	
$(document).on('click', '.request_update', function(e) { 

	var companies_id = $('#companies_id').val();
	var status = $(this).val();
	var comment = $('#comment').val();
	var limit = $('#limit').val();
	var prepay = $('#prepay_limit').val();
	
	if((comment != '') && (limit != '') || (prepay != '')){

	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipper/request_update',
		method:'POST',
		data:{companies_id:companies_id,status:status,comment:comment,limit:limit,prepay:prepay},
		cache : false,
		success:function(data){
				
			setTimeout(function () {
				window.location.href = '<?php echo url('/'); ?>/admin/shipper/request';
				//location.reload(true);
			 }, 500);
		}

	})
}else{
	
	if (limit.length == "") {
    	$("#limitcheck").text("Enter limit value");
		return false;
	  }else{ $("#commentcheck").hide(); }

	  if (comment.length == "") {
	     $("#commentcheck").text("Enter comment value");
		return false;
	  }else{ $("#limitcheck").hide(); }

	  if (prepay.length == "") {
		$("#prepay_check").text("Enter pre-pay value");
		return false;
	  }else{ $("#prepay_check").hide(); }
}
	

});
/* Broker Dat load retaview funcation End Here */	



/* Broker Shipment status update funcation Start Here */
$(document).on('change', '#shipment_status_change', function() { 
   	
	var status = $(this).val();
	var shipment_id = $(this).parent().find('#shipment_id');
	var shipmentId = shipment_id.val();
	//alert(shipmentId);return false;

		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/ShipmentStatusUpdate',
			method:'GET',
			data:{shipmentId:shipmentId,status:status},
			cache : false,
			success:function(data){
			
				if(data == 1){
				
					setTimeout(function () {
						location.reload(true);
					}, 500);
				}
			}

		})

});
/* Broker Shipment status update funcation End Here */



/* MyCarrier DOT number search funcation Start Here */	
$(document).on('click', '#btnSearchDotNumber', function(e) { 

	var DotNumber = $('#DotNumber').val();
	var DocketNumber = '';

	if(DotNumber != ''){

		$("#DotNumberError").hide();
		
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/carrier/PreviewCarrierDetail',
		method:'get',
		data:{DotNumber:DotNumber,DocketNumber:DocketNumber},
		cache : false,
		success:function(data){
				$('#carrier-preview-section').html(data);
			
		}

	})
}else{
	
	if (DotNumber.length == "") {
		$("#DotNumberError").text("Dot Number is required");
		return false;
	  }else{ $("#DotNumberError").hide(); }
}
	

});
/* MyCarrier DOT number search funcation End Here */	


/* MyCarrier DOT number search funcation Start Here */	
$(document).on('click', '#btnSearchDocketNumber', function(e) { 

	var DocketNumber = $('#DocketNumber').val();
	
	if(DocketNumber != ''){

	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/carrier/PreviewCarrierDetail',
		method:'get',
		data:{DocketNumber:DocketNumber},
		cache : false,
		success:function(data){
				
			$('#carrier-preview-section').html(data);
		}

	})
}else{
	
	if (DocketNumber.length == "") {
		$("#DocketNumberError").text("Docket Number is required");
		return false;
	  }else{ $("#DocketNumberError").hide(); }
}
	

});
/* MyCarrier DOT number search funcation End Here */	


/* MyCarrier email invite form funcation Start Here */	
$(document).on('click', '#EmailInvite', function(e) { 
	
	var DotNumber = $(this).data('dot-number');
	var DocketNumber = $(this).data('docket-number');
	
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carrier/CarrierEmailInviteForm',
			method:'get',
			data:{DotNumber:DotNumber,DocketNumber:DocketNumber},
			cache : false,
			success:function(data){
					
				setTimeout(function () {
					$('#CarrierEmailInvite').html(data);
					$('#CarrierEmailInvite').modal('show');
				}, 500);
			}

		})
	
});
/* MyCarrier email invite form funcation Start Here */


/* MyCarrier email invite sent mail funcation Start Here */	
$(document).on('click', '#EmailInviteSent', function(e) { 
	
	//var verify_emails = $('#verify_emails').find(":selected").val();
	var verify_emails = $('#verify_emails').val();
	var emails_sent_by = $('#emails_sent_by').val();
	
	if(verify_emails != ""){
		
		$('verify_emails_error').val('');
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carrier-packet/EmailInviteSent',
			method:'get',
			data:{verify_emails:verify_emails,emails_sent_by:emails_sent_by},
			cache : false,
			success:function(data){
					
				setTimeout(function () {
					
				}, 500);
			}

		})
		
	}else{
		
		document.getElementById('verify_emails').focus();
		$('#verify_emails').css('color','red');
	}
	
});

$(document).on('click','#multipickclose', function(){
		location.reload(true);s
});

/* MyCarrier email invite sent mail funcation Start Here */



/* Admin shipenmt all list get filter funcation Start Here*/
$(document).on('click','#ShipmentRefreshAdmin', function(){

	var ShipmentStatus = $('#ShipmentStatus').val();
	var Load = $('#LoadNumber').val();
	var AgentName = $('#AgentName').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	

if((ShipmentStatus != '') || (Load != '') || (AgentName != '') || (from_date != '') || (to_date != '')){
	
	
	$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/AllShipmentFilterAdmin',
			type: 'get',
			cache : false,
			data: {ShipmentStatus:ShipmentStatus,Load:Load,AgentName:AgentName,from_date:from_date,to_date:to_date},
			success: function(data){
				$('#shipment_filter').html(data);			
				setTimeout(function () {
						Swal.close();
				 }, 500);
			
			}	
		});
		 
}else{
	    location.reload(true);
// 		Swal.fire({
// 			position: 'center',
// 			icon: 'warning',
// 			title: 'Select some details first!',
// 			showConfirmButton: false,
// 			timer: 1000
// 		})
	
}
		
		
});
/* Admin shipenmt all list get filter funcation End Here*/


/* Admin shipenmt list filter funcation Start Here*/
$(document).on('click','#ShipmentRefreshB', function(){

	var ShipmentStatus = $('#ShipmentStatus').val();
	var Load = $('#LoadNumber').val();
	var AgentName = $('#AgentName').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	

if((ShipmentStatus != '') || (Load != '') || (AgentName != '') || (from_date != '') || (to_date != '')){
	
	
	$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/ShipmentFilterAdmin',
			type: 'get',
			cache : false,
			data: {ShipmentStatus:ShipmentStatus,Load:Load,AgentName:AgentName,from_date:from_date,to_date:to_date},
			success: function(data){
				$('#shipment_filter').html(data);			
				setTimeout(function () {
						Swal.close();
				 }, 500);
			
			}	
		});
		 
}else{
	
		Swal.fire({
			position: 'center',
			icon: 'warning',
			title: 'Select some details first!',
			showConfirmButton: false,
			timer: 1000
		})
	
}
		
		
});
/* Admin shipenmt list filter funcation End Here*/


/* Admin shipper list filter funcation Start Here*/
$(document).on('click','#ShipperRefreshB', function(){

	var ShipperStatus = $('#ShipperStatus').val();
	var ShipperName = $('#ShipperName').val();
	var AgentName = $('#AgentName').val();
	// var from_date = $('#from_date').val();
	// var to_date = $('#to_date').val();
	

if((ShipperStatus != '') || (ShipperName != '') || (AgentName != '')){
	
	
	$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipper/ShipperFilterAdmin',
			type: 'get',
			cache : false,
			data: {ShipperStatus:ShipperStatus,ShipperName:ShipperName,AgentName:AgentName},
			success: function(data){
				
				$('#shipper_filter').html(data);			
				setTimeout(function () {
						Swal.close();
				 }, 500);
			
			}	
		});
		 
}else{
		location.reload(true);
// 		Swal.fire({
// 			position: 'center',
// 			icon: 'warning',
// 			title: 'Select some details first!',
// 			showConfirmButton: false,
// 			timer: 1000
// 		})
	
}
		
		
});
/* Admin shipper list filter funcation End Here*/



/* Broker shipenmt pick&drop form funcation Start Here*/
$(document).on('click','#btnPickDropFrom', function(){

	var Shipment_id = $(this).val();

		$.ajax({
			url: '<?php echo url('/'); ?>/admin/shipment/PicksDropsForm',
			type: 'get',
			cache : false,
			data: {Shipment_id:Shipment_id},
			success: function(data){
				
				$('#PickDropSection').html(data);
				$('#PickDropSection').modal('show');
			}	
		});


});
/* Broker shipenmt pick&drop form funcation End Here*/

/* Broker extra picks add funcation Start here*/
$(document).on('click','#AddExtraPick', function(){
	
	var ManagePick_id  = $(this).val();
	
	$.ajax({
		  url: '<?php echo url('/'); ?>/admin/shipment/AddExtraPick',
		   method:'GET',
		   data:{ManagePick_id:ManagePick_id},
		   cache : false,
		   success:function(data)
		   {
				$('#PickDropSection').html(data);
		   }
	})
});	


$(document).on('click','#shipment_drop_save', function(){
	
	var drop_id = $(this).val();
	var d_name = $(this).closest('form').find("[name=dropname]").val();
	var d_address = $(this).closest('form').find("[name=dropaddress]").val();
	var manageorder = $(this).closest('form').find("[name=manageorder]").val();
	var city = $(this).closest('form').find("[name=dropcity]").val();
	var state = $(this).closest('form').find("[name=pickstate]").val();
	var zip = $(this).closest('form').find("[name=dropzip]").val();
	var d_ref = $(this).closest('form').find("[name=d_ref]").val();
	var contact = $(this).closest('form').find("[name=d_contact]").val();
	var phone = $(this).closest('form').find("[name=dropphone]").val();
	var email = $(this).closest('form').find("[name=dropemail]").val();
	var dropready = $(this).closest('form').find("[name=dropready]").val();
	var time = $(this).closest('form').find("[name=droptime]").val();
	var d_appt_note = $(this).closest('form').find("[name=d_appt_note]").val();
	
	 
	$.ajax({
		  url: '<?php echo url('/'); ?>/admin/shipment/ExtraDropSubmit',
		   method:'POST',
		   data:{drop_id:drop_id,d_name:d_name,d_address:d_address,manageorder:manageorder,city:city,state:state,zip:zip,d_ref:d_ref,contact:contact,phone:phone,email:email,dropready:dropready,time:time,d_appt_note:d_appt_note},
		   cache : false,
		   success:function(data)
		   {
				$('#shipment_drop_save').closest('form').find("[name=drop_msg]").text('Drop details update successfully!');
		   }
	})
});	
/* Broker extra picks add funcation end here*/


/* Broker add extra drop funcation start here*/
$(document).on('click','#AddExtraDrop', function(){
	
	var ManagePick_id  = $(this).val();
	//var ManagePickId = ManagePick_id.val();	
		
	$.ajax({
		  url: '<?php echo url('/'); ?>/admin/shipment/AddExtraDrop',
		   method:'GET',
		   data:{ManagePick_id:ManagePick_id},
		   cache : false,
		   success:function(data)
		   {
				$('#PickDropSection').html(data);
		   }
	})
});	


$(document).on('click','#shipment_pick_save', function(){
	
	var pick_id = $(this).val();
	var p_name = $(this).closest('form').find("[name=pickname]").val();
	var p_address = $(this).closest('form').find("[name=pickaddress]").val();
	var manageorder = $(this).closest('form').find("[name=manageorder]").val();
	var city = $(this).closest('form').find("[name=pickcity]").val();
	var state = $(this).closest('form').find("[name=pickstate]").val();
	var zip = $(this).closest('form').find("[name=pickzip]").val();
	var p_ref = $(this).closest('form').find("[name=p_ref]").val();
	var contact = $(this).closest('form').find("[name=p_contact]").val();
	var phone = $(this).closest('form').find("[name=pickphone]").val();
	var email = $(this).closest('form').find("[name=pickemail]").val();
	var pickready = $(this).closest('form').find("[name=pickready]").val();
	var time = $(this).closest('form').find("[name=picktime]").val();
	var p_appt_note = $(this).closest('form').find("[name=p_appt_note]").val();
	
	 
	$.ajax({
		  url: '<?php echo url('/'); ?>/admin/shipment/ExtraPickSubmit',
		   method:'POST',
		   data:{pick_id:pick_id,p_name:p_name,p_address:p_address,manageorder:manageorder,city:city,state:state,zip:zip,p_ref:p_ref,contact:contact,phone:phone,email:email,pickready:pickready,time:time,p_appt_note:p_appt_note},
		   cache : false,
		   success:function(data)
		   {
			$('#shipment_pick_save').closest('form').find("[name=pick_msg]").text('Pick details update successfully!');
		   }
	})
});	

/* Broker add extra drop funcation end here*/


/* Broker add extra pick delete funcation start here*/
$(document).on('click','#shipment_pick_delete', function(){
	
	var ManagePick_id  = $(this).val();
	var shipmentId  = $(this).attr("data-shipmentId");
	
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipment/DeleteExtraPick',
		 method:'GET',
		 data:{ManagePick_id:ManagePick_id,shipmentId:shipmentId},
		 cache : false,
		 success:function(data)
		 {
			$('#PickDropSection').html(data);
			 
		 }
	})

});
/* Broker add extra pick delete funcation end here*/


/* Broker add extra drop delete funcation start here*/
$(document).on('click','#shipment_drop_delete', function(){
	
	var drop_id  = $(this).val();
	var shipmentId  = $(this).attr("data-shipmentId");
	
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipment/DeleteExtraDrop',
		 method:'GET',
		 data:{drop_id:drop_id,shipmentId:shipmentId},
		 cache : false,
		 success:function(data)
		 {

			if(data == 1){
				$('#PickDropSection').html(data);
			}
			 
		 }
	})

});
/* Broker add extra drop delete funcation end here*/


/* Broker find new truck result funcation start here*/
$(document).on('click','.GetTruckResult', function(){
	
	var load_id  = $(this).attr('value');
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/TruckExactResult',
		 method:'GET',
		 data:{load_id:load_id},
		 cache : false,
		 success:function(data)
		 {
			$('#'+load_id).closest('tr').html(data);
			 
		 }
	})
	
});
/* Broker find new truck result funcation end here*/




/* Broker find new truck delete on DAT funcation start here*/
$(document).on('click','#TruckSearchDelete', function(){
	
	var match_id  = $(this).attr('value');

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/TruckSearchDelete',
		 method:'GET',
		 data:{match_id:match_id},
		 cache : false,
		 success:function(data)
		 {
				setTimeout(function () {
					location.reload(true);
				}, 500);
			 
		 }
	})


	
});
/* Broker find new truck delete on DAT funcation end here*/




/* Admin shipper list filter funcation Start Here*/
$(document).on('click','#ApfillterRefreshB', function(){

	var ApStatus = $('#ApStatus').val();
	// var ShipperName = $('#ShipperName').val();
	// var AgentName = $('#AgentName').val();
	// var from_date = $('#from_date').val();
	// var to_date = $('#to_date').val();
	

if((ApStatus != '') || (ShipperName != '') || (AgentName != '')){
	
	
	$.ajax({
			url: '<?php echo url('/'); ?>/admin/accountap/fillter/',
			type: 'get',
			cache : false,
			data: {ApStatus:ApStatus},
			success: function(data){
				var filterdata = data.find(".datacfillter");
				$('.apfillterlist').html(filterdata);			
				setTimeout(function () {
						Swal.close();
				 }, 500);
			
			}	
		});
		 
}else{
	
		Swal.fire({
			position: 'center',
			icon: 'warning',
			title: 'Select some details first!',
			showConfirmButton: false,
			timer: 1000
		})
	
}
		
		
});
/* Admin shipper list filter funcation End Here*/



/* Ar shipper invoice-email funcation Start Here*/
$(document).on('click','#EmailSubmitBtn', function(){
	
	var load_id = $(this).val();
	var company_id = $('#company_id').val();
	var email_to = $('#email_to').val();
	var subject = $('#subject').val();
	var email_body = CKEDITOR.instances.email_body.getData();
	//$('textarea[name="email_body"]').val();
	//alert(email_body);return false;
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/ar/shipper-EmailSent',
		type: 'get',
		cache : false,
		data: {load_id:load_id,company_id:company_id,email_to:email_to, subject:subject, email_body:email_body},
		success: function(data){

			setTimeout(function () {
				window.location.href = '<?php echo url('/'); ?>/admin/ar/shipment-detail/'+company_id;
			}, 500);
			
		}
	});
	
	
});
/* Ar shipper invoice-email funcation End Here*/


/* Admin shipper list filter funcation Start Here*/
$(document).on('click','#ApfillterRefreshB', function(){

	var ApStatus = $('#ApStatus').val();
	// var ShipperName = $('#ShipperName').val();
	// var AgentName = $('#AgentName').val();
	// var from_date = $('#from_date').val();
	// var to_date = $('#to_date').val();
	

if((ApStatus != '') || (ShipperName != '') || (AgentName != '')){
	
	
	$.ajax({
			url: '<?php echo url('/'); ?>/admin/accountap/fillter/',
			type: 'get',
			cache : false,
			data: {ApStatus:ApStatus},
			success: function(data){
				var filterdata = data.find(".datacfillter");
				$('.apfillterlist').html(filterdata);			
				setTimeout(function () {
						Swal.close();
				 }, 500);
			
			}	
		});
		 
}else{
		Swal.fire({
			position: 'center',
			icon: 'warning',
			title: 'Select some details first!',
			showConfirmButton: false,
			timer: 1000
		})
	
}
		
		
});
/* Admin shipper list filter funcation End Here*/



/* ApComment  Fetch Data  details view funcation Start here*/
$(document).on('click','.apcomment_fetch', function(){
	var carrier_id = $(this).val();
	var getid = $(this).attr('data-bs-target')
	//ShowLoaderTimeLine();
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/apcomment/fetchcommentdata',
			type: 'get',
			cache : false,
			data: {carrier_id:carrier_id},
			success: function(data){
				$("#comment_body").html(data);
			}
		});
});

/* ApComment Fetch Data details view funcation End here*/


/* ApComment  Fetch Data  details view funcation Start here*/
$(document).on('click','.apshipupload_fetch', function(){
	var carrier_id = $(this).val();
	//ShowLoaderTimeLine();
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/apcomment/apdocumentfetch',
			type: 'get',
			cache : false,
			data: {carrier_id:carrier_id},
			success: function(data){
				$('#Apupload').html(data);
				setTimeout(function () {
						$('#Apupload').modal('show');
				 }, 500);
			}
		});
});
/* ApComment Fetch Data details view funcation End here*/


/* Ar payment update form funcation Start here*/
$(document).on('click','#PaymentUpdate', function(){
	var shipmentId = $(this).parent().find('#shipment_id');
	var shipment_id = shipmentId.val();
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/ar/PaymentUpdateForm',
		type: 'get',
		cache : false,
		data: {shipment_id:shipment_id},
		success: function(data){
			$('#ArPaymentUpt').html(data);
			setTimeout(function () {
					$('#ArPaymentUpt').modal('show');
			 }, 500);
		}
	});


});
/* Ar payment update form funcation End here*/


 /* Ar payment update form submit funcation Start here*/
 $(document).on('click','#ArPaymentFormBtn', function(){
	var shipmentId = $(this).parent().find('#Shipment');
	var shipment_id = shipmentId.val();
	var pro_num = shipmentId.attr('data-pro');
	var pay_mode = $('#pay_mode').val();
	var invoice_amount = $('#invoice_amount').val();
	var amount_paid = $('#amount_paid').val();
	var balance_due = $('#balance_due').val();
	var check_date = $('#check_date').val();
	var received_date = $('#received_date').val();
	var deposit_date = $('#deposit_date').val();


if((invoice_amount != '') && (amount_paid != '') && (balance_due != '') && (received_date != '') && (deposit_date != '')){

	$("#invoiceAmountError").hide();
	$("#amountPaidError").hide();
	$("#balanceDueError").hide();
	$("#receivedDateError").hide();
	$("#depositDateError").hide();

			if(shipment_id != ''){

				$.ajax({
					url: '<?php echo url('/'); ?>/admin/ar/PaymentUpdateSubmit',
					type: 'get',
					cache : false,
					data: {shipment_id:shipment_id,pay_mode:pay_mode,invoice_amount:invoice_amount,amount_paid:amount_paid,balance_due:balance_due,check_date:check_date,received_date:received_date,deposit_date:deposit_date,pro_num:pro_num},
					success: function(data){
						//$('#ArPaymentUpt').html(data);
						setTimeout(function () {
							location.reload(true);
							}, 500);
					}
				});
			}else{

				Swal.fire({
					position: 'center',
					icon: 'warning',
					title: 'Invoice Not generate yet!',
					showConfirmButton: false,
					timer: 1000
				})
			}

}else{

	if (invoice_amount.length == "") {
		$("#invoiceAmountError").text("Enter some text!");
		return false;
	  }else{ $("#invoiceAmountError").hide(); }

	
	if (amount_paid.length == "") {
	$("#amountPaidError").text("Enter some text!");
	return false;
	}else{ $("#amountPaidError").hide(); }

	if (balance_due.length == "") {
	$("#balanceDueError").text("Enter some text!");
	return false;
	}else{ $("#balanceDueError").hide(); }

	if (received_date.length == "") {
	$("#receivedDateError").text("Enter some text!");
	return false;
	}else{ $("#receivedDateError").hide(); }

	if (deposit_date.length == "") {
	$("#depositDateError").text("Enter some text!");
	return false;
	}else{ $("#depositDateError").hide(); }
}




});
/* Ar payment update form submit funcation End here*/



/* ApComment  Fetch Data  details view funcation Start here*/
$(document).on('click','#ArCommentForm', function(){
	var carrier_id = $(this).attr('shipment_id');
	//ShowLoaderTimeLine();
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/ar/Payment-Comment',
			type: 'get',
			cache : false,
			data: {carrier_id:carrier_id},
			success: function(data){
				$('#ArCommentShow').html(data);
				setTimeout(function () {
						$('#ArCommentShow').modal('show');
				 }, 500);
			}
		});
});
/* ApComment Fetch Data details view funcation End here*/


/* ApComment  Fetch Data  details view funcation Start here*/
$(document).on('click','#ArCommentSubmit', function(){
	var carrier_id = $(this).parent().find('#shipmentid_loadid').val();
	var user_id = $(this).parent().find('#user_id').val();
	var description = $('#description').val();
	//ShowLoaderTimeLine();
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/ar/Payment-CommentSubmit',
			type: 'get',
			cache : false,
			data: {carrier_id:carrier_id,user_id:user_id,description:description},
			success: function(data){
				$('#ArCommentShow').html(data);
				setTimeout(function () {
						$('#ArCommentShow').modal('show');
				 }, 500);
			}
		});
});
/* ApComment Fetch Data details view funcation End here*/

$("#referenc").keypress(function(e) {
    if(e.which == 13) {
	var referenc = $(this).val();	

	if(referenc != ''){
	//ShowLoaderTimeLine(); 
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/load/ReferencSearch',
			type: 'get',
			cache : false,
			data: { referenc:referenc},
			success: function(data){
				$('#LoadRefernceSearch').html(data);
				$('#LoadRefernceSearch').modal('show');
				return false;
				
				}
			})
		}
	}
});

/* Load referenc find function Start here*/
$(document).on('blur','#referenc', function(){
	var referenc = $(this).val();	

	if(referenc != ''){
	//ShowLoaderTimeLine(); 
		
		$.ajax({
			url: '<?php echo url('/'); ?>/admin/load/ReferencSearch',
			type: 'get',
			cache : false,
			data: { referenc:referenc},
			success: function(data){
				$('#LoadRefernceSearch').html(data);
				$('#LoadRefernceSearch').modal('show');
				return false;
				
			}
		})
	}
});
/* Load referenc find function End here*/


/* New shipment Create from the load-post function Start here*/
$(document).on('blur','#NewShipmentCreate', function(){
	var load_id = $('#load_dat_id').val();


	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipment/NewShipmentCreate',
		type: 'get',
		cache : false,
		data: { load_id:load_id},
		success: function(data){
			
		}
	})
	
});
/* New shipment Create from the load-post function End here*/



/* Broker comment on load refrence funcation Start Here */	
$(document).on('click', '#loadCommentBtn', function(e) { 

	var load_id = $('#load_id').val();
	var loadComment = $('#loadComment').val();

	if(loadComment != ''){

		$("#loadCommentError").hide();
		
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/newCommentAdd',
		method:'get',
		data:{loadComment:loadComment,load_id:load_id},
		cache : false,
		success:function(data){
			$('#LoadRefernceSearch').html(data);
			$('#LoadRefernceSearch').modal('show');
			//location.reload(true);
			
		}

	})
}else{
	
	if (loadComment.length == "") {
		$("#loadCommentError").text("Enter some text!");
		return false;
	  }else{ $("#loadCommentError").hide(); }
}
	

});
/* Broker comment on load refrence funcation End Here */	


/* Carrier request from function Start here*/
$(document).on('blur','#CarrierRequestBtn', function(){
	var carrier_id = $('#carrier_id').val();


	$.ajax({
		url: '<?php echo url('/'); ?>/admin/carrier/CarrierRequestForm',
		type: 'get',
		cache : false,
		data: { carrier_id:carrier_id},
		success: function(data){
			
			$('#CarrierRequestForm').html(data);
			$('#CarrierRequestForm').modal('show');
		}
	})
	
});
/* Carrier request from function Start here*/


/* AR payment update form validation funcation End */
$(document).on('click','#ArPaymentFormBtn', function(){
	var invoice_amount = $('#invoice_amount').val();
	var amount_paid = $('#amount_paid').val();
	var balance_due = $('#balance_due').val();
	var received_date = $('#received_date').val();
	var deposit_date = $('#deposit_date').val();


	

});
/* AR payment update form validation funcation End */

/* Refrence notification read form first funcation Start */
$(document).on('click','#notification_col', function(){
	var id = $(this).attr('value');
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/notification/read/',
		type: 'get',
		cache : false,
		data: { id:id},
		success: function(data){		
			if(data.url){
				//console.log(data.url);
				window.location.href = HOSTPATH + data.url;
			}
		}
	})
});
/* Refrence notification read form first funcation End */


/* Refrence notification read form validation funcation Start */
$(document).on('click','#loadComment_col', function(){
	var referenc = $(this).attr('value');
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load/ReferencSearchUpdate',
		type: 'get',
		cache : false,
		data: { referenc:referenc},
		success: function(data){
			
			$('.dropdown-menu').css('display','none');
			$('#LoadRefernceSearch').html(data);
			$('#LoadRefernceSearch').modal('show');
		}
	})

});
/* Refrence notification read form validation funcation End */

/* Carrier request messages validation funcation Start */
$(document).on('click','#CarrierRequest_col', function(){
	var carrier_id = $(this).attr('value');
	
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/carrier/request/commentform',
		type: 'get',
		cache : false,
		data: { carrier_id:carrier_id},
		success: function(data){
			
			$('.dropdown-menu').css('display','none');
			$('#LoadRefernceSearch').html(data);
			$('#LoadRefernceSearch').modal('show');
		}
	})

});
/* Carrier request messages validation funcation End */



/* Carrier request messages validation funcation Start */
$(document).on('click','#requestCommentBtn', function(){
	var carrier_id = $('#load_id').val();
	var Comment = $('#requestComment').val();
	var curr    = $('.stat_check').prop('checked');

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/carrier/request/commentUpdate',
		type: 'get',
		cache : false,
		data: { carrier_id:carrier_id,Comment:Comment,curr:curr},
		success: function(data){
			location.reload(true);
		}
	})

});
/* Carrier request messages validation funcation End */


/* User all notification mark read funcation Start */
$(document).on('click','#AllReadNotification', function(){
	var carrier_id = $(this).attr('value');
	
	var result = confirm("Are You Sure read all Notification..!");
		if (result==true) {
			
			$.ajax({
				url: '<?php echo url('/'); ?>/admin/notification/read/all',
				type: 'get',
				cache : false,
				data: { carrier_id:carrier_id},
				success: function(data){
					location.reload(true);
					
				}
			})
			
		}
	
	
});
/* User all notification mark read funcation End */

/* User all message notification mark read funcation Start */
$(document).on('click','#AllReadMessageNotification', function(){
	var carrier_id = $(this).attr('value');
	
	var result = confirm("Are You Sure read all Message Notification..!");
		if (result==true) {
			$.ajax({
				url: '<?php echo url('/'); ?>/admin/notification/message/read/all',
				type: 'get',
				cache : false,
				data: { carrier_id:carrier_id},
				success: function(data){
					location.reload(true);
					
				}
			})
			
		}
	
});
/* User all message notification mark read funcation End */

$(document).on('click','#ShipperRequest_col', function(){
	var id = $(this).attr('value');

	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipper/requset/commentform',
		type: 'get',
		cache : false,
		data: { id:id},
		success: function(data){
			//location.reload(true);
			$('.dropdown-menu').css('display','none');
			$('#ShipperCommentForm').html(data);
			$('#ShipperCommentForm').modal('show');
		}
	})

});

$(document).on('change','#ship_doc_select', function(){
	
	var doc_type = $(this).val();
	var ship_file = $('#ship_doc_file').attr('name', doc_type +'[]');
	//alert(ship_doc);

});



$(document).on('click','#agencyManager', function(){
	var id = $(this).attr('value');
	//alert(id);
	//return false;
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/agency/new/office/'+ id,
		type: 'get',
		cache : false,
		data: { id:id},
		success: function(data){
			
			$('#agencyManagerForm').html(data);
			
		}
	})

});


$(document).on('click','#ship_activity_detail', function(){
	var id = $(this).val();
	//alert(id);
	//return false;
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/load-activity/details/'+id,
		type: 'get',
		cache : false,
		data: { id:id},
		success: function(data){
			$('#loadactivityshipment').html(data);
			$('#loadactivityshipment').modal('show');
		}
	})

});


$(document).on('click','#ShipperCommentBtn', function(){
	var id = $('#Comp_id').val();
	var comment = $('#requestComment').val();
	//var stat_check = $('.stat_check').val();
	var curr    = $('.stat_check').prop('checked');
	// if(curr == true){
	// 	$('.stat_check').val('1');
	// }else{
	// 	$('.stat_check').val('0');
	// }
	// alert(curr);return false;
	if(comment != ''){
		
	$.ajax({
		url: '<?php echo url('/'); ?>/admin/shipper/requset/commentUpdate',
		type: 'get',
		cache : false,
		data: { id:id,comment:comment,curr:curr},
		success: function(data){
			location.reload(true);
		}
	})

}else{
	
	if (comment.length == "") {
		$("#ShipperCommentError").text("Enter some text!");
		return false;
	  }else{ $("#ShipperCommentError").hide(); }
}

});

$(".copy-text").click(function(){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).text()).select();
    document.execCommand("copy");
    $temp.remove();
    $(".copy-text").removeClass("copied");
    $(this).addClass("copied");
});

setTimeout(function(){
    $(".alert-danger").hide();
}, 3000)


/* Carrier quickpay request sent funcation Start */
$(document).on('click','#quickpay_request', function(){


	var result = confirm("You want to sent quickpay request..!");
	if (result==true) {

		var shipment_id = $(this).val();
		var pay_deduct = $('#c_minus').val();
		var quickpay_amount = $('#quickpay_amount').val();

		$.ajax({
			url: '<?php echo url('/'); ?>/admin/carrier/payment/quickpay',
			type: 'get',
			cache : false,
			data: { shipment_id:shipment_id,pay_deduct:pay_deduct,quickpay_amount:quickpay_amount},
			success: function(data){
				
				if(data == 1)
				{
					location.reload(true);
				}
				if(data == 3)
				{
					

					Swal.fire({
						icon: 'warning',
						title: 'Quick Pay',
						text: 'Shipment price update first!',
						showConfirmButton: true
					})
				}
			}	
		})

	}

});

$(document).click(function(e){
    if ($(e.target).closest(".shipment_instruction").length === 0) {
        $(".shipment_instruction").hide();
    }
})

$("button.action").click(function(){
    $(".action_bar").removeClass("action_action");
    $(this).parent().addClass("action_action");
})

$(document).click(function(e) 
{
    if ($(e.target).closest(".action_bar").length
                        === 0) {
        $(".action_bar").removeClass("action_action");
    }
});

$("span.moreoption").click(function(){
    if ($("span.moreoption span").text() == "More") { 
        $("span.moreoption span").text("Less"); 
    } else { 
        $("span.moreoption span").text("More"); 
    }; 
    $(".hide_tr").toggleClass('show_tr');
})

/* Carrier quickpay request sent funcation End */
