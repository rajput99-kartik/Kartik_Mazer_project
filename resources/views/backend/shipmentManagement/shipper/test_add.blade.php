<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>AMB - Add Shipper | TMS Software</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A Saas based Transport Management Application" name="description"/>
        <meta content="Shine Logistics LLC" name="author"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="https://tmsstaging.shinelogisticsllc.com/assets/images/favicon.png"> --}}
        <!-- Plugins css -->
       
        <style>
            #prefrence-document-table {
                border: 1px solid #eee;
            }

            a.prefer-doc-delete {
                color: red !important;
            }
        </style>
        <!-- icons -->
       
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.datatables.net/buttons/2.2.1/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/>
        <!-- 'nano' theme -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
        <!-- 'nano' theme -->
        <style>
            #pageloader {
                background: rgba(255, 255, 255, 0.8);
                display: none;
                height: 100%;
                position: fixed;
                width: 100%;
                z-index: 9999;
            }

            div.dataTables_wrapper div.dataTables_filter input {
                width: 280.5px;
                height: 38px !important;
                display: inline-block;
            }

            #pageloader img {
                left: 50%;
                margin-left: -32px;
                margin-top: -32px;
                position: absolute;
                top: 50%;
            }

            .ig {
                padding: 15px 0 0px 15px;
            }

            div.dataTables_wrapper div.dataTables_processing {
                left: 50%;
                margin-left: -32px;
                margin-top: -32px;
                position: absolute;
                top: 50%;
            }

            /* Helpdesk style start*/
            .navbar-vertical .navbar-nav .nav-link>svg {
                margin-right: 1rem;
            }

            .select2-container--default .select2-results__option[aria-selected='true'] {
                font-weight: 600;
            }

            .ticket-replies::-webkit-scrollbar {
                background: #f7fafc;
                height: 6px;
                width: 6px;
            }

            .ticket-replies::-webkit-scrollbar:disabled {
                background: transparent;
            }

            .ticket-replies::-webkit-scrollbar-track {
                height: 10px;
                width: 10px;
            }

            .ticket-replies::-webkit-scrollbar-thumb {
                background: rgba(24, 188, 155, 0.6);
                border-radius: 10px;
            }

            .ticket-replies::-webkit-scrollbar-thumb:hover {
                background: rgba(24, 188, 155, 0.75);
            }

            .ticket-replies::-webkit-scrollbar-thumb:active {
                background: rgba(24, 188, 155, 0.9);
            }

            .ticket-replies::-webkit-scrollbar-thumb:window-inactive {
                background: rgba(24, 188, 155, 0.2);
            }

            .ticket-replies {
                overflow-y: auto;
                max-height: 50rem;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                color: var(--theme-color);
                background-color: var(--theme-color-light);
            }

            .form-control.is-invalid {
                background-image: none;
            }

            .form-control.is-valid, .was-validated .form-control:valid {
                border-color: #28a745;
                padding-left: calc(1.5em + .75rem);
                background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
                background-repeat: no-repeat;
                background-position: center left calc(.375em + .1875rem);
                background-size: calc(.75em + .375rem) calc(.75em + .375rem);
            }

            table.dataTable thead .sorting, table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc, table.dataTable thead .sorting_asc_disabled, table.dataTable thead .sorting_desc_disabled {
                cursor: pointer;
                *cursor: hand:;
                background-repeat: no-repeat;
                background-position: center left;
            }

            div.dataTables_wrapper div.dataTables_processing {
                top: 5%;
            }

            .shipper-status-greyed {
                background-color: #999999;
            }
        </style>
    </head>
    <body>
        <!-- Begin page -->
       
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <!-- <div class="page-title-right"> <ol class="breadcrumb m-0"> <li class="breadcrumb-item"><a href="/">Dashboard</a></li> <li class="breadcrumb-item"><a href="/">Shippers</a></li> <li class="breadcrumb-item active">Add Shipper</li> </ol> </div> -->
                        <h4 class="page-title">Add Shipper</h4>
                    </div>
                  
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="shipperwizard">
                                <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-2">
                                    <li class="nav-item" data-target-form="#compDetailsForm">
                                        <a href="#companydetails" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-account-circle mr-1"></i>
                                            <span class="d-none d-sm-inline">Company Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#contactDetailsForm">
                                        <a href="#contactdetails" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-face-profile mr-1"></i>
                                            <span class="d-none d-sm-inline">Contact Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#paymentDetailsForm">
                                        <a href="#paymentdetails" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-face-profile mr-1"></i>
                                            <span class="d-none d-sm-inline">Payment Details</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-target-form="#commoditiesForm">
                                        <a href="#commodities" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                            <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                            <span class="d-none d-sm-inline">Commodities</span>
                                        </a>
                                    </li>
                                </ul>
                                <label class="text-danger d-none" id="duplicacy_error">
                                    Shipper already exists with similar information <a href="javascript:void(0);" data-toggle="modal" data-target="#reportToAdmin"></a>
                                </label>
                                <div class="tab-content b-0 mb-0 pt-0" data-parsley-check-children="2" data-parsley-validate-if-empty="">
                                    <div class="tab-pane" id="companydetails">
                                        <form id="compDetailsForm" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="company_name" class="col-form-label">
                                                                Company Name<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="company_name" placeholder="Enter Company Name" ="" data-parsley-length="[3,70]" maxlength="70" data-parsley-group="block-1" autocomplete="off" name="company_name" type="text">
                                                            <span id="error_company_name"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="dba" class="col-form-label">
                                                                Doing Business<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="dba" placeholder="Enter Doing Business" data-parsley-length="[3,100]" maxlength="100" ="" autocomplete="off" name="dba" type="text">
                                                            <span id="error_dba"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="display_name" class="col-form-label">Reference name to use</label>
                                                            <select id="display_name" name="display_name" class="form-control">
                                                                <option disabled selected value="">Select Reference Type</option>
                                                                <option value="company_name">Company Name</option>
                                                                <option value="dba">Doing Business</option>
                                                            </select>
                                                            <span id="error_display_name"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="shipper_id" class="col-form-label">
                                                                Industry Type <span class="text-danger">*</span>
                                                            </label>
                                                            <select name="industry_type" id="#" title="industry" class="form-control" >
                                                                <option disabled selected value="">Select Industry Type</option>
                                                                <option value="20">Accommodation and Food Services</option>
                                                                <option value="21">Mining, Quarrying, Oil and Gas Extraction</option>
                                                                <option value="22">Utilities</option>
                                                                <option value="23">Construction</option>
                                                                <option value="24">Manufacturing</option>
                                                                <option value="25">Wholesale Trade</option>
                                                                <option value="26">Retail Trade</option>
                                                                <option value="27">Transportation and Warehousing</option>
                                                                <option value="28">Information</option>
                                                                <option value="29">Real Estate, Rental and Leasing</option>
                                                                <option value="30">Management of Companies and Enterprises</option>
                                                                <option value="31">Administrative, Support, Waste Management and Remediation Services</option>
                                                                <option value="32">Educational Services</option>
                                                                <option value="33">Health Care and Social Assistance (Not included Medicines,drugs)</option>
                                                                <option value="34">Other Services (except Public Administration)</option>
                                                                <option value="35">Financial Activities</option>
                                                                <option value="36">Professional and Business Services</option>
                                                                <option value="37">Trade, Transportation and Utilities supersector</option>
                                                                <option value="38">Industry at a Glance Contacts</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="company_email" class="col-form-label">
                                                                E-mail <span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control email_special_character" id="company_email" placeholder="Enter Company E-mail" data-parsley-length="[3,80]" maxlength="80" ="" autocomplete="off" name="company_email" type="email">
                                                            <span id="error_company_email"></span>
                                                            <span class="email_warning text-danger"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="company_phone" class="col-form-label">
                                                                Phone <span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="company_phone" placeholder="Enter Company Phone" data-toggle="input-mask" data-mask-format="(000) 000-0000" data-parsley-length="[10,10]" minlength="10" data-parsley-error-message="it should be 10 digit long" ="" autocomplete="off" name="company_phone" type="text">
                                                            <span id="error_company_phone"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="company_fax" class="col-form-label">Fax</label>
                                                            <input class="form-control" id="company_fax" placeholder="Enter Company Fax" data-parsley-length="[3,20]" maxlength="20" autocomplete="off" name="company_fax" type="text">
                                                            <span id="error_company_fax"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="website" class="col-form-label">Website</label>
                                                            <input class="form-control" id="website" placeholder="Enter Website" data-parsley-validate="" formnovalidate="formnovalidate" autocomplete="off" name="website" type="url">
                                                            <span id="error_website"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="company_street" class="col-form-label">
                                                                Street Address <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="company_street" name="company_street" class="form-control" placeholder="Enter office street address" data-parsley-length="[1,35]" maxlength="35" >
                                                            <span id="error_company_street"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="company_city" class="col-form-label">
                                                                City <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="company_city" name="company_city" class="form-control" placeholder="Enter office City" data-parsley-length="[2,35]" maxlength="35" >
                                                            <span id="error_company_city"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="company_state" class="col-form-label">
                                                                State<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="company_state" id="select-state" title="state" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select State</option>
                                                                <option value="Alaska">Alaska</option>
                                                                <option value="Alabama">Alabama</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Arizona">Arizona</option>
                                                                <option value="Arkansas">Arkansas</option>
                                                                <option value="California">California</option>
                                                                <option value="Colorado">Colorado</option>
                                                                <option value="Connecticut">Connecticut</option>
                                                                <option value="Delaware">Delaware</option>
                                                                <option value="District of Columbia">District of Columbia</option>
                                                                <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                                                <option value="Florida">Florida</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Hawaii">Hawaii</option>
                                                                <option value="Idaho">Idaho</option>
                                                                <option value="Illinois">Illinois</option>
                                                                <option value="Indiana">Indiana</option>
                                                                <option value="Iowa">Iowa</option>
                                                                <option value="Kansas">Kansas</option>
                                                                <option value="Kentucky">Kentucky</option>
                                                                <option value="Louisiana">Louisiana</option>
                                                                <option value="Maine">Maine</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Maryland">Maryland</option>
                                                                <option value="Massachusetts">Massachusetts</option>
                                                                <option value="Michigan">Michigan</option>
                                                                <option value="Minnesota">Minnesota</option>
                                                                <option value="Mississippi">Mississippi</option>
                                                                <option value="Missouri">Missouri</option>
                                                                <option value="Montana">Montana</option>
                                                                <option value="Nebraska">Nebraska</option>
                                                                <option value="Nevada">Nevada</option>
                                                                <option value="New Hampshire">New Hampshire</option>
                                                                <option value="New Jersey">New Jersey</option>
                                                                <option value="New Mexico">New Mexico</option>
                                                                <option value="New York">New York</option>
                                                                <option value="North Carolina">North Carolina</option>
                                                                <option value="North Dakota">North Dakota</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Ohio">Ohio</option>
                                                                <option value="Oklahoma">Oklahoma</option>
                                                                <option value="Oregon">Oregon</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Pennsylvania">Pennsylvania</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Rhode Island">Rhode Island</option>
                                                                <option value="South Carolina">South Carolina</option>
                                                                <option value="South Dakota">South Dakota</option>
                                                                <option value="Tennessee">Tennessee</option>
                                                                <option value="Texas">Texas</option>
                                                                <option value="Utah">Utah</option>
                                                                <option value="Vermont">Vermont</option>
                                                                <option value="Virgin Islands">Virgin Islands</option>
                                                                <option value="Virginia">Virginia</option>
                                                                <option value="Washington">Washington</option>
                                                                <option value="West Virginia">West Virginia</option>
                                                                <option value="Wisconsin">Wisconsin</option>
                                                                <option value="Wyoming">Wyoming</option>
                                                                <option value="Armed Forces Africa">Armed Forces Africa</option>
                                                                <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                                                <option value="Armed Forces Canada">Armed Forces Canada</option>
                                                                <option value="Armed Forces Europe">Armed Forces Europe</option>
                                                                <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                                                <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                                                <option value="British Columbia">British Columbia</option>
                                                                <option value="Ontario">Ontario</option>
                                                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                                                <option value="Nova Scotia">Nova Scotia</option>
                                                                <option value="Prince Edward Island">Prince Edward Island</option>
                                                                <option value="New Brunswick">New Brunswick</option>
                                                                <option value="Quebec">Quebec</option>
                                                                <option value="Manitoba">Manitoba</option>
                                                                <option value="Saskatchewan">Saskatchewan</option>
                                                                <option value="Alberta">Alberta</option>
                                                                <option value="Northwest Territories">Northwest Territories</option>
                                                                <option value="Nunavut">Nunavut</option>
                                                                <option value="Yukon Territory">Yukon Territory</option>
                                                            </select>
                                                            <span id="error_company_state"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="company_country" class="col-form-label">
                                                                Country<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="company_country" id="select-country" title="country" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Country</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="United States">United States</option>
                                                            </select>
                                                            <span id="error_company_country"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="company_zip" class="col-form-label">
                                                                Zip<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="company_zip" name="company_zip" class="form-control zip_code_shipper" placeholder="Enter company Zip" data-parsley-length="[5,6]" minlength="5" maxlength="6" >
                                                            <span id="error_company_zip"></span>
                                                        </div>
                                                    </div>
                                                    <h4 class="header-title mt-2 mb-0">Company Details</h4>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="type_of_business" class="col-form-label">
                                                                Type Of Business<span class="text-danger">*</span>
                                                            </label>
                                                            <select id="type_of_business" name="type_of_business" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Business Type</option>
                                                                <option value="LLC">LLC</option>
                                                                <option value="Corporation">Corporation</option>
                                                                <option value="Parternship">Parternship</option>
                                                                <option value="Individual">Individual</option>
                                                            </select>
                                                            <span id="error_type_of_business"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="yrs_in_business" class="col-form-label">Years In Business</label>
                                                            <input class="form-control" id="yrs_in_business" placeholder="Enter Yrs in business" data-parsley-validate="" data-parsley-length="[1,3]" maxlength="3" autocomplete="off" name="yrs_in_business" type="text">
                                                            <span id="error_yrs_in_business"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="location" class="col-form-label">
                                                                Location<span class="text-danger">*</span>
                                                            </label>
                                                            <select id="location" name="location" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Location</option>
                                                                <option value="Residential">Residential</option>
                                                                <option value="Commercial">Commercial</option>
                                                            </select>
                                                            <span id="error_location"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="incorp_state" class="col-form-label">
                                                                Incorporation State<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="incorp_state" id="select-incorp-state" title="incorp_state" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Incorporation State</option>
                                                                <option value="Alaska">Alaska</option>
                                                                <option value="Alabama">Alabama</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Arizona">Arizona</option>
                                                                <option value="Arkansas">Arkansas</option>
                                                                <option value="California">California</option>
                                                                <option value="Colorado">Colorado</option>
                                                                <option value="Connecticut">Connecticut</option>
                                                                <option value="Delaware">Delaware</option>
                                                                <option value="District of Columbia">District of Columbia</option>
                                                                <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                                                <option value="Florida">Florida</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Hawaii">Hawaii</option>
                                                                <option value="Idaho">Idaho</option>
                                                                <option value="Illinois">Illinois</option>
                                                                <option value="Indiana">Indiana</option>
                                                                <option value="Iowa">Iowa</option>
                                                                <option value="Kansas">Kansas</option>
                                                                <option value="Kentucky">Kentucky</option>
                                                                <option value="Louisiana">Louisiana</option>
                                                                <option value="Maine">Maine</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Maryland">Maryland</option>
                                                                <option value="Massachusetts">Massachusetts</option>
                                                                <option value="Michigan">Michigan</option>
                                                                <option value="Minnesota">Minnesota</option>
                                                                <option value="Mississippi">Mississippi</option>
                                                                <option value="Missouri">Missouri</option>
                                                                <option value="Montana">Montana</option>
                                                                <option value="Nebraska">Nebraska</option>
                                                                <option value="Nevada">Nevada</option>
                                                                <option value="New Hampshire">New Hampshire</option>
                                                                <option value="New Jersey">New Jersey</option>
                                                                <option value="New Mexico">New Mexico</option>
                                                                <option value="New York">New York</option>
                                                                <option value="North Carolina">North Carolina</option>
                                                                <option value="North Dakota">North Dakota</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Ohio">Ohio</option>
                                                                <option value="Oklahoma">Oklahoma</option>
                                                                <option value="Oregon">Oregon</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Pennsylvania">Pennsylvania</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Rhode Island">Rhode Island</option>
                                                                <option value="South Carolina">South Carolina</option>
                                                                <option value="South Dakota">South Dakota</option>
                                                                <option value="Tennessee">Tennessee</option>
                                                                <option value="Texas">Texas</option>
                                                                <option value="Utah">Utah</option>
                                                                <option value="Vermont">Vermont</option>
                                                                <option value="Virgin Islands">Virgin Islands</option>
                                                                <option value="Virginia">Virginia</option>
                                                                <option value="Washington">Washington</option>
                                                                <option value="West Virginia">West Virginia</option>
                                                                <option value="Wisconsin">Wisconsin</option>
                                                                <option value="Wyoming">Wyoming</option>
                                                                <option value="Armed Forces Africa">Armed Forces Africa</option>
                                                                <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                                                <option value="Armed Forces Canada">Armed Forces Canada</option>
                                                                <option value="Armed Forces Europe">Armed Forces Europe</option>
                                                                <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                                                <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                                                <option value="British Columbia">British Columbia</option>
                                                                <option value="Ontario">Ontario</option>
                                                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                                                <option value="Nova Scotia">Nova Scotia</option>
                                                                <option value="Prince Edward Island">Prince Edward Island</option>
                                                                <option value="New Brunswick">New Brunswick</option>
                                                                <option value="Quebec">Quebec</option>
                                                                <option value="Manitoba">Manitoba</option>
                                                                <option value="Saskatchewan">Saskatchewan</option>
                                                                <option value="Alberta">Alberta</option>
                                                                <option value="Northwest Territories">Northwest Territories</option>
                                                                <option value="Nunavut">Nunavut</option>
                                                                <option value="Yukon Territory">Yukon Territory</option>
                                                            </select>
                                                            <span id="error_incorp_state"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="fed_tax_id" class="col-form-label">Fed Tax Id</label>
                                                            <input class="form-control" id="fed_tax_id" placeholder="Enter Fed Tax ID" data-parsley-length="[9,9]" minlength="9" maxlength="9" autocomplete="off" name="fed_tax_id" type="text">
                                                            <span id="error_fed_tax_id"></span>
                                                        </div>
                                                        <!--div class="col-md-3"> <label for="dnb" class="col-form-label">D&B</label> <input class="form-control" id="dnb" placeholder="Enter D&amp;B" name="dnb" type="text"> <span id="error_dnb"> </span> </div-->
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                            <ul class="list-inline wizard mb-0">
                                                <li class="next list-inline-item float-right">
                                                    <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="contactdetails">
                                        <form id="contactDetailsForm" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="header-title mt-1 mb-0">Shipping Manager Details</h4>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="smanager_fname" class="col-form-label">
                                                                First Name<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="smanager_fname" placeholder="Enter First Name" ="" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="smanager_fname" type="text">
                                                            <span id="error_smanager_fname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="smanager_lname" class="col-form-label">
                                                                Last Name<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="smanager_lname" placeholder="Enter Last Name" ="" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="smanager_lname" type="text">
                                                            <span id="error_smanager_lname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="smanager_phone" class="col-form-label">
                                                                Phone<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="smanager_phone" placeholder="Enter Phone Number" data-toggle="input-mask" data-mask-format="(000) 000-0000" data-parsley-length="[10,10]" maxlength="10" data-parsley-error-message="it should be 10 digit long" ="" autocomplete="off" name="smanager_phone" type="text">
                                                            <span id="error_smanager_phone"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="smanager_email" class="col-form-label">
                                                                Email<span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" id="smanager_email" placeholder="Enter Email Address" ="" data-parsley-length="[1,80]" maxlength="80" autocomplete="off" name="smanager_email" type="email">
                                                            <span id="error_smanager_email"></span>
                                                        </div>
                                                    </div>
                                                    <h4 class="header-title mt-2 mb-0">Owner Details</h4>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="same_as_shipping_manager">Same as Shipping Manager 
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-3">
                                                            <label for="owner_fname" class="col-form-label">First Name</label>
                                                            <input class="form-control" id="owner_fname" placeholder="Enter Owner First Name" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="owner_fname" type="text">
                                                            <span id="error_owner_fname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="owner_lname" class="col-form-label">Last Name</label>
                                                            <input class="form-control" id="owner_lname" placeholder="Enter Owner Last Name" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="owner_lname" type="text">
                                                            <span id="error_owner_lname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="owner_phone" class="col-form-label">Phone</label>
                                                            <input class="form-control" id="owner_phone" data-toggle="input-mask" data-mask-format="(000) 000-0000" data-parsley-length="[10,10]" maxlength="10" data-parsley-error-message="it should be 10 digit long" placeholder="Enter Owner Phone Number" autocomplete="off" name="owner_phone" type="text">
                                                            <span id="error_owner_phone"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="owner_email" class="col-form-label">Email</label>
                                                            <input class="form-control" id="owner_email" placeholder="Enter Owner Email Address" data-parsley-length="[1,80]" maxlength="80" autocomplete="off" name="owner_email" type="text">
                                                            <span id="error_owner_email"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="same_as_company">Same as company 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="owner_street" class="col-form-label">Street Address</label>
                                                            <input type="text" id="owner_street" name="owner_street" class="form-control" data-parsley-length="[1,80]" maxlength="80" placeholder="Enter street address">
                                                            <span id="error_owner_street"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="owner_city" class="col-form-label">City</label>
                                                            <input type="text" id="owner_city" name="owner_city" class="form-control" data-parsley-length="[2,35]" maxlength="35" placeholder="Enter City">
                                                            <span id="error_owner_city"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="owner_state" class="col-form-label">State</label>
                                                            <select name="owner_state" id="select-state2" title="state" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select State</option>
                                                                <option value="Alaska">Alaska</option>
                                                                <option value="Alabama">Alabama</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Arizona">Arizona</option>
                                                                <option value="Arkansas">Arkansas</option>
                                                                <option value="California">California</option>
                                                                <option value="Colorado">Colorado</option>
                                                                <option value="Connecticut">Connecticut</option>
                                                                <option value="Delaware">Delaware</option>
                                                                <option value="District of Columbia">District of Columbia</option>
                                                                <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                                                <option value="Florida">Florida</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Hawaii">Hawaii</option>
                                                                <option value="Idaho">Idaho</option>
                                                                <option value="Illinois">Illinois</option>
                                                                <option value="Indiana">Indiana</option>
                                                                <option value="Iowa">Iowa</option>
                                                                <option value="Kansas">Kansas</option>
                                                                <option value="Kentucky">Kentucky</option>
                                                                <option value="Louisiana">Louisiana</option>
                                                                <option value="Maine">Maine</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Maryland">Maryland</option>
                                                                <option value="Massachusetts">Massachusetts</option>
                                                                <option value="Michigan">Michigan</option>
                                                                <option value="Minnesota">Minnesota</option>
                                                                <option value="Mississippi">Mississippi</option>
                                                                <option value="Missouri">Missouri</option>
                                                                <option value="Montana">Montana</option>
                                                                <option value="Nebraska">Nebraska</option>
                                                                <option value="Nevada">Nevada</option>
                                                                <option value="New Hampshire">New Hampshire</option>
                                                                <option value="New Jersey">New Jersey</option>
                                                                <option value="New Mexico">New Mexico</option>
                                                                <option value="New York">New York</option>
                                                                <option value="North Carolina">North Carolina</option>
                                                                <option value="North Dakota">North Dakota</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Ohio">Ohio</option>
                                                                <option value="Oklahoma">Oklahoma</option>
                                                                <option value="Oregon">Oregon</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Pennsylvania">Pennsylvania</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Rhode Island">Rhode Island</option>
                                                                <option value="South Carolina">South Carolina</option>
                                                                <option value="South Dakota">South Dakota</option>
                                                                <option value="Tennessee">Tennessee</option>
                                                                <option value="Texas">Texas</option>
                                                                <option value="Utah">Utah</option>
                                                                <option value="Vermont">Vermont</option>
                                                                <option value="Virgin Islands">Virgin Islands</option>
                                                                <option value="Virginia">Virginia</option>
                                                                <option value="Washington">Washington</option>
                                                                <option value="West Virginia">West Virginia</option>
                                                                <option value="Wisconsin">Wisconsin</option>
                                                                <option value="Wyoming">Wyoming</option>
                                                                <option value="Armed Forces Africa">Armed Forces Africa</option>
                                                                <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                                                <option value="Armed Forces Canada">Armed Forces Canada</option>
                                                                <option value="Armed Forces Europe">Armed Forces Europe</option>
                                                                <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                                                <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                                                <option value="British Columbia">British Columbia</option>
                                                                <option value="Ontario">Ontario</option>
                                                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                                                <option value="Nova Scotia">Nova Scotia</option>
                                                                <option value="Prince Edward Island">Prince Edward Island</option>
                                                                <option value="New Brunswick">New Brunswick</option>
                                                                <option value="Quebec">Quebec</option>
                                                                <option value="Manitoba">Manitoba</option>
                                                                <option value="Saskatchewan">Saskatchewan</option>
                                                                <option value="Alberta">Alberta</option>
                                                                <option value="Northwest Territories">Northwest Territories</option>
                                                                <option value="Nunavut">Nunavut</option>
                                                                <option value="Yukon Territory">Yukon Territory</option>
                                                            </select>
                                                            <span id="error_owner_state"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=" form-group col-md-3">
                                                            <label for="owner_country" class="col-form-label">Country</label>
                                                            <select name="owner_country" id="select-country2" title="country" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Country</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="United States">United States</option>
                                                            </select>
                                                            <span id="error_owner_country"></span>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="owner_zip" class="col-form-label">Zip</label>
                                                            <input type="text" id="owner_zip" name="owner_zip" class="form-control zip_code_shipper" data-parsley-length="[5,6]" maxlength="6" placeholder="Enter Zip">
                                                            <span id="error_owner_zip"></span>
                                                        </div>
                                                    </div>
                                                    <h4 class="header-title mt-2 mb-1">Billing Details </h4>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="radio radio-primary form-check-inline">
                                                                <input type="radio" name="billing_type" value="internal" checked>
                                                                <label for="billing_type">Internal Billing </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="radio radio-primary form-check-inline">
                                                                <input type="radio" name="billing_type" value="additional">
                                                                <label for="billing_type">Additional Billing </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="additional_billing">
                                                        <div class="col-md-3">
                                                            <label for="billing_company_name" class="col-form-label">Company Name</label>
                                                            <input class="form-control" id="billing_company_name" placeholder="Enter Company Name" data-parsley-length="[3,70]" maxlength="70" autocomplete="off" name="billing_company_name" type="text">
                                                            <span id="error_billing_company_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <input type="checkbox" id="same_as_owner">Same as owner 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label for="billing_fname" class="col-form-label">First Name</label>
                                                            <input class="form-control" id="billing_fname" placeholder="Enter First Name" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="billing_fname" type="text">
                                                            <span id="error_billing_fname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_lname" class="col-form-label">Last Name</label>
                                                            <input class="form-control" id="billing_lname" placeholder="Enter Last Name" data-parsley-length="[2,30]" maxlength="30" autocomplete="off" name="billing_lname" type="text">
                                                            <span id="error_billing_lname"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_phone" class="col-form-label">Phone</label>
                                                            <input class="form-control" id="billing_phone" data-toggle="input-mask" data-mask-format="(000) 000-0000" data-parsley-length="[10,10]" maxlength="10" data-parsley-error-message="it should be 10 digit long" placeholder="Enter Phone Number" autocomplete="off" name="billing_phone" type="text">
                                                            <span id="error_billing_phone"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_email" class="col-form-label">Email</label>
                                                            <input class="form-control" id="billing_email" placeholder="Enter Email" data-parsley-length="[1,80]" maxlength="80" autocomplete="off" ="" name="billing_email" type="text">
                                                            <span id="error_billing_email"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_fax" class="col-form-label">Fax</label>
                                                            <input class="form-control" id="billing_fax" placeholder="Enter Fax" data-parsley-length="[3,20]" maxlength="20" autocomplete="off" name="billing_fax" type="text">
                                                            <span id="error_billing_fax"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 mb-3">
                                                        <div class="col-md-12">
                                                            <div class="mail-section">
                                                                <div class="emails-labels">
                                                                    <label for="billing_email" class="col-form-label">Email</label>
                                                                    <button type="button" id="add-more-email">
                                                                        <i class="fa fa-plus"></i>
                                                                        Add More
                                                                    </button>
                                                                </div>
                                                                <!-- Container Extra Email -->
                                                                <div id="more-emails" for="add_multiple_emails">
                                                                    <div class="input-group">
                                                                        <input ="" type="email" id="billing_email" name="billing_email[]" class="form-control seprate_comma_validation" placeholder="Enter E-mail" value="">
                                                                    </div>
                                                                </div>
                                                                <span id="error_billing_email"></span>
                                                                <span class="warning_message text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="row">
                                                        <input type="checkbox" id="same_as_company2">Same as company address 
                                                    </div>
                                                    <div class="row mt-1">
                                                        <div class="col-md-3">
                                                            <label for="billing_state" class="col-form-label">
                                                                Street Address<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="billing_street" name="billing_street" class="form-control" data-parsley-length="[1,80]" maxlength="80" placeholder="Enter street address" >
                                                            <span id="error_billing_street"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_city" class="col-form-label">
                                                                City<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="billing_city" name="billing_city" class="form-control" data-parsley-length="[2,35]" maxlength="80" placeholder="Enter City" >
                                                            <span id="error_billing_city"></span>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="billing_state" class="col-form-label">
                                                                State<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="billing_state" id="select-state3" title="state" class="form-control" data-parsley-="true" data-parsley-trigger="change" >
                                                                <option disabled selected value="">Select State</option>
                                                                <option value="Alaska">Alaska</option>
                                                                <option value="Alabama">Alabama</option>
                                                                <option value="American Samoa">American Samoa</option>
                                                                <option value="Arizona">Arizona</option>
                                                                <option value="Arkansas">Arkansas</option>
                                                                <option value="California">California</option>
                                                                <option value="Colorado">Colorado</option>
                                                                <option value="Connecticut">Connecticut</option>
                                                                <option value="Delaware">Delaware</option>
                                                                <option value="District of Columbia">District of Columbia</option>
                                                                <option value="Federated States of Micronesia">Federated States of Micronesia</option>
                                                                <option value="Florida">Florida</option>
                                                                <option value="Georgia">Georgia</option>
                                                                <option value="Guam">Guam</option>
                                                                <option value="Hawaii">Hawaii</option>
                                                                <option value="Idaho">Idaho</option>
                                                                <option value="Illinois">Illinois</option>
                                                                <option value="Indiana">Indiana</option>
                                                                <option value="Iowa">Iowa</option>
                                                                <option value="Kansas">Kansas</option>
                                                                <option value="Kentucky">Kentucky</option>
                                                                <option value="Louisiana">Louisiana</option>
                                                                <option value="Maine">Maine</option>
                                                                <option value="Marshall Islands">Marshall Islands</option>
                                                                <option value="Maryland">Maryland</option>
                                                                <option value="Massachusetts">Massachusetts</option>
                                                                <option value="Michigan">Michigan</option>
                                                                <option value="Minnesota">Minnesota</option>
                                                                <option value="Mississippi">Mississippi</option>
                                                                <option value="Missouri">Missouri</option>
                                                                <option value="Montana">Montana</option>
                                                                <option value="Nebraska">Nebraska</option>
                                                                <option value="Nevada">Nevada</option>
                                                                <option value="New Hampshire">New Hampshire</option>
                                                                <option value="New Jersey">New Jersey</option>
                                                                <option value="New Mexico">New Mexico</option>
                                                                <option value="New York">New York</option>
                                                                <option value="North Carolina">North Carolina</option>
                                                                <option value="North Dakota">North Dakota</option>
                                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                <option value="Ohio">Ohio</option>
                                                                <option value="Oklahoma">Oklahoma</option>
                                                                <option value="Oregon">Oregon</option>
                                                                <option value="Palau">Palau</option>
                                                                <option value="Pennsylvania">Pennsylvania</option>
                                                                <option value="Puerto Rico">Puerto Rico</option>
                                                                <option value="Rhode Island">Rhode Island</option>
                                                                <option value="South Carolina">South Carolina</option>
                                                                <option value="South Dakota">South Dakota</option>
                                                                <option value="Tennessee">Tennessee</option>
                                                                <option value="Texas">Texas</option>
                                                                <option value="Utah">Utah</option>
                                                                <option value="Vermont">Vermont</option>
                                                                <option value="Virgin Islands">Virgin Islands</option>
                                                                <option value="Virginia">Virginia</option>
                                                                <option value="Washington">Washington</option>
                                                                <option value="West Virginia">West Virginia</option>
                                                                <option value="Wisconsin">Wisconsin</option>
                                                                <option value="Wyoming">Wyoming</option>
                                                                <option value="Armed Forces Africa">Armed Forces Africa</option>
                                                                <option value="Armed Forces Americas (except Canada)">Armed Forces Americas (except Canada)</option>
                                                                <option value="Armed Forces Canada">Armed Forces Canada</option>
                                                                <option value="Armed Forces Europe">Armed Forces Europe</option>
                                                                <option value="Armed Forces Middle East">Armed Forces Middle East</option>
                                                                <option value="Armed Forces Pacific">Armed Forces Pacific</option>
                                                                <option value="British Columbia">British Columbia</option>
                                                                <option value="Ontario">Ontario</option>
                                                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                                                <option value="Nova Scotia">Nova Scotia</option>
                                                                <option value="Prince Edward Island">Prince Edward Island</option>
                                                                <option value="New Brunswick">New Brunswick</option>
                                                                <option value="Quebec">Quebec</option>
                                                                <option value="Manitoba">Manitoba</option>
                                                                <option value="Saskatchewan">Saskatchewan</option>
                                                                <option value="Alberta">Alberta</option>
                                                                <option value="Northwest Territories">Northwest Territories</option>
                                                                <option value="Nunavut">Nunavut</option>
                                                                <option value="Yukon Territory">Yukon Territory</option>
                                                            </select>
                                                            <span id="error_billing_state"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class=" form-group col-md-3">
                                                            <label for="billing_country" class="col-form-label">
                                                                Country<span class="text-danger">*</span>
                                                            </label>
                                                            <select name="billing_country" id="select-country3" title="country" class="form-control" data-parsley-="true" data-parsley-trigger="change" >
                                                                <option disabled selected value="">Select Country</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="United States">United States</option>
                                                            </select>
                                                            <span id="error_billing_country"></span>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="billing_zip" class="col-form-label">
                                                                Zip<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="billing_zip" name="billing_zip" class="form-control zip_code_shipper" maxlength="6" data-parsley-length="[5,6]" placeholder="Enter Zip" >
                                                            <span id="error_billing_zip"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline wizard mb-0">
                                                <li class="previous list-inline-item">
                                                    <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                </li>
                                                <li class="next list-inline-item float-right">
                                                    <a href="javascript: void(0);" class="btn btn-secondary next_button_disable">Next</a>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="paymentdetails">
                                        <form id="paymentDetailsForm" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="header-title mt-1 mb-0">Payment Details</h4>
                                                    <div class="row form-group mt-3">
                                                        <div class="col-md-2">
                                                            <label for="isPrepaid">Is this Shipper Pre-Paid ?</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="isPrepaid" name="isPrepaid" id="isPrepaid">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3 payments_term">
                                                            <label for="payment_term" class="col-form-label">Payments Terms</label>
                                                            <select id="payment_term" name="payment_term" class="form-control ">
                                                                <option disabled selected value="">Select Payment Term</option>
                                                                <option value="1">Net 7</option>
                                                                <option value="2">Net 15</option>
                                                                <option value="3">Net 30</option>
                                                                <option value="4">Net 45</option>
                                                                <option value="5">Net 60</option>
                                                                <option value="6">On Delivery</option>
                                                                <option value=""></option>
                                                            </select>
                                                            <span id="error_payment_term"></span>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="payment_method" class="col-form-label">Payments Method</label>
                                                            <select id="payment_method" name="payment_method" class="form-control" data-parsley-="true" data-parsley-trigger="change">
                                                                <option disabled selected value="">Select Payment Method</option>
                                                                <option value="Check">Check</option>
                                                                <option value="Direct Deposit">Direct Deposit</option>
                                                                <option value="Credit Card">Credit Card</option>
                                                                <option value="E-check">E-check</option>
                                                                <option value="Wire">Wire</option>
                                                            </select>
                                                            <span id="error_payment_method"></span>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="invoice_method" class="col-form-label">Method of Invoicing </label>
                                                            <br>
                                                            <div class="checkbox checkbox-primary form-check-inline">
                                                                <input type="checkbox" id="invoice_method_1" name="invoice_method[]" value="E-mail">
                                                                <label for="invoice_method">E-mail </label>
                                                            </div>
                                                            <div class="checkbox checkbox-primary form-check-inline">
                                                                <input type="checkbox" id="invoice_method_2" name="invoice_method[]" value="Paper">
                                                                <label for="invoice_method">Paper </label>
                                                            </div>
                                                            <span id="error_invoice_method"></span>
                                                        </div>
                                                        <div class="form-group col-md-3 credits_limit_requested">
                                                            <label for="credit_limit_requested" class="col-form-label">
                                                                Credit Limit Requested <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" id="credit_limit_requested" name="credit_limit_requested" class="form-control numeric" data-parsley-length="[1,10000]" maxlength="80" placeholder="Enter Credit Limit" >
                                                            <span id="error_credit_limit_requested"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <h4 class="header-title mt-1 mb-0">Prefrence Document</h4>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="prefrence_document" class="col-form-label">Add Prefrence Document</label>
                                                            <select id="prefer_document" name="prefer_document" class="form-control">
                                                                <option selected value="">Select Document</option>
                                                                <option value="1" data-docdetail="{&quot;id&quot;:1,&quot;name&quot;:&quot;Partner Hire Agreement&quot;,&quot;optional&quot;:true}">Partner Hire Agreement</option>
                                                                ; <option value="2" data-docdetail="{&quot;id&quot;:2,&quot;name&quot;:&quot;Direct Deposit Form&quot;,&quot;optional&quot;:true}">Direct Deposit Form</option>
                                                                ; <option value="3" data-docdetail="{&quot;id&quot;:3,&quot;name&quot;:&quot;Passport&quot;,&quot;optional&quot;:true}">Passport</option>
                                                                ; <option value="4" data-docdetail="{&quot;id&quot;:4,&quot;name&quot;:&quot;Bank Details&quot;,&quot;optional&quot;:true}">Bank Details</option>
                                                                ; <option value="5" data-docdetail="{&quot;id&quot;:5,&quot;name&quot;:&quot;PAN Card&quot;,&quot;optional&quot;:true}">PAN Card</option>
                                                                ; <option value="6" data-docdetail="{&quot;id&quot;:6,&quot;name&quot;:&quot;Aadhaar Card&quot;,&quot;optional&quot;:true}">Aadhaar Card</option>
                                                                ; <option value="7" data-docdetail="{&quot;id&quot;:7,&quot;name&quot;:&quot;Void Cheque&quot;,&quot;optional&quot;:true}">Void Cheque</option>
                                                                ; <option value="8" data-docdetail="{&quot;id&quot;:8,&quot;name&quot;:&quot;Driving License&quot;,&quot;optional&quot;:true}">Driving License</option>
                                                                ; <option value="9" data-docdetail="{&quot;id&quot;:9,&quot;name&quot;:&quot;Company Registration&quot;,&quot;optional&quot;:true}">Company Registration</option>
                                                                ; <option value="10" data-docdetail="{&quot;id&quot;:10,&quot;name&quot;:&quot;GST Certificate Copy&quot;,&quot;optional&quot;:true}">GST Certificate Copy</option>
                                                                ; <option value="11" data-docdetail="{&quot;id&quot;:11,&quot;name&quot;:&quot;W8BEN&quot;,&quot;optional&quot;:true}">W8BEN</option>
                                                                ; <option value="12" data-docdetail="{&quot;id&quot;:12,&quot;name&quot;:&quot;SOS File&quot;,&quot;optional&quot;:true}">SOS File</option>
                                                                ; <option value="13" data-docdetail="{&quot;id&quot;:13,&quot;name&quot;:&quot;Shipper Packet&quot;,&quot;optional&quot;:true}">Shipper Packet</option>
                                                                ; <option value="14" data-docdetail="{&quot;id&quot;:14,&quot;name&quot;:&quot;Shipper Profile&quot;,&quot;optional&quot;:true}">Shipper Profile</option>
                                                                ; <option value="15" data-docdetail="{&quot;id&quot;:15,&quot;name&quot;:&quot;Shipper Credit References&quot;,&quot;optional&quot;:true}">Shipper Credit References</option>
                                                                ; <option value="16" data-docdetail="{&quot;id&quot;:16,&quot;name&quot;:&quot;Credit Check&quot;,&quot;optional&quot;:true}">Credit Check</option>
                                                                ; <option value="17" data-docdetail="{&quot;id&quot;:17,&quot;name&quot;:&quot;SOS File&quot;,&quot;optional&quot;:true}">SOS File</option>
                                                                ; <option value="18" data-docdetail="{&quot;id&quot;:18,&quot;name&quot;:&quot;PACA License&quot;,&quot;optional&quot;:true}">PACA License</option>
                                                                ; <option value="19" data-docdetail="{&quot;id&quot;:19,&quot;name&quot;:&quot;Credit Card authorization&quot;,&quot;optional&quot;:true}">Credit Card authorization</option>
                                                                ; <option value="20" data-docdetail="{&quot;id&quot;:20,&quot;name&quot;:&quot;Other&quot;,&quot;optional&quot;:true}">Other</option>
                                                                ; <option value="21" disabled>Shipper Load Confirmation</option>
                                                                ; <option value="22" data-docdetail="{&quot;id&quot;:22,&quot;name&quot;:&quot;Carrier Rate Confirmation&quot;,&quot;optional&quot;:true}">Carrier Rate Confirmation</option>
                                                                ; <option value="23" data-docdetail="{&quot;id&quot;:23,&quot;name&quot;:&quot;Bill of Lading&quot;,&quot;optional&quot;:true}">Bill of Lading</option>
                                                                ; <option value="24" data-docdetail="{&quot;id&quot;:24,&quot;name&quot;:&quot;Proof of Delivery&quot;,&quot;optional&quot;:true}">Proof of Delivery</option>
                                                                ; <option value="25" data-docdetail="{&quot;id&quot;:25,&quot;name&quot;:&quot;Scale Tickets&quot;,&quot;optional&quot;:true}">Scale Tickets</option>
                                                                ; <option value="26" data-docdetail="{&quot;id&quot;:26,&quot;name&quot;:&quot;Revised Carrier Rate Confirmation&quot;,&quot;optional&quot;:true}">Revised Carrier Rate Confirmation</option>
                                                                ; <option value="27" data-docdetail="{&quot;id&quot;:27,&quot;name&quot;:&quot;Revised Shipper Load Confirmation&quot;,&quot;optional&quot;:true}">Revised Shipper Load Confirmation</option>
                                                                ; <option value="28" disabled>Lumper Receipt</option>
                                                                ; <option value="29" data-docdetail="{&quot;id&quot;:29,&quot;name&quot;:&quot;Carrier Invoice&quot;,&quot;optional&quot;:true}">Carrier Invoice</option>
                                                                ; <option value="30" data-docdetail="{&quot;id&quot;:30,&quot;name&quot;:&quot;Factoring Invoice&quot;,&quot;optional&quot;:true}">Factoring Invoice</option>
                                                                ; <option value="31" data-docdetail="{&quot;id&quot;:31,&quot;name&quot;:&quot;Revised Carrier Invoice&quot;,&quot;optional&quot;:true}">Revised Carrier Invoice</option>
                                                                ; <option value="32" data-docdetail="{&quot;id&quot;:32,&quot;name&quot;:&quot;Revised Factoring Invoice&quot;,&quot;optional&quot;:true}">Revised Factoring Invoice</option>
                                                                ; <option value="33" data-docdetail="{&quot;id&quot;:33,&quot;name&quot;:&quot;Shipper Invoice&quot;,&quot;optional&quot;:true}">Shipper Invoice</option>
                                                                ; <option value="34" data-docdetail="{&quot;id&quot;:34,&quot;name&quot;:&quot;Shipper Payment&quot;,&quot;optional&quot;:true}">Shipper Payment</option>
                                                                ; <option value="35" data-docdetail="{&quot;id&quot;:35,&quot;name&quot;:&quot;Carrier Payment&quot;,&quot;optional&quot;:true}">Carrier Payment</option>
                                                                ; <option value="36" data-docdetail="{&quot;id&quot;:36,&quot;name&quot;:&quot;Dispute&quot;,&quot;optional&quot;:true}">Dispute</option>
                                                                ; <option value="37" data-docdetail="{&quot;id&quot;:37,&quot;name&quot;:&quot;Claims&quot;,&quot;optional&quot;:true}">Claims</option>
                                                                ; <option value="38" data-docdetail="{&quot;id&quot;:38,&quot;name&quot;:&quot;Signed Carrier Rate Confirmation&quot;,&quot;optional&quot;:true}">Signed Carrier Rate Confirmation</option>
                                                                ; <option value="39" data-docdetail="{&quot;id&quot;:39,&quot;name&quot;:&quot;Carrier Packet&quot;,&quot;optional&quot;:true}">Carrier Packet</option>
                                                                ; <option value="40" data-docdetail="{&quot;id&quot;:40,&quot;name&quot;:&quot;Carrier Profile&quot;,&quot;optional&quot;:true}">Carrier Profile</option>
                                                                ; <option value="41" data-docdetail="{&quot;id&quot;:41,&quot;name&quot;:&quot;SaferWatch Report&quot;,&quot;optional&quot;:true}">SaferWatch Report</option>
                                                                ; <option value="42" data-docdetail="{&quot;id&quot;:42,&quot;name&quot;:&quot;Insurance&quot;,&quot;optional&quot;:true}">Insurance</option>
                                                                ; <option value="43" data-docdetail="{&quot;id&quot;:43,&quot;name&quot;:&quot;W9&quot;,&quot;optional&quot;:true}">W9</option>
                                                                ; <option value="44" data-docdetail="{&quot;id&quot;:44,&quot;name&quot;:&quot;Notice Of Assignment&quot;,&quot;optional&quot;:true}">Notice Of Assignment</option>
                                                                ; <option value="45" data-docdetail="{&quot;id&quot;:45,&quot;name&quot;:&quot;Void Check&quot;,&quot;optional&quot;:true}">Void Check</option>
                                                                ; <option value="46" data-docdetail="{&quot;id&quot;:46,&quot;name&quot;:&quot;MC Authority Letter&quot;,&quot;optional&quot;:true}">MC Authority Letter</option>
                                                                ; <option value="47" data-docdetail="{&quot;id&quot;:47,&quot;name&quot;:&quot;Carrier Safety Check&quot;,&quot;optional&quot;:true}">Carrier Safety Check</option>
                                                                ; <option value="48" data-docdetail="{&quot;id&quot;:48,&quot;name&quot;:&quot;ACH&quot;,&quot;optional&quot;:true}">ACH</option>
                                                                ; <option value="49" data-docdetail="{&quot;id&quot;:49,&quot;name&quot;:&quot;WO&quot;,&quot;optional&quot;:true}">WO</option>
                                                                ; <option value="50" disabled>Proof Of Delivery (Masked)</option>
                                                                ;
																	; 
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table class="table mt-4" id="prefrence-document-table">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col"> Document</th>
                                                                        <th scope="col">Mark optional</th>
                                                                        <th scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="prefer-row">
                                                                        <td>Shipper Load Confirmation</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="prefer-row">
                                                                        <td>Proof of Delivery (Masked)</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="prefer-row">
                                                                        <td>Lumper Receipt</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- Input hidden Preference Document -->
                                                            <input id="shipper_prefer_list" name="shipper_prefer_list[]" type="hidden" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline wizard mb-0">
                                                <li class="previous list-inline-item">
                                                    <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                                                </li>
                                                <li class="next list-inline-item float-right">
                                                    <a href="javascript: void(0);" class="btn btn-secondary">Next</a>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="commodities">
                                        <form id="commoditiesForm" class="form-horizontal">
                                            <div class="row">
                                                <div class="form-group col-md-10 mb-2">
                                                    <label for="standard_instruction">Standing Instructions</label>
                                                    <br>
                                                    <textarea name="standard_instruction" id="standard_instruction" rows="2" cols="100" maxLength="150" minLength="10" class="form-control"></textarea>
                                                </div>
                                                <div class="row p-2">
                                                    <div class="form-group col-md-4 mb-2">
                                                        <label for="route">
                                                            Type of Equipment <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="equipment_type" id="equipmentmode-selector">
                                                            <option disabled selected value="">Select Type of Equipment</option>
                                                            <option value="1">Two 24 or 28 Foot Flatbeds</option>
                                                            <option value="2">Animal Carrier</option>
                                                            <option value="3">Auto Carrier</option>
                                                            <option value="4">B-Train/Supertrain (Canada only)</option>
                                                            <option value="5">Belly Dump</option>
                                                            <option value="6">Beam</option>
                                                            <option value="7">Conveyor Belt</option>
                                                            <option value="8">Boat Hauling Trailer</option>
                                                            <option value="9">Convertible Hopper</option>
                                                            <option value="10">Conestoga</option>
                                                            <option value="11">Container Trailer</option>
                                                            <option value="12">Curtain Van</option>
                                                            <option value="13">Drive Away</option>
                                                            <option value="14">Double Drop</option>
                                                            <option value="15">Double Drop Extendable</option>
                                                            <option value="16">Dump Trucks</option>
                                                            <option value="17">End Dump</option>
                                                            <option value="18">Flatbed</option>
                                                            <option value="19">FlatBed - Air-Ride</option>
                                                            <option value="20">Stretch Trailers or Extendable Flatbed</option>
                                                            <option value="21">Flatbed Intermodal</option>
                                                            <option value="22">Flatbed Over-Dimension Loads</option>
                                                            <option value="23">Flatbed, Van or Reefer</option>
                                                            <option value="24">Flatbed or Step Deck</option>
                                                            <option value="25">Flatbed, Step Deck or Van</option>
                                                            <option value="26">Van or Flatbed</option>
                                                            <option value="27">Flatbed, Van or Reefer</option>
                                                            <option value="28">Flatbed or Vented Van</option>
                                                            <option value="29">Flatbed, Vented Van or Reefer</option>
                                                            <option value="30">Flatbed With Sides</option>
                                                            <option value="31">Hopper Bottom</option>
                                                            <option value="32">Hot Shot</option>
                                                            <option value="33">Haul and Tow Unit</option>
                                                            <option value="34">Landoll Flatbed</option>
                                                            <option value="35">Lowboy</option>
                                                            <option value="36">Lowboy Over-Dimension Loads</option>
                                                            <option value="37">Load-Out are empty trailers you load and haul</option>
                                                            <option value="38">Live Bottom Trailer</option>
                                                            <option value="39">Maxi or Double Flat Trailers</option>
                                                            <option value="40">Mobile Home</option>
                                                            <option value="41">Pneumatic</option>
                                                            <option value="42">Power Only (Tow-Away)</option>
                                                            <option value="43">Refrigerated (Reefer)</option>
                                                            <option value="44">Flatbed, Van or Reefer</option>
                                                            <option value="45">Removable Goose Neck &amp;Multi-Axle Heavy Haulers</option>
                                                            <option value="46">RGN Extendable</option>
                                                            <option value="47">Refrigerated Intermodal</option>
                                                            <option value="48">Roll Top Conestoga</option>
                                                            <option value="49">Refrigerated Carrier with Plant Decking</option>
                                                            <option value="50">Van or Reefer</option>
                                                            <option value="51">Flatbed, Van or Reefer</option>
                                                            <option value="52">Step Deck</option>
                                                            <option value="53">Step Deck Conestoga</option>
                                                            <option value="54">Step Deck Extendable</option>
                                                            <option value="55">Step Deck with Loading Ramps</option>
                                                            <option value="56">Step Deck Over-Dimension Loads</option>
                                                            <option value="57">Step Deck or Removable Gooseneck</option>
                                                            <option value="58">Unspecified Specialized Trailers</option>
                                                            <option value="59">Cargo/Small/Sprinter Van</option>
                                                            <option value="60">Straight Van</option>
                                                            <option value="61">Tanker (Food grade, liquid, bulk, etc.)</option>
                                                            <option value="62">Van</option>
                                                            <option value="63">Open Top Van</option>
                                                            <option value="64">Van - Air-Ride</option>
                                                            <option value="65">Blanket Wrap Van</option>
                                                            <option value="66">Cargo Vans (1 Ton capacity)</option>
                                                            <option value="67">Flatbed or Van</option>
                                                            <option value="68">Flatbed, Van or Reefer</option>
                                                            <option value="69">Van Intermodal</option>
                                                            <option value="70">Vented Insulated Van</option>
                                                            <option value="71">Vented Insulated Van or Refrigerated</option>
                                                            <option value="72">Van with Liftgate</option>
                                                            <option value="73">Moving Van</option>
                                                            <option value="74">Van or Reefer</option>
                                                            <option value="75">Van, Reefer or Double Drop</option>
                                                            <option value="76">Flatbed, Van or Reefer</option>
                                                            <option value="77">Vented Van</option>
                                                            <option value="78">Vented Van or Refrigerated</option>
                                                            <option value="79">Walking Floor</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 mb-2">
                                                        <label for="load_type">
                                                            Mode Type <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control loadtype" name="load_type" id="loadtype-selector" onChange="getServiceModes(this.value);">
                                                            <option disabled selected value="">Select Load Type</option>
                                                            <option value="1">FTL</option>
                                                            <option value="2">LTL</option>
                                                            <option value="3">Drayage</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 mb-2 portname">
                                                        <label for="route">
                                                            Port Name <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control" name="port_name">
                                                            <option disabled selected value="">Select Port</option>
                                                            <option value="1">LA</option>
                                                            <option value="2">Long Beach</option>
                                                            <option value="3">Houston</option>
                                                            <option value="4">Oakland</option>
                                                            <option value="5">New Orleans</option>
                                                            <option value="6">New York</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Commodity</th>
                                                                    <th>Type Of Commodity</th>
                                                                    <th>Packaging Type</th>
                                                                    <th colspan="5">Dimensions</th>
                                                                    <!--th>Notes</th-->
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="commodity_form"></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
</br>
<div class="row">
    <div class="col-sm-12 text-center">
        <label>Save as</label>
        <input type="checkbox" name="consignee">
        <label>Consignee</label>
        <input type="checkbox" name="consignor">
        <label>Consignor</label>
    </div>
</div>
<ul class="list-inline wizard mb-0">
    <li class="previous list-inline-item">
        <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
    </li>
</ul>
</form>

</div></div>
<!-- tab-content -->
</div>
<!-- end #shipperwizard-->
</div>
<!-- end card-body -->
</div>
<!-- end card-->
</div>
<!-- end col -->
</div>
<!-- end row -->
</div>
<!-- container -->
<div class="modal fade" id="reportToAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">Report to Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form  accept-charset="UTF-8" class="form-horizontal" novalidate="novalidate" data-parsley-validate="" autocomplete="off">
                    <input name="_token" type="hidden" value="pBKpfrWuK8XDwuNCeBtFeaayTVIjBovGYlz9boX3">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="duplicacynotes">Notes</label>
                            <textarea name="duplicacynotes" id="duplicacynotes" data-parsley-length="[5,550]" maxlength="550" rows="2" cols="50"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary waves-effect ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
<!-- content -->

<!-- end Footer -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- bundle -->
<!-- Vendor js -->
{{-- <script src="https://tmsstaging.shinelogisticsllc.com/assets/js/vendor.min.js"></script> --}}
<!-- Plugins js-->
<
<!-- Page js-->

<script>
    $(document).ready(function() {

        $('.portname').addClass('d-none');

        $('.loadtype').on('change', function() {
            if ($(this).val() == 3) {
                $('.portname').removeClass('d-none');
            } else {
                $('.portname').addClass('d-none');
            }
        })

        /**
		 * Desc: Add more emails option business email section
		 * Author: <puneet.singh@shinelogisticsllc.com> */
        let more_emails_count = 0;
        $('#add-more-email').click(function() {
            more_emails_count += 1;
            const email_html = `<div class="input-group"> <input type="email" ="" name="billing_email[]" class="form-control" placeholder="Enter E-mail"> <span class="input-group-btn"> <button class="btn more-email-btn del-more-email" type="button"><i class="fa fa-trash"></i></button> </span> </div>`;
            $('#more-emails').append(email_html);
        });

        /**
		 * Desc: Remove option business email section
		 * Author: <puneet.singh@shinelogisticsllc.com> */
        $(document).on('click', 'button.del-more-email', function() {
            $(this).closest('.input-group').remove();
        });

        /**
		 * Desc: Script for Add Prefer document
		 * Author: <puneet.singh@shinelogisticsllc.com> */
        var selectedDocArray = [];
        var selectedDocArray = $.parseJSON('[{"id":21,"name":"Shipper Load Confirmation","optional":false},{"id":50,"name":"Proof of Delivery (Masked)","optional":false},{"id":28,"name":"Lumper Receipt","optional":true}]');

        $('#shipper_prefer_list').val(JSON.stringify(selectedDocArray));

        $(document).on('change', '#prefer_document', function() {
            const docData = $.parseJSON($('option:selected', this).attr('data-docdetail'));
            const doc_id = docData.id;

            let selected_id = selectedDocArray.filter(function(doc) {
                return doc.id == doc_id;
            });
            if (selected_id.length > 0) {
                alert(docData.name + ' is already added in preference list.');
            } else {
                selectedDocArray.push(docData);
                const prefer_doc = '<tr class="prefer-row" id="prefer-row-' + docData.id + '"><td>' + docData.name + '</td><td><input type="checkbox" value="' + docData.id + '" checked class="doc_optional" name="doc_optional_true[]"></td><td><a href="javascript:void(0)" class="prefer-doc-delete" data-index="' + (selectedDocArray.length - 1) + '" data-xid="' + docData.id + '"><i class="fa fa-trash"></i></a></td></td></tr>';
                $('table#prefrence-document-table > tbody').append(prefer_doc);
                $('#shipper_prefer_list').val(JSON.stringify(selectedDocArray));
            }
            $('#prefer_document').prop('selectedIndex', 0);
        });

        /**
		 * Desc: Script for Delete Prefer document
		 * Author: <puneet.singh@shinelogisticsllc.com> */
        $(document).on('click', '.prefer-doc-delete', function() {
            $('#shipper_prefer_list').val('');
            var doc_index = $(this).attr('data-index');
            selectedDocArray.splice(doc_index, 1);
            $('#shipper_prefer_list').val(JSON.stringify(selectedDocArray));
            $(this).closest('.prefer-row').remove();
            $("#prefrence-document-table tbody tr:nth-child(n + " + (doc_index) + ")").each((index,element)=>{
                var index = $(element).find('td:last-child a.prefer-doc-delete').attr('data-index');
                $(element).find('td:last-child a.prefer-doc-delete').attr('data-index', index - 1);
            }
            );
        });

        /**
		 * Desc: Script for Manage Prefer document array on 
		 * Author: <puneet.singh@shinelogisticsllc.com> */
        $(document).on('change', '.doc_optional', function() {

            const doc_id = $(this).val();
            const objIndex = selectedDocArray.findIndex((obj=>obj.id == doc_id));
            if (this.checked) {
                selectedDocArray[objIndex].optional = true;
            } else {
                selectedDocArray[objIndex].optional = false
            }

            $('#shipper_prefer_list').val(JSON.stringify(selectedDocArray));
        });

        $('#additional_billing').hide();
        $('input[name=billing_type]').change(function() {
            var billing_type = $('input[name=billing_type]:checked').val();
            if (billing_type == "additional") {
                $('#additional_billing').show();
            } else {
                $('#additional_billing').hide();
            }
        });

        $('#shipperwizard').bootstrapWizard({
            'onNext': function onNext(tab, navigation, index) {
                var tab_link = tab.children("a")[0].href;
                var tab_id = tab_link.substr(tab_link.indexOf("#"));

                var are_selectized_inputs_valid = true;

                $(`${tab_id} select.selectized`).each((array_index,element)=>{
                    var input_query = `#${element.id} ~ .selectize-control > .selectize-input`;

                    if (element.checkValidity() && (element.value.length > 0)) {
                        $(input_query).addClass("form-control is-valid").removeClass("is-invalid");
                    } else {
                        are_selectized_inputs_valid = false;
                        $(input_query).addClass("form-control is-invalid").removeClass("is-valid");
                    }
                }
                );

                var form = $($(tab).data("targetForm"));
                if (form) {
                    form.addClass('was-validated');
                    if ((form[0].checkValidity() === false) || !are_selectized_inputs_valid) {
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                }
            },
            onTabClick: function(tab, navigation, index) {
                return false;
            }
        });

        $('#shipperAdd').on('submit', function(event) {
            event.preventDefault();
            var formdata = $('#compDetailsForm, #contactDetailsForm, #paymentDetailsForm, #commoditiesForm, #shipperAdd').serializeArray();
            /**
			 * Desc: Add Prefer Documents on Save
			 * Author: <puneet.singh@shinelogisticsllc.com> */
            const preference_document = $('#shipper_prefer_list').val();
            formdata.push({
                name: 'preference_document',
                value: preference_document
            });
            //console.log(formdata);
            $.ajax({
                url: "save",
                type: "POST",
                data: formdata,
                success: function(response) {
                    //console.log(response);
                    window.location.href = "view/" + response;
                },
            });
        });

        /**
		 * Prepaid Shipper
		 * Author: <abhishek.singh@shinelogisticsllc.com> */

        $(document).on('change', '.isPrepaid', function() {
            if (document.getElementById('isPrepaid').checked) {
                $(".payments_term").hide();
                $(".credits_limit_requested").hide();
                $("#credit_limit_requested").prop('', false)
                $("#payment_term").removeClass('selectized')

            } else {
                $(".payments_term").show();
                $(".credits_limit_requested").show();
                $("#credit_limit_requested").prop('', true)
                $("#payment_term").addClass('selectized')

            }
        });

        var count = 1;

        dynamic_field(count);

        function dynamic_field(number) {
            html = '<tr>'
            html += '<td><input type="text" name="commodities[]" data-parsley-length="[2,100]" maxlenth="100" class="form-control" placeholder="Commodity" /></td>';
            html += '<td><input type="text" name="commodity_types[]" class="form-control" placeholder="Type of Commodity"/></td>';
            html += '<td>' + '<select id="packaging_types" name="packaging_types[]" class="form-control"><option selected disabled value="">Select Packaging Types</option><option value="Pallets">Pallets</option><option value="Boxes">Boxes</option><option value="Drums">Drums</option><option value="Trape">Trape</option><option value="None">None</option><option value="Other">Other</option></select>' + '</td>';
            html += '<td><input type="text" name="comm_l[]" class="form-control" style="width:45px;" placeholder="L" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/></td><td style="padding:20px 0 0 0">X</td>';
            html += '<td><input type="text" name="comm_w[]" class="form-control" style="width:45px;" placeholder="W" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/></td><td style="padding:20px 0 0 0">X</td>';
            html += '<td><input type="text" name="comm_h[]" class="form-control" style="width:45px;" placeholder="H" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/></td>';
            //html += '<td><input type="text" name="notes[]" class="form-control" /></td>';
            if (number > 1) {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">-</button></td></tr>';
                $('#commodity_form').append(html);
            } else {
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">+</button></td></tr>';
                $('#commodity_form').html(html);
            }
        }

        $(document).on('click', '#add', function() {
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function() {
            count--;
            $(this).closest("tr").remove();
        });

        var $selectState = $('#select-state').selectize({
            create: false,
            sortField: 'text'
        });
        var selectizecompanyState = $selectState[0].selectize;
        var companyState = "";
        selectizecompanyState.on('change', function() {
            companyState = selectizecompanyState.getValue();
        });

        var $countryselect = $('#select-country').selectize({
            create: false,
            sortField: 'text'
        });
        var selectizecompanyCountry = $countryselect[0].selectize;
        var companyCountry = "";
        selectizecompanyCountry.on('change', function() {
            companyCountry = selectizecompanyCountry.getValue();
        });

        var $selectState2 = $('#select-state2').selectize({
            create: false,
            sortField: 'text'
        });

        var $countryselect2 = $('#select-country2').selectize({
            create: false,
            sortField: 'text'
        });

        var $selectState3 = $('#select-state3').selectize({
            create: false,
            sortField: 'text'
        });

        var $countryselect3 = $('#select-country3').selectize({
            create: false,
            sortField: 'text'
        });

        $("#same_as_shipping_manager").change(function() {
            if (this.checked) {
                $("#owner_fname").val($("#smanager_fname").val());
                $("#owner_lname").val($("#smanager_lname").val());
                $("#owner_phone").val($("#smanager_phone").val());
                $("#owner_email").val($("#smanager_email").val());
            } else {
                $("#owner_fname").val("");
                $("#owner_lname").val("");
                $("#owner_phone").val("");
                $("#owner_email").val("");
            }
        });

        $("#same_as_company").change(function() {
            var selectizeState = $selectState2[0].selectize;
            var selectizeCountry = $countryselect2[0].selectize;

            if (this.checked) {
                $("#owner_street").val($("#company_street").val());
                $("#owner_city").val($("#company_city").val());
                selectizeState.setValue(selectizeState.search(companyState).items[0].id);
                $("#owner_zip").val($("#company_zip").val());
            } else {
                $("#owner_street").val("");
                $("#owner_city").val("");
                $("#owner_zip").val("");
                selectizeState.setValue("");
                selectizeCountry.setValue("");
            }
        });

        $("#same_as_owner").change(function() {
            if (this.checked) {
                $("#billing_fname").val($("#owner_fname").val());
                $("#billing_lname").val($("#owner_lname").val());
                $("#billing_phone").val($("#owner_phone").val());
                $("#billing_email").val($("#owner_email").val());
            } else {
                $("#billing_fname").val("");
                $("#billing_lname").val("");
                $("#billing_email").val("");
                $("#billing_phone").val("");
            }
        });

        $("#same_as_company2").change(function() {
            var selectizeState = $selectState3[0].selectize;
            var selectizeCountry = $countryselect3[0].selectize;
            if (this.checked) {
                $("#billing_street").val($("#company_street").val());
                $("#billing_city").val($("#company_city").val());
                selectizeState.setValue(selectizeState.search(companyState).items[0].id);
                $("#billing_zip").val($("#company_zip").val());
            } else {
                $("#billing_street").val("");
                $("#billing_city").val("");
                $("#billing_zip").val("");
                selectizeState.setValue("");
                selectizeCountry.setValue("");
            }
        });

        Parsley.addValidator('checkChildren', {
            messages: {
                en: 'You must correctly fill at least one of these blocks!'
            },
            requirementType: 'integer',
            validate: function(_value, requirement, instance) {
                for (var i = 1; i <= requirement; i++)
                    if (instance.parent.isValid({
                        group: 'block-' + i,
                        force: true
                    }))
                        return true;
                // One section is filled, this check is valid
                return false;
                // No section is filled, this validation fails
            }
        });
        $('.demo-form').parsley({
            inputs: Parsley.options.inputs + ',[data-parsley-check-children]'
        });

        $("#company_name,#company_email,#company_phone,#dba,#company_street").bind('input', function(event) {
            event.preventDefault();
            var company_name = $('#company_name').val();
            //var company_email = $('#company_email').val();
            //var company_phone = $('#company_phone').val();
            //var dba = $('#dba').val();
            var company_street = $('#company_street').val();
            //var company_state = $('#company_state').val();
            var _token = $('input[name="_token"]').val();

            //if(company_name != "" || company_email != "" || company_phone != "" || dba != "" || company_street != ""){
            if (company_name != "" && company_street != "") {
                $.ajax({
                    url: "/duplicacycheck/shippersuggestions",
                    method: "POST",
                    data: {
                        company_name: company_name,
                        company_street: company_street,
                        _token: _token
                    },
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            $('#duplicacy_error').removeClass("d-none");
                            $('.next').hide();
                        } else {
                            $('#duplicacy_error').addClass("d-none");
                            $('.next').show();
                        }
                    }
                })
            } else {
                $('#duplicacy_error').addClass("d-none");
                $('.next').show();
            }
        });

    });

    $('#credit_limit_requested').keyup(function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
</script>
<script>
    $('#shippersubmit').on('click', function() {
        $(this).val('Please wait ...').attr('disabled', 'disabled');
        $('#shipperAdd').submit();
    });

    $('#type_of_business, #display_name, #location, #payment_term, #payment_method, #packaging_types').selectize({
        create: false,
        sortField: 'text'
    });

    $('.seprate_comma_validation').on('keyup', function(event) {
        var emails = $(this).val();
        var regx = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
        if (!regx.test(emails)) {
            $('.warning_message').text("Email is Invalid or Multiple email entered");
            $('#next_button_disable').addClass('disabled');
        } else {
            $('.warning_message').text("");
            $('#next_button_disable').removeClass('disabled');
        }
    });

    $('.email_special_character').on('input', function() {
        var validation_email = $(this).val();
        var regx = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (!regx.test(validation_email)) {
            $('.email_warning').text('Enter Valid Email')
        } else {
            $('.email_warning').text("");
        }
    });

    $('.zip_code_shipper').bind('keyup', function(e) {
        $(this).val($(this).val().replace(/[^a-zA-Z0-9]/g, ''));
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            e.keyCode = newKey;
            e.charCode = newKey;
        }
        $(this).val(($(this).val()));
    });
</script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- App js -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.40/moment-timezone-with-data.min.js" integrity="sha512-dPDHjz++pU63luykSOhkUQw82AZdbQHk7LQNKrU7kuRGmdR9mbPFu/vYAmCgZ+TXk8vHygzCkV6Ixck+NIOeDA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    moment.tz.setDefault("Canada/Pacific");
    (function blink() {
        $('#new-changes').fadeOut(400).fadeIn(400, blink);
    }
    )();

    if (document.getElementsByClassName('select2-select')) {

        $('.select2-select').select2({
            minimumResultsForSearch: -1
        })
    }
    window.setColorPicker = (elem,defaultValue)=>{
        elem = document.querySelector(elem);
        let pickr = Pickr.create({
            el: elem,
            default: defaultValue,
            theme: 'nano',
            // or 'monolith', or 'nano'
            useAsButton: true,

            swatches: ['#217ff3', '#11cdef', '#fb6340', '#f5365c', '#f7fafc', '#212529', '#2dce89'],

            components: {

                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    // hsla: true,
                    // hsva: true,
                    // cmyk: true,
                    input: true,
                    clear: true,
                    silent: true,
                    preview: true,
                }
            }
        });

        pickr.on('init', pickr=>{
            elem.value = pickr.getSelectedColor().toRGBA().toString(0);
        }
        ).on('change', color=>{
            elem.value = color.toRGBA().toString(0);
            // pickr.hide();
        }
        );

        return pickr;

    }

    $.extend($.fn.dataTable.defaults, {
        keys: !0,
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
    });
    $(document).on('init.dt', function() {
        $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
    });

    function preview_image(event, ID) {
        if (ID == undefined) {
            ID = 'preview-image';
        }

        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(ID);
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    if (document.getElementById('my-form')) {
        $("#my-form").parsley({
            errorClass: 'is-invalid text-danger',
            successClass: 'is-valid',
            errorsWrapper: '<span class="form-text text-danger"></span>',
            errorTemplate: '<span></span>',
            trigger: 'change'
        });
    }
    window.Parsley.addValidator('maxFileSize', {
        validateString: function(_value, maxSize, parsleyInstance) {
            var fsize = 0;
            for (var i = 0; i < parsleyInstance.$element[0].files.length; ++i)
                fsize += parsleyInstance.$element[0].files[i].size;
            return fsize <= maxSize * 1024;
        },
        requirementType: 'integer',
        messages: {
            en: 'This file or files should not be larger than %s Kb',
            fr: 'Ce fichier est plus grand que %s Kb.'
        }
    });
    ///////////////end method for helpdesk////////////////////////////

    $(document).ajaxError(function(event, jqxhr, settings, exception) {
        if (jqxhr.status == 401) {
            window.location = '/';
        }
    });
    $.fn.dataTable.ext.errMode = 'none';

    $(document).ready(function() {
        $("#my-form, #closeTicketForm, #loadAdd1", '#postOnLoadBoard').on("submit", function() {
            $("#pageloader").fadeIn();
        });
        $(".load-on-click").on("click", function() {
            $("#pageloader").fadeIn();
        });
        $("form").on("submit", function() {
            if ((this.id == "form_loadboard") || (this.id == "unpost_loadboard") || (this.id == "summary_download"))
                $("#pageloader").fadeOut();
            else
                $("#pageloader").fadeIn();

        });
        //submit

        //load_notification();
        //setInterval(function(){
        //  load_notification() // this will run after every second
        //}, 1000);

       

        /*$(function() {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    console.log("done");
                    $(this).parents('div.alert').remove();
                    load_notification()
                });
            });
            $('#mark-all').click(function() {
                let request = sendMarkRequest();
                request.done(() => {
                    $('div.alert').remove();
                    load_notification()
                })
            });
        });*/

    });
</script>
</body></html>
