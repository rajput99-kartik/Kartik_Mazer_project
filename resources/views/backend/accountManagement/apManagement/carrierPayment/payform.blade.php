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
                    <li class="pending_approval"><a href="{{url('/admin/carrier/payment/updates')}}" data-toggle="tab" aria-expanded="true">Carrier Account</a></li>
                    <li class="pending_approval active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="true">Edit Account</a></li>
                     @endcan

                </ul>

                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <div class="card border-4 border-primary">
                            <div class="card-body">

                                <!--<div class="card-title d-flex align-items-center pb-2">-->

                                <!--    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>-->

                                <!--    </div>-->

                                <!--    <h5 class="mb-0 text-primary ">Carrier Account</h5>-->

                                <!--</div>-->

                                <!-- <hr> -->

                                <!--<div class="row">-->

                                <!--    <table>-->
                                        
                                <!--        <th>Load No.</th>-->
                                <!--        <th>Carrier Name</th>-->
                                <!--        <th>MC#</th>-->
                                <!--        <th>Aging</th>-->
                                <!--        <th>PayTo</th>-->
                                <!--        <th>Routing</th>-->
                                <!--        <th>Bank Name</th>-->
                                <!--        <th>Account Number</th>-->
                                <!--        <th>Amount</th>-->
                                <!--        <th>Remittance Email</th>-->
                                <!--        <th>Contact Number</th>-->
                                <!--        <th>Action</th>-->
                                <!--    <tbody>-->
                                        
                                        

                                <!--        <tr>-->
                                <!--            <td>{{ isset($shipment_id ) ? $shipment_id : null  }}</td>-->
                                <!--            <td>{{ isset($carrier->c_company_name ) ? $carrier->c_company_name : null  }}</td>-->
                                <!--            <td>{{ isset($carrier->mc_no ) ? $carrier->mc_no : null  }}</td>-->
                                <!--            <td></td>-->
                                <!--            <td></td>-->
                                <!--            <td>{{ isset($carrier_data->routing ) ? $carrier_data->routing : null  }}</td>-->
                                <!--            <td>{{ isset($carrier_data->b_name ) ? $carrier_data->b_name : null  }}</td>-->
                                <!--            <td>{{ isset($carrier_data->acc_number ) ? $carrier_data->acc_number : null  }}</td>-->
                                <!--            <td>{{isset($shipment_price->carrier_total) ? $shipment_price->carrier_total : null}}</td>-->
                                <!--            <td>{{ isset($email) ? $email : null }}</td>-->
                                <!--            <td>{{ isset($phone) ? $phone : null }}</td>-->
                                <!--            <td>-->
                                            
                                <!--            <form method="POST" action="{{ url('admin/carrier/payment/complete', base64_encode($shipment_id)) }}" accept-charset="UTF-8" style="display:inline">-->
                                <!--            @csrf-->
                                <!--            <input name="_method" type="hidden" value="POST">-->
                                <!--            <button onclick="return confirm('You want to Update this payment ..!')" class="btn btn-primary" value="{{ isset($shipment_id ) ? $shipment_id : null  }}" type="submit">Pay</button>-->

                                <!--            </form>-->
                                <!--        </td>-->
                                <!--        </tr>-->
                                        
                                <!--    </tbody>-->
                                <!--</table>-->

                                <!--</div>-->
                                @php
                                    $shipment_price = App\Models\Shipmentrate::where('shipment_id',$shipment_id)->first();

                                        if($carrier_acc->payto == '0'){

                                            $email = $carrier->email;
                                            $phone = $carrier->phone_no;

                                        }elseif($carrier_acc->payto == '1'){

                                            $email = $carrier_acc->f_email;
                                            $phone = $carrier_acc->f_phone;

                                        }
                                        if($carrier_acc->pay_mode == '3'){

                                            $routing = $carrier_acc->ach_routing_number;
                                            $b_name = $carrier_acc->bank_name;
                                            $acc_number = $carrier_acc->account_number;

                                        }elseif($carrier_acc->pay_mode == '4'){

                                            $routing = $carrier_acc->wire_routing_number;
                                            $b_name = $carrier_acc->w_bank_name;
                                            $acc_number = $carrier_acc->w_account_number;
                                            $swift_code = $carrier_acc->swift_code;
                                        } 
                                    @endphp
                                <div  class="card-body p-3 col-xl-9 mx-auto">
                                    <div class="c_payment_update">
                                        <div class="card-title d-flex align-items-center pb-2">
                                            <h5 class="mb-0 text-primary ">Account Details:</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Load No.</h4>
                                                    <p>{{ isset($shipment_id ) ? $shipment_id : null  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Carrier Name</h4>
                                                    <p>{{ isset($carrier->c_company_name ) ? $carrier->c_company_name : null  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>MC#</h4>
                                                    <p>{{ isset($carrier->mc_no ) ? $carrier->mc_no : null  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Aging</h4>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>PayTo<h4>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Routing</h4>
                                                    <p>{{ isset($carrier_data->routing ) ? $carrier_data->routing : null  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Bank Name</h4>
                                                    <p>{{ isset($carrier_data->b_name ) ? $carrier_data->b_name : null  }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Account Number</h4>
                                                    <p>{{isset($shipment_price->acc_number) ? $shipment_price->acc_number : null}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Amount</h4>
                                                    <p>{{isset($shipment_price->carrier_total) ? $shipment_price->carrier_total : null}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Remittance Email</h4>
                                                    <p>{{ isset($email) ? $email : null }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="payment_box">
                                                    <h4>Contact Number</h4>
                                                    <p>{{ isset($phone) ? $phone : null }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="payment_action">
                                                    <form method="POST" action="{{ url('admin/carrier/pending/payment/done', base64_encode($shipment_id)) }}" accept-charset="UTF-8" style="display:inline">
                                                    @csrf
                                                    <button onclick="return confirm('You want to Update this payment ..!')" class="btn btn-primary" value="{{ isset($shipment_id ) ? $shipment_id : null  }}" type="submit">Pay Done</button>
        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </diiv>

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

            })

        </script>

@include('backend.common.footer')

@endsection

