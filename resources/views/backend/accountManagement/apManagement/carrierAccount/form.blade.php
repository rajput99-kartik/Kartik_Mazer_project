<?php 

    if(isset($carrdata)){

        $title = 'Edit';

        $form_id = 'Carrier Account';

		    $image_text = 'Update Image';

        $action  =  url('/admin/carrierac/edit/'.$id);

        $user_id = $id;

        //$user_id = '0';

    }else{

        $title = 'Add';

        $form_id = 'carrierac';

		    $image_text = 'Update Image';

        $action  =  url('/admin/carrierac/add');

        // $user_id = $agent_id;

        $user_id = '0';

    }

?>



@extends('backend.layouts.master')

@section('title','Carrier Account')

@section('content')





        <div class="page-wrapper">

            <div class="page-content">

                @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                    </ul>

                </div>

                @endif

                <ul class="nav nav-tabs">

                    @can('uagent-view')

                    <li class="pending_approval"><a href="{{url('/admin/carrierac')}}" data-toggle="tab" aria-expanded="true">Carrier Account</a></li>
                    <li class="pending_approval active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="true">Edit Account</a></li>

                     @endcan

                </ul>

                <div class="row">

                    <div class="col-xl-12 mx-auto">

                        <div class="card border-4 border-primary">

                            <div class="card-body p-3 col-xl-9 mx-auto" style="padding: 0px !important; box-shadow: unset;">

                                <!--<div class="card-title d-flex align-items-center pb-2">-->

                                <!--    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>-->

                                <!--    </div>-->

                                <!--    <h5 class="mb-0 text-primary ">Carrier Account</h5>-->

                                <!--</div>-->

                                <!-- <hr> -->

                                <div class="row g-3">

                                  <form action="{{ $action }}" method="post" id="{{$form_id}}" enctype="multipart/form-data">

                                    @csrf

                                    <div class="c_account_box">

                                        <div class="row">

                                            <div class="col-xs-12 col-sm-12 col-md-12">

                                                <div class="c_acc_box" style="margin-top:0px;">
                                                    <h4>Select Pay To</h4>
                                                    <div class="form-group">
                                                        <select class="form-control" name="payto" id="payto">
                                                            <option disabled selected>- Select -</option>
                                                            <option data="Carrier" value="0" <?php if($carrdata['payto'] == 0){ echo 'selected'; } ?>>Carrier</option>
                                                            <option data="Factoring" value="1" <?php if($carrdata['payto'] == 1){ echo 'selected'; } ?>>Factoring</option>
                                                            <option data="Newaddress" value="2" <?php if($carrdata['payto'] == 2){ echo 'selected'; } ?>>Newaddress</option>
                                                        </select>
                                                        <input type="hidden" name="cid" id="name" value="{{ $user_id }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="pat_to_row" id="Factoring">
                                                    <div class="c_acc_box">
                                                        <h4>Factoring Details</h4>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory NOA:</strong>
                                                                    
                                                                    <div class="custom-file">
                                                                        <input type="file" name="f_noa[]" class="form-control custom-file-input" id="f_noa" multiple="multiple" accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.xls,.xlsx,.doc,.docx">
                                                                        <label class="custom-file-label" for="images"></label>
                                                                        @if($carrdata['payto']==1 && $carrdata['f_noa']!=null)
                                                                        @php
                                                                            $f_noa = explode(',', $carrdata['f_noa']);
                                                                        @endphp
                                                                        @foreach($f_noa as $f_noadoc)
                                                                        <div class="c_acc_doc">
                                                                            <a href="{{url('/public/backend/carrieraccount').'/'.$f_noadoc}}" target="_blank" title="Download" download><img src="{{url('/public/backend/assets/images/doc.png')}}" style="width: 30px; margin-top: 5px; cursor: pointer;"></a>
                                                                            
                                                                            <!--<button docname="{{$f_noadoc}}" accid="{{$carrdata['id']}}" type="button" id="deletedoc"><i class="bx bx-trash"></i></button>-->
                                                                        </div>
                                                                        @endforeach
                                                                        @endif
                                                                    </div> 
    
                                                                    <!--<input type="text" name="f_noa" class="form-control" placeholder="f_noa" value="{{ isset($carrdata['f_noa']) ? $carrdata['f_noa']: old('f_noa') }}">-->
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Company Name:</strong>
    
                                                                    <input type="f_comp_name" name="f_comp_name" class="form-control" placeholder="Factory Company Name" value="{{ isset($carrdata['f_comp_name']) ? $carrdata['f_comp_name']: old('f_comp_name') }}">
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Address</strong>
    
                                                                    <input type="text" name="f_address" placeholder="Factory Address" class="form-control" value="{{ isset($carrdata['f_address']) ? $carrdata['f_address']: old('f_address') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                    
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory City</strong>
    
                                                                    <input type="text" name="f_city" placeholder="Factory City" class="form-control" value="{{ isset($carrdata['f_city']) ? $carrdata['f_city']: old('f_city') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory State</strong>
    
                                                                    <input type="text" name="f_state" placeholder="Factory State" class="form-control" value="{{ isset($carrdata['f_state']) ? $carrdata['f_state']: old('f_state') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Zip</strong>
    
                                                                    <input type="text" name="f_zip" placeholder="Factory Zip" class="form-control" value="{{ isset($carrdata['f_zip']) ? $carrdata['f_zip']: old('f_zip') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Phone</strong>
    
                                                                    <input type="text" name="f_phone" placeholder="Factory Phone" class="form-control" value="{{ isset($carrdata['f_phone']) ? $carrdata['f_phone']: old('f_phone') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Fax</strong>
    
                                                                    <input type="text" name="f_fax" placeholder="Factory Fax" class="form-control" value="{{ isset($carrdata['f_fax']) ? $carrdata['f_fax']: old('f_fax') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                                <div class="form-group">
    
                                                                    <strong>Factory Email</strong>
    
                                                                    <input type="text" name="f_email" placeholder="Factory Email" class="form-control" value="{{ isset($carrdata['f_email']) ? $carrdata['f_email']: old('f_email') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
                                                            </div>
                                                        </div>
                                                        
                                                </div>

                                                

                                                <div class="row pat_to_row" id="Carrier">
                                                    <div class="c_acc_box">
                                                        <h4>Carrier Details</h4>
                                                        <div class="row">
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Company Name:</strong>
    
                                                                    <input type="c_comp_name" name="c_comp_name" class="form-control" placeholder="Carrier Company Name" value="{{ isset($carrdata['c_comp_name']) ? $carrdata['c_comp_name']: old('c_comp_name') }}">
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Address</strong>
    
                                                                    <input type="text" name="c_address" placeholder="Carrier Address" class="form-control" value="{{ isset($carrdata['c_address']) ? $carrdata['c_address']: old('c_address') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                    
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier City</strong>
    
                                                                    <input type="text" name="c_city" placeholder="Carrier City" class="form-control" value="{{ isset($carrdata['c_city']) ? $carrdata['c_city']: old('c_city') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier State</strong>
    
                                                                    <input type="text" name="c_state" placeholder="Carrier State" class="form-control" value="{{ isset($carrdata['c_state']) ? $carrdata['c_state']: old('c_state') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Zip</strong>
    
                                                                    <input type="text" name="c_zip" placeholder="Carrier Zip" class="form-control" value="{{ isset($carrdata['c_zip']) ? $carrdata['c_zip']: old('c_zip') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Phone</strong>
    
                                                                    <input type="text" name="c_phone" placeholder="Carrier Phone" class="form-control" value="{{ isset($carrdata['c_phone']) ? $carrdata['c_phone']: old('c_phone') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Fax</strong>
    
                                                                    <input type="text" name="c_fax" placeholder="Carrier Fax" class="form-control" value="{{ isset($carrdata['c_fax']) ? $carrdata['c_fax']: old('c_fax') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
    
                                                            <div class="col-xs-12 col-sm-12 col-md-6">
    
                                                                <div class="form-group">
    
                                                                    <strong>Carrier Email</strong>
    
                                                                    <input type="text" name="c_email" placeholder="Carrier Email" class="form-control" value="{{ isset($carrdata['c_email']) ? $carrdata['c_email']: old('c_email') }}">
    
                    
    
                                                                </div>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row">
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="c_acc_box">
                                                                    <h4>Select Payment Mode</h4>
                                                                    <div class="form-group">
                                                                        <select class="form-control pay_mode" name="pay_mode">
                                                                            <option disabled selected>- Select -</option>
                                                                            <option data="ACH" value="3" <?php if($carrdata['pay_mode'] == 3){ echo 'selected'; } ?>>ACH</option>
                                                                            <option data="WIRE" value="4" <?php if($carrdata['pay_mode'] == 4){ echo 'selected'; } ?>>WIRE</option>
                                                                            <option data="CHECK" value="5" <?php if($carrdata['pay_mode'] == 5){ echo 'selected'; } ?>>CHECK</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>

                                                

                                            </div>

                                        </div>

                                        

                                    </div>

                                    

                                    <div class="row">

                                        <div  class="col-md-12">

                                            <div class="row payment_mode_row" id="3">
                                                <div class="c_acc_box">
                                                    <h4>Bank Details</h4>
                                                    <div class="row">
    
                                                        <div class="col-xs-12 col-sm-12 col-md-3">
    
                                                            <div class="form-group">
    
                                                                <strong>Bank Name</strong>
    
                                                                <input type="text" name="bank_name" placeholder="Bank Name" class="form-control" value="{{ isset($carrdata['bank_name']) ? $carrdata['bank_name']: old('bank_name') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-3">
    
                                                            <div class="form-group">
    
                                                                <strong>Account Number</strong>
    
                                                                <input type="text" name="account_number" placeholder="Account Number" class="form-control" value="{{ isset($carrdata['account_number']) ? $carrdata['account_number']: old('account_number') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-3">
    
                                                            <div class="form-group">
    
                                                                <strong>Account Type</strong>
    
                                                                <input type="text" name="b_account_type" placeholder="Account Type" class="form-control" value="{{ isset($carrdata['b_account_type']) ? $carrdata['b_account_type']: old('b_account_type') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-3">
    
                                                            <div class="form-group">
                                                                <strong>Routing Number</strong>
                                                                <input type="text" name="ach_routing_number" placeholder="Routing Number" class="form-control" value="{{ isset($carrdata['ach_routing_number']) ? $carrdata['ach_routing_number']: old('ach_routing_number') }}">
                                                            </div>
    
                                                        </div>
    
                                                    </div>
                                                </div>

                                            </div>

                                            

                                            <div class="row payment_mode_row" id="4">
                                                <div class="c_acc_box">
                                                    <h4>Bank Details</h4>
                                                    <div class="row">
    
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                            <div class="form-group">
    
                                                                <strong>Bank Name</strong>
    
                                                                <input type="text" name="w_bank_name" placeholder="Bank Details" class="form-control" value="{{ isset($carrdata['w_bank_name']) ? $carrdata['w_bank_name']: old('w_bank_name') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                            <div class="form-group">
    
                                                                <strong>Account Number</strong>
    
                                                                <input type="text" name="w_account_number" placeholder="Account Number" class="form-control" value="{{ isset($carrdata['w_account_number']) ? $carrdata['w_account_number']: old('w_account_number') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                            <div class="form-group">
    
                                                                <strong>Account Type</strong>
    
                                                                <input type="text" name="wire_b_account_type" placeholder="Account Type" class="form-control" value="{{ isset($carrdata['wire_b_account_type']) ? $carrdata['wire_b_account_type']: old('wire_b_account_type') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                            <div class="form-group">
    
                                                                <strong>Routing Number</strong>
    
                                                                <input type="text" name="wire_routing_number" placeholder="Routing Number" class="form-control" value="{{ isset($carrdata['wire_routing_number']) ? $carrdata['wire_routing_number']: old('wire_routing_number') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                        <div class="col-xs-12 col-sm-12 col-md-4">
    
                                                            <div class="form-group">
    
                                                                <strong>Swift Code</strong>
    
                                                                <input type="text" name="swift_code" placeholder="Swift Code" class="form-control" value="{{ isset($carrdata['swift_code']) ? $carrdata['swift_code']: old('swift_code') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                    </div>
                                                </div>

                                            </div>

                                            

                                            <div class="row payment_mode_row" id="5">
                                                <div class="c_acc_box">
                                                    <h4>Bank Details</h4>
                                                    <div class="row">
    
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
    
                                                            <div class="form-group">
    
                                                                <strong>Address</strong>
    
                                                                <input type="text" name="address" placeholder="Address" class="form-control" value="{{ isset($carrdata['address']) ? $carrdata['address']: old('address') }}">
    
                                                            </div>
    
                                                        </div>
    
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        {{-- <div class="col-xs-12 col-sm-12 col-md-6">

                                          <div class="form-group">

                                              <strong>User List:</strong>

                                                <select name="assignto_id"  class="form-control">

                                                  @foreach($userdata as $r)

                                                    <option value="{{$r->id}}"> {{ $r->name .' ' .$r->officerid }}</option>

                                                  @endforeach

                                              </select>

                                          </div>

                                        </div> --}}



        

                                        <div class="col-12 pt-4">

                                            <button type="submit" class="btn btn-primary ">Update</button>

                                        </div>

                                    </div>                                   

                                  </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <script>

            $(document).ready(function(){

                $("select.form-control").find("option:contains('superadmin')").hide(); 

                
                $("#"+$("select#payto option:selected").attr('data')).fadeIn();
                $("select#payto").change(function(){

                    $(".pat_to_row").hide();

                    $(".payment_mode_row").hide();
                    $("#"+$("select.pay_mode option:selected").attr('value')).fadeIn();
                    $("#"+$("select#payto option:selected").attr('data')).fadeIn();

                })

                
                $("#"+$("select.pay_mode option:selected").attr('value')).fadeIn();
                $('select[name="pay_mode"]').change(function(){

                    $(".payment_mode_row").hide();

                    $("#"+$(this).val()).fadeIn();

                })
                
                //delete doc
                $("button#deletedoc").click(function(){
                    var docname = $(this).attr('docname');
                    var accid = $(this).attr('accid');
                    $.ajax({
                      url: "{{url('/admin/carrierac/delete-doc')}}",
                      type:"POST",
                      data:{
                        "_token": "{{ csrf_token() }}",
                        docname:docname,
                        accid:accid,
                      },
                      success:function(response){
                        alert(response);
                      }
                    });
                })
            })

        </script>

@include('backend.common.footer')

@endsection

