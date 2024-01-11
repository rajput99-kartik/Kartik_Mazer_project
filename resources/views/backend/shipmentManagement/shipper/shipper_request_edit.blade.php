@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
<style>
    .col-md-2.search-or {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    td {
    /* border: 1px solid; */
    }
    .btn-link {
        font-weight: 100;
        color: #213cd1;
        font-size: 12px;
    }
    .btn {
    letter-spacing: 0.5px;
    }


    /* #carrier_table tr:first-child{
                color:green;
    
        } */

        /* #carrier_table tr:first-child{
                background-color:green !important;
                color:white!important;
        }
        
        #carrier_table  tr:nth-child(odd) td {
            color: red;
        }

        #carrier_table  tr:nth-child(even) td {
            color: red;
        } */


        #carrier_table tbody tr:nth-child(odd) td {
            color: #db0f01;
        }

        #carrier_table tbody tr:nth-child(even) td {
            color: #db0f01;
        }

        #carrier_table tbody tr.highlight td {
            color: #515249;
        }

        #carrier_table tbody tr:first-child  td{ 
            color: rgb(24, 80, 1);
            /* color: rgb(71, 6, 6); */
        }

</style>
{{-- this is user for new readmore data --}}
<style>
    #section {
    /* width: 500px;
    height: 400px; */
    word-wrap: break-word;
    overflow: auto;
    }
    .moretext {
        display: none;
        overflow: auto;
        width: 11em;      
        background-color: #f7f9fc;       
        border: 1px solid #f7f9fc;      
        padding: 10px;      
        word-wrap: break-word;      
        font-size: 12px;    
    }
</style>
{{-- this is use for readmore old data --}}
<style>
    .expandable{
        /* border: 1px solid #000; */
        background-color: #f7f9fc;       
        border-top: 1px solid #848588;    
        margin-bottom: 1em;
        }
        /* Hides all the expandees */
        .expandable .expandee {
        display: none;
        }
        /* Shows the expandee when .expanded is added to the parent of expandee */
        .expanded .expandee {
        display: block;
        }
</style>


		<!--start page wrapper -->
		<div class="page-wrapper">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

			<div class="page-content">
				<!--breadcrumb-->
				<ul class="nav nav-tabs">
                    @can('shipper-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a>
                    </li>
                    @endcan
                    @can('shipper-agentshipper')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipper</a></li>
                    @endcan
                    <li class="all_leav"><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>
                        </li>
                    @can('shipper-create')
                        <li class=""><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">Create Shipper</a>
                        </li>
                    @endcan
                    @can('shipper-request')
                        <li class="active"> <a href="{{url('admin/shipper/request')}}" data-toggle="tab" aria-expanded="false"> Shipper Request</a>
                        </li>
                    @endcan
                </ul>
                  <div class="card col-xl-12" style="padding: 20px;">
                            
                            <div class="row">
                                @if($comp_data)
                                <div class="col-md-5">
                                    <div class="req_user_detail">
                                        <h4>Shipper Details:</h4>
                                        <p><b>Company Name: </b> <span>{{ isset($comp_data->company_name) ? $comp_data->company_name : null; }}</span></p>
                                        <p><b>Address: </b> <span>{{ isset($comp_data->address) ? $comp_data->address : null }}</span></p>
                                        <p><b>City: </b> <span>{{ isset($comp_data->shipper_city) ? $comp_data->shipper_city : null; }}</span></p>
                                        <p><b>Zip: </b> <span>{{ isset($comp_data->shipper_zipcode) ? $comp_data->shipper_zipcode : null; }}</span></p>
                                        <p><b>Phone: </b> <span>{{ isset($comp_data->phone_number) ? $comp_data->phone_number : null; }}</span></p>
                                        <p><b>Email: </b> <span>{{ isset($comp_data->email) ? $comp_data->email : null; }}</span></p>
                                        <p><b>Contact: </b> <span>{{ isset($comp_data->contact_name) ? $comp_data->contact_name : null; }}</span></p>
                                        <p><b>Load Referance ID: </b> <span>{{ isset($comp_data->contact_name) ? $comp_data->contact_name : null; }}</span></p>
                                    </div> 
                                </div>
                                <div class="col-md-2 search-or">
                                    <span>OR</span>
                                </div>
                                <div class="col-md-5">
                                    <div class="req_comment">
                                        <h4>Comments:</h4>
                                        
                                        @php
                                            //dd($comp_data);
                                        @endphp
                                        {{-- <div class="form-group">
                                            <strong>Pre-pay Limit:</strong>
                                            <input type="text" name="prepay_limit" id="prepay_limit" class="form-control" value="{{ isset($comp_data->un_secured_limit ) ? $comp_data->un_secured_limit  : null; }}" required>
                                            <span class="error" id="prepay_check"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <strong>Limit:</strong>
                                            <input type="text" name="limit" id="limit" class="form-control" value="{{ isset($comp_data->credit_limit) ? $comp_data->credit_limit : null; }}" required>
                                            <span class="error" id="limitcheck"></span>
                                        </div> --}}

                                        <!-- resources/views/payment/form.blade.php -->


{{-- 
    <label>
        <input type="radio" name="payment_type" value="prepay"> Prepay
    </label>
    <label>
        <input type="radio" name="payment_type" value="limit"> Limit
    </label>

    <div id="prepayAmount" style="display: none;">
        <label for="prepay_amount">Prepay Amount:</label>
        <input type="text" name="prepay_amount">
    </div>

    <div id="limitAmount" style="display: none;">
        <label for="limit_amount">Limit Amount:</label>
        <input type="text" name="limit_amount">
    </div>

    <button type="submit">Submit</button> --}}


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const prepayRadio = document.querySelector('input[value="prepay"]');
        const limitRadio = document.querySelector('input[value="limit"]');
        const prepayAmount = document.getElementById('prepayAmount');
        const limitAmount = document.getElementById('limitAmount');

        prepayRadio.addEventListener('change', function () {
            prepayAmount.style.display = this.checked ? 'block' : 'none';
        });

        limitRadio.addEventListener('change', function () {
            limitAmount.style.display = this.checked ? 'block' : 'none';
        });
    });
</script> --}}

<!-- resources/views/payment/form.blade.php -->


    <label>
        <input type="radio" name="payment_type" value="prepay"> Prepay
    </label>
    <label>
        <input type="radio" name="payment_type" value="limit"> Limit
    </label>

    <div id="prepayAmount" style="display: none;">
        <label for="prepay_amount">Prepay Amount:</label>
        {{-- <input type="number" name="prepay_amount"> --}}
        <input type="number" name="prepay_limit" id="prepay_limit" class="form-control" value="{{ isset($comp_data->un_secured_limit ) ? $comp_data->un_secured_limit  : null; }}" required>
        <span class="error" id="prepay_check"></span>
    </div>

    <div id="limitAmount" style="display: none;">
        <label for="limit_amount">Limit Amount:</label>
        {{-- <input type="text" name="limit_amount"> --}}
        <input type="number" name="limit" id="limit" class="form-control" value="{{ isset($comp_data->credit_limit) ? $comp_data->credit_limit : null; }}" required>
        <span class="error" id="limitcheck"></span>
    </div>

    <button type="button" id="resetValue">Reset</button>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const prepayRadio = document.querySelector('input[value="prepay"]');
        const limitRadio = document.querySelector('input[value="limit"]');
        const prepayAmount = document.getElementById('prepayAmount');
        const limitAmount = document.getElementById('limitAmount');
        const resetValue = document.getElementById('resetValue');
        const resetValueButton = document.querySelector('button[type="button"]');
        
        
        prepayRadio.addEventListener('change', function () {
            prepayAmount.style.display = this.checked ? 'block' : 'none';
            limitAmount.style.display = 'none'; 
        });

        limitRadio.addEventListener('change', function () {
            limitAmount.style.display = this.checked ? 'block' : 'none';
            prepayAmount.style.display = 'none'; 
        });

        resetValueButton.addEventListener('click',function (){
            limitAmount.style.display = 'none'; 
            prepayAmount.style.display = 'none'; 
            document.querySelector('input[name="payment_type"]:checked').checked = false;
            // document.querySelector('input[name="Choose"]:checked').checked = false;

        })

       
    });
</script>


                                           
                                          {{-- <div class="form-group">
                                            <strong>Comment:</strong>
                                            <textarea type="text" name="comment" id="comment" class="form-control" required>
                                                
                                            </textarea>
                                            <span class="error" id="commentcheck"></span>
                                           </div> --}}

                                           <div class="form-group">
                                            <strong>Comment:</strong>
                                            <textarea type="text" name="comment" id="comment" class="form-control" required></textarea>
                                            <span class="error" id="commentcheck"></span>
                                        </div>
                                        

                                          <div class="col-12 pt-4">
                                              <input type="hidden" id="companies_id" value="{{ isset($comp_data->id) ? $comp_data->id: null }}">
                                              <input type="hidden" id="encode_title" name="encode_title" value="{{ isset($comp_data->encode_title) ? $comp_data->encode_title: null }}">
                                              <button type="button" class="btn btn-primary request_update" value="1">Approve</button>
                                              <button onclick="return confirm('Are You Sure You Want to DisApprove This Shipper.!')" class="btn btn-danger  px-4 request_update" value="2" type="button">DisApprove</button>
                                          </div>
                                    </div>
                                </div>
                                @else
                                    No, result found.
                                @endif
                            </div>
                    
                  </div>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive22">
                            <h5>Details of Limit / Pre-Pay</h5>
                            <table class="table mb-0" id="carrier_table" style="table-layout: fixed; width: 100%">
                                <thead class="table-light">
                                    <tr >
                                        <th>No</th>
                                        <th>Pre-pay Limit:</th>
                                        <th>Limit:</th>
                                        <th>Comment:</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="expandables-container">
                                    @php
                                        $i = 1;
                                    @endphp
    
                                    @if (count($comp_history) > 0)
                                        @foreach ($comp_history as $item)
                                            @php
                                                $udata = App\Models\User::where('id',$item->user_id)->get();
                                            @endphp
                                            <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ isset($item->un_secured_limit) ? $item->un_secured_limit : Null }}</td>
                                            <td>{{ isset($item->credit_limit) ? $item->credit_limit : Null }}</td>

                                            @if(!empty($item->comment))
                                                <td id="sectioninfo" class="expandable">   
                                                    <span class="sectionxznew">{{ substr($item->comment ,0,7)   }}</span>
                                                    <p class="expandee">{{ isset($item->comment) ? $item->comment : Null}}</p> 
                                                    <button class="toggle-button btn btn-link" >Read more</button>
                                                </td>
                                             @else
                                            <td> No Comment Found</td>

                                            @endif

                                            <td>{{ isset($udata[0]['name']) ? $udata[0]['name'] : Null }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach                            
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
        <script>
            function toggleContent (options) {
                const {container, expandable, triggerer, autoClose} = options,
                    contents = document.querySelectorAll(container),
                    buttonText = ['Read more', 'Read less'];
                let current = null; // Keeps book of the currently open expandee

                function toggle (e) {
                    const button = e.target;
                    if (!button.matches(triggerer)) {return;} // Quit, an irrelevant element clicked 
                    const commonParent = button.closest(expandable);
                    if (!commonParent) {return;} // Quit, the expandable element was not found
                    if (autoClose && current && button !== current) {
                    // If autoClose is on, closes the current expandee
                    toggle({target: current});
                    }
                    const state = +commonParent.classList.toggle('expanded');
                    button.textContent = buttonText[state];
                    current = state ? button : null;
                }
                // Add click listeners to all elements containing expandables
                contents.forEach(cont => cont.addEventListener('click', toggle));
                }
                // Activate ContentToggler
                toggleContent({
                container: '.expandables-container', // Selector for the elements containing expandable elements
                expandable: '.expandable',   // Selector for expandable elements
                triggerer: '.toggle-button', // Selector for the element triggering expansion
                autoClose: true              // Indicates whether the expanded element is closed when a new element is expanded (optional)
            });
        </script>
@include('backend.common.footer')
@endsection