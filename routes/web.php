<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdercategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\AssignUserTeamController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AccountsPayableController;
use App\Http\Controllers\CarrierAccountController;
use App\Http\Controllers\AccountReceivableController;
use App\Http\Controllers\AssignAcPayableController;
use App\Http\Controllers\AssignAcReceivableController;
use App\Http\Controllers\CompanySettingController;
use App\Http\Controllers\ApCommentController;
use App\Http\Controllers\ArCommentController;
use App\Http\Controllers\CarrierRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IpCheckerController;
use App\Http\Controllers\HomeipController;
use App\Http\Controllers\ActivityModuleController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CarrierPaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NewCarrierController;
use App\Http\Controllers\NewReferenceController;



// use App\Http\Controllers\backend\orderManagement\Customer\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/', function () {return view('welcome');});
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/verifyip/{id}', [HomeipController::class, 'index']);
    Route::post('/request-access-ip', [HomeipController::class, 'request']);
    
        Route::get('/export-users',[UserController::class,'exportUsers']);
        Route::group(['middleware' => 'prevent-back-history'],function(){
            Auth::routes();  
            Route::get('/home', [HomeController::class, 'index'])->name('home');
            Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin/dashboard');
            Route::match(['get','post'],'/userPasswordRest',[HomeController::class, 'userPasswordRest']);
            // Route::get('pagenotfound', [HomeController::class, 'pagenotfound']);
            Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
                
                    Route::get('/verifyip/{id}', [HomeipController::class, 'index']);
                    Route::resource('roles', RoleController::class);
                    Route::resource('users', UserController::class);
                    Route::resource('ordercategory', OrdercategoryController::class);
                    Route::get('/trashed-user', [UserController::class, 'trashedUser'])->name('trashedUser');
                    Route::get('/restore-user/{id}', [UserController::class, 'restoreUser'])->name('restoreUser');
                    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
                    Route::match(['get','post'],'/userout',[UserController::class, 'userout']);
                    Route::post('/user/change-password', [UserController::class, 'change_user_password'])->name('change-password');
                    Route::post('/user-filter', [UserController::class, 'userFilter'])->name('user-filter');
                    Route::post('/validate/user-email', [UserController::class, 'validateUseremail'])->name('validate-user-email');
        
                    // user multipal checkbox use for delete        
                     Route::match(['get','post','delete'],'/multipleusersdelete',[UserController::class, 'multipleusersdelete']);
                    
                    //clock in clock out 
                    // Route::match(['get','post'],'/clockin',[UserController::class, 'clockin']);
                    //clock in clock out 

                    Route::match(['get','post'],'/clockin',[UserController::class, 'clockin']);
                    Route::match(['get','post'],'/clockin/view',[UserController::class, 'clockinview']);
                    Route::match(['get','post'],'/clockinfo/delete/{id}',[UserController::class, 'clockinDelete']);
                    Route::match(['get','post'],'/brackin',[UserController::class, 'brackin']);
                    Route::match(['get','post'],'/brackin/details/{id}',[UserController::class, 'brackindetails']);
                    Route::match(['get','post'],'/brackout',[UserController::class, 'brackout']);
                    Route::match(['get','post'],'/clockinfo/logout/',[UserController::class, 'breakoutlist']);
                    Route::match(['get','post'],'/clockinfo/breakout/',[UserController::class, 'breaktime']);
                    
        
                    Route::get('/dat/organization_token', [ShipmentController::class, 'dat_organization_token'])->name('dat_organization_token');
                    Route::match(['get','post'],'/changeuserStatus',[UserController::class, 'changeuserStatus']);
                    Route::match(['get','post'],'/userprofiledata',[UserController::class, 'userprofiledata']);
                    Route::match(['get','post'],'/userprofilesubmit',[UserController::class, 'userprofiledatasubmit']);
                    
                    
                    
        
                    /* Broker shipment route start here */
                    Route::get('/shipment', [ShipmentController::class, 'shipment'])->name('shipment');
                    Route::match(['get','post'],'/shipment/list',[ShipmentController::class, 'list']);
                    Route::get('/shipment/ShipmentStatusUpdate', [ShipmentController::class, 'ShipmentStatusUpdate']);
                    Route::get('/shipment/every-shipment-list', [ShipmentController::class, 'every_shipment'])->name('every_shipment');
                    Route::get('/shipment/excel_download_shipments', [ShipmentController::class, 'excel_download_shipments'])->name('excel_download_shipments');
                    Route::get('/create-shipment', [ShipmentController::class, 'createshipment']);
                    Route::get('/shipment/clone_new_Shipment', [ShipmentController::class, 'clone_new_Shipment'])->name('clone_new_Shipment');
                    Route::post('/create-shipment-submit', [ShipmentController::class, 'createshipmentsubmit']);
                    Route::get('/shipment/carrier_mc', [ShipmentController::class, 'shipment_mc_get'])->name('shipment_mc_get');
                    Route::get('/shipment/carrier_dot', [ShipmentController::class, 'ShipmentDotGet'])->name('ShipmentDotGet');
                    Route::get('/shipment/shipment-edit/{shipmentid}', [ShipmentController::class, 'shipment_edit']);
                    Route::post('/shipment-update', [ShipmentController::class, 'shipmentupdate']);
                    Route::get('/carrier-rate-pdf/{shipmentid}', [ShipmentController::class, 'carrier_rate_pdf']);
                    Route::match(['get','post'],'/carrier-bol/{shipmentid}',[ShipmentController::class, 'CarrierBOl']);
                    Route::get('/shipper-BOL-pdf/{shipmentid}', [ShipmentController::class, 'shipper_BOL_pdf']);
                    Route::get('/shipper-rate-pdf/{shipmentid}', [ShipmentController::class, 'shipper_rate_pdf']);
                    Route::get('/shipment_invoice/{shipmentid}', [ShipmentController::class, 'shipment_invoice']);
                    Route::get('/shipment/PicksDropsForm', [ShipmentController::class, 'PicksDropsForm']);
                    Route::get('/shipment/AddExtraPick', [ShipmentController::class, 'AddExtraPick']);
                    Route::get('/shipment/AddExtraDrop', [ShipmentController::class, 'AddExtraDrop']);
                    Route::post('/shipment/ExtraPickSubmit', [ShipmentController::class, 'ExtraPickSubmit']);
                    Route::get('/extra-picks-drop/{shipmentid}', [ShipmentController::class, 'extra_picks_drop']);
                    Route::post('/shipment/ExtraDropSubmit', [ShipmentController::class, 'ExtraDropSubmit']);
                    Route::get('/shipment/DeleteExtraPick', [ShipmentController::class, 'DeleteExtraPick']);
                    Route::get('/shipment/DeleteExtraDrop', [ShipmentController::class, 'DeleteExtraDrop']);
                    Route::get('/shipment/GetShipperDataShipment', [ShipmentController::class, 'GetShipperDataShipment']);
                    Route::get('/shipment/shipment_statue_update', [ShipmentController::class, 'shipment_statue_update']);
                    Route::get('/shipment/shipment_doc_del', [ShipmentController::class, 'shipment_doc_del']);
                    Route::match(['get','post'],'/shipment/AllShipmentFilterAdmin', [ShipmentController::class, 'AllShipmentFilterAdmin']);					
                    Route::get('/shipment/ShipmentFilterAdmin', [ShipmentController::class, 'ShipmentFilterAdmin']);
                    Route::match(['get','post'],'/load-pdf', [ShipmentController::class, 'loadPdfNew']);					
                    Route::match(['get','post'],'/load-pdf/invoice', [ShipmentController::class, 'loadPdfNewInvoice']);
                    Route::post('/shipment/filter', [ShipmentController::class, 'shipmentFilter'])->name('shipmentFilter');
                    Route::match(['get','post'],'/vonage', [ShipmentController::class, 'vonagecall']);			
                    Route::match(['get','post'],'/vonage/calldetail', [ShipmentController::class, 'vonagecalldetail']);			
                    Route::match(['get','post'],'/vonage/calllog', [ShipmentController::class, 'vonagecalllog']);
                    Route::get('/shipment/view-shipment/{id}', [ShipmentController::class, 'viewShipment'])->name('view-shipment');

                    /* Broker shipment route start end */
        
        
                    /* Broker carrier route start here */
                    Route::get('/carrier', [CarrierController::class, 'carrier_dashboard'])->name('carrier_dashboard');
                    Route::get('/new-carrier', [CarrierController::class, 'new_carrier'])->name('new_carrier');
                    Route::match(['get','post'],'/carrier/list',[CarrierController::class, 'carrierlist']);
                    Route::get('/carriers-find', [CarrierController::class, 'carriers_find']);
                    Route::get('/carrier/add-carrier-form', [CarrierController::class, 'add_carrier_form'])->name('add_carrier_form');
                    Route::match(['get','post'],'/carrier/add_carrier', [CarrierController::class, 'add_carrier'])->name('add_carrier');
                    Route::get('/carrier/carriers_edit', [CarrierController::class, 'carriers_edit']);
                    Route::post('/carrier/update_carriers', [CarrierController::class, 'update_carriers'])->name('update_carriers');
                    Route::get('/carrier/myCarrierPacket', [CarrierController::class, 'MyCarrierPacket']);
                    Route::get('/carrier/PreviewCarrierDetail', [CarrierController::class, 'PreviewCarrierDetail']);
                    Route::get('/carrier/PreviewCarrierProfile/{carrier_id}', [CarrierController::class, 'PreviewCarrierProfile']);
                    Route::post('/carrier/getDocument', [CarrierController::class, 'CarrierGetDocument']);
                    Route::get('/carrier/CarrierEmailInviteForm', [CarrierController::class, 'CarrierEmailInviteForm']);
                    Route::get('/carrier-packet/EmailInviteSent', [CarrierController::class, 'EmailInviteSent']);
                    Route::get('/new/carrier/detail', [CarrierController::class, 'NewCarrierDetail']);
                    Route::match(['get','post'],'/carrier/NewCarrierAdd', [CarrierController::class, 'NewCarrierAdd']);					
                    Route::match(['get','post'],'/carrier/profile/{id}',[CarrierController::class, 'CarrierProfileCheck']);
                    Route::match(['get','post'],'/carrier/packet/token',[CarrierController::class, 'CarrierPacketToken']);
                    
                    Route::get('/carrier/new-design', function () {
                        return view('backend/shipmentManagement/carrier/Carrier-profile');
                    });
                    
                    
                    Route::get('/carrier/requests', [CarrierRequestController::class, 'CarrierRequests']); 
                    Route::get('/carrier/request/edit/{id}', [CarrierRequestController::class, 'CarrierRequestEdit']);
                    Route::post('/carrier/StatusUpdate', [CarrierRequestController::class, 'CarrierStatusUpdate']);
                    Route::match(['get','post'],'/carrier/request/commentform', [CarrierRequestController::class, 'RequestCommentForm']);
                    Route::match(['get','post'],'/carrier/request/commentUpdate', [CarrierRequestController::class, 'RequestCommentUpdate']);
                    /* Broker carrier route start end */
                    
                    
                    Route::get('shipper', [CompanyController::class, 'index']);
                    Route::match(['get','post'],'/shipper/add',[CompanyController::class, 'add']);
                    Route::match(['get','post'],'/shipper/ShipperNameCheck',[CompanyController::class, 'ShipperNameCheck']);
                    Route::match(['get','post'],'/shipper/view/{shipper_id}',[CompanyController::class, 'show']);
                    Route::match(['get','post'],'/shipper/list',[CompanyController::class, 'list']);
                    Route::match(['get','post'],'/shipper/edit/{shipper_id}',[CompanyController::class, 'edit']);
                    Route::match(['get','post'],'/shipper/delete/{shipper_id}',[CompanyController::class, 'delete']);
                    Route::match(['get','post'],'/shipper/requset/resend/{shipper_id}',[CompanyController::class, 'RequsetResend']);
                    Route::match(['get','post'],'/shipper/requset/commentform',[CompanyController::class, 'RequsetCommentForm']);
                    Route::match(['get','post'],'/shipper/requset/commentUpdate',[CompanyController::class, 'RequsetCommentUpdate']);
                    Route::get('/shipper/request', [CompanyController::class, 'shipper_request'])->name('shipper_request');
                    Route::get('/shipper/request/edit/{id}', [CompanyController::class, 'shipper_request_edit'])->name('shipper_request_edit');
                    Route::post('/shipper/request_update',[CompanyController::class, 'request_update'])->name('request_update');
                    Route::get('shipper/ShipperFilterAdmin',[CompanyController::class, 'ShipperFilterAdmin']);
                    Route::post('shipper/shipper-filter',[CompanyController::class, 'shipperFilter']);
					//shipper date range
					Route::post('shipper/date-filter',[CompanyController::class, 'shipperdateFilter']);
            
        
                    Route::get('dependent-dropdown', [CountryController::class, 'index']);
                    Route::post('fetch-states', [CountryController::class, 'fetchState']);
                    Route::post('fetch-cities', [CountryController::class, 'fetchCity']);
                    
                    /* Broker shipper route start here */
                    Route::get('agency', [AgencyController::class, 'index']);
                    Route::get('agency/manage', [AgencyController::class, 'agency_manage'])->name('agency_manage');
                    Route::get('agency/manage_edit', [AgencyController::class, 'manage_edit'])->name('manage_edit');
                    Route::post('agency/manage_submit', [AgencyController::class, 'manage_submit'])->name('manage_submit');
                    Route::get('/agency/create',[AgencyController::class, 'create']);
                    Route::post('/agency/add',[AgencyController::class, 'agency_add'])->name('agency_add');
                    Route::get('/agency/agency_details',[AgencyController::class, 'agency_details'])->name('agency_details');
                    Route::post('/agency/agency_update',[AgencyController::class, 'agency_update'])->name('agency_update');
                    /* Broker shipper route end here */

                    /* Office Manage Data type route start here */
                    //agency/manage
                    Route::get('agency/manage/user/{id}', [AgencyController::class, 'officedata']);
                    Route::get('agency/manage/user/data/{id}', [AgencyController::class, 'agentdata']);
                    Route::get('agency/new/office', [AgencyController::class, 'newoffice']);

                    Route::get('agency/new/office/{id}', [AgencyController::class, 'managerdata']);
                    
                    /* Office Manage Data type route end here */
                
                    Route::get('/profile',[UserController::class, 'view_profile'])->name('user_profile');
                    Route::post('/save-profile',[UserController::class, 'update_profile'])->name('update_profile');
                    
                    Route::get('/loads', [LoadController::class, 'index']);
                    Route::get('/load/search_truck', [LoadController::class, 'search_truck']);
                    Route::post('/load/NewShipmentCreate', [LoadController::class, 'NewShipmentCreate']);
                    Route::get('/load/ReferencSearch', [LoadController::class, 'ReferencSearch']);
                    Route::match(['get','post'],'/search/truck/referance',[LoadController::class, 'search_referance_truck']);
                    Route::get('/load/ReferencSearchUpdate', [LoadController::class, 'ReferencSearchUpdate']);
                    Route::get('/load/newCommentAdd', [LoadController::class, 'newCommentAdd']);
                    Route::get('/load/GetLoadOriginData', [LoadController::class, 'GetLoadOriginData']);
                    Route::post('/broker/new-lanes-post', [LoadController::class, 'NewLanePost']);
                    // Route::post('/ratehistory/{ref}', [LoadController::class, 'RateviewHistory']);


                    Route::match(['get','post'],'/ratehistory/{ref}', [LoadController::class, 'RateviewHistory']);
                    Route::match(['get','post'],'/rateinfo', [LoadController::class, 'RateDatainfo'])->name('loadinfo.index');

                    Route::match(['get','post'],'/load/list/new',[LoadController::class, 'Loadlist']); 
                    Route::match(['get','post'],'/load/list/newway',[LoadController::class, 'Loadlistc']);



                    Route::match(['get','post'],'/data/cuisines',[LoadController::class, 'cuisinesList']);
                    
                    
                    Route::get('/load/LoadAgeRefresh', [LoadController::class, 'LoadAgeRefresh']);
                    Route::get('/load/LoadPostDelete', [LoadController::class, 'LoadPostDelete']);
                    Route::get('/load/LodePostUpdateForm', [LoadController::class, 'LodePostUpdateForm']);
                    Route::post('/load/LodePostUpdate', [LoadController::class, 'LodePostUpdate']);
                    Route::post('/load/LoadPostRateView', [LoadController::class, 'LoadPostRateView']);
                    Route::post('/load/TruckSearchDAT', [LoadController::class, 'TruckSearchDAT']);
                    Route::get('/load/TruckExactResult', [LoadController::class, 'TruckExactResult']);
                    Route::get('/load/TruckSearchDelete', [LoadController::class, 'TruckSearchDelete']);					
                    Route::match(['get','post'],'/load/reports',[LoadController::class, 'LoadReports']);
                    Route::match(['get','post'],'/load/reports/list/old',[LoadController::class, 'LoadReportslist']);  // use for datatable slow loading load  
                    
                    
                    //fortesting show all loadreport data
                    Route::match(['get','post'],'/load/reports/allpost',[LoadController::class, 'allPosts']);  // use for datatable slow loading load  


                    
                        //load reportlist old serach 
                    

                    Route::match(['get','post'],'/load/reports/list/old/search',[LoadController::class, 'LoadReportslistSearch']);


                    Route::match(['get','post'],'/load/reports/list',[LoadController::class, 'LoadReportslistData']);    //  use for custom fast loading load
                    Route::match(['get','post'],'old/loads/',[LoadController::class, 'OldLoadGet']);
                    Route::match(['get','post'],'load/repost',[LoadController::class, 'LoadRePost']);
                    // return view('backend/shipmentManagement/loads/index');


                    Route::match(['get','post'],'/carrier/manager/list',[ManagerController::class, 'CarrierManagerAssign']);
                    Route::match(['get','post'],'/carrier/manager/assignuser/carrier/{userid}',[ManagerController::class, 'AssignUserCarrier']);
                    Route::match(['get','post'],'/load/manager/list',[ManagerController::class, 'LoadManagerAssign']);	
                    Route::match(['get','post'],'/load/manager/loadslist',[ManagerController::class, 'LoadManagerAssignList']);	
                    Route::match(['get','post'],'/load/manager/loadslist/olddata',[ManagerController::class, 'LoadManagerAssignListOlddata']);	
                    Route::match(['get','post'],'/load/manager/assignuser/loads/{userid}',[ManagerController::class, 'AssignUserLoad']);
                    
                    Route::post('/load/manager/assignuser/loadsfilter',[ManagerController::class, 'AssignUserLoadFilter']);
                    
                    Route::match(['get','post'],'/shipper/manager/list',[ManagerController::class, 'ShipperManagerAssign']);
					Route::match(['get','post'],'/shipper/manager/assignuser/shipper/{userid}',[ManagerController::class, 'AssignUserShipper']);
                    Route::match(['get','post'],'/shipment/manager/list',[ManagerController::class, 'ManagerAssignShipment']);
                    Route::match(['get','post'],'/shipment/manager/shipmentlist',[ManagerController::class, 'ManagerAssignShipmentlist']);
                    Route::match(['get','post'],'/shipment/manager/assignuser/shipments/{userid}', [ManagerController::class, 'AssignUserShipment']);


                    Route::match(['get','post'],'/load/loadFilterAdmin/{userid}',[ManagerController::class, 'AssignUserLoad']);
                    //Route::match(['get','post'],'/carrier/manager/list',[CarrierController::class, 'CarrierManagerAssign']);
                    
                    Route::get('accountap', [AccountsPayableController::class, 'index']);           
                    Route::get('accountap/view/{id}', [AccountsPayableController::class, 'view']);
                    Route::get('accountap/view/apshiplist/{id}', [AccountsPayableController::class, 'apshipmentlist']);
                    Route::get('accountap/list', [AccountsPayableController::class, 'list']);
                    Route::match(['get','post'],'/accountap/shipment/list',[AccountsPayableController::class, 'AllShipmentList']);
                    Route::match(['get','post'],'/accountap/fillter/',[AccountsPayableController::class, 'fillter']);
                    Route::match(['get','post'],'/accountap/add',[AccountsPayableController::class, 'add']);
                    Route::match(['get','post'],'/accountap/status',[AccountsPayableController::class, 'statuschanges']);
                    Route::match(['get','post'],'/accountap/edit/{ap_id}',[AccountsPayableController::class, 'edit']);
                    Route::match(['get','post'],'/accountap/view/{ap_id}',[AccountsPayableController::class, 'show']);
                    Route::match(['get','post'],'/accountap/delete/{ap_id}',[AccountsPayableController::class, 'delete']);
                    Route::match(['get','post'],'/accountap/notification/{nid}',[NotificationController::class, 'notification_assignuser']);
        
                    Route::get('assignacp', [AssignAcPayableController::class, 'index']);
                    Route::match(['get','post'],'assignacp/all/shipment', [AssignAcPayableController::class, 'AssignAllShipment']);
                    Route::get('assignacp/list', [AssignAcPayableController::class, 'list']);
                    Route::get('assignacp/leader/list', [AssignAcPayableController::class, 'teamleaderindex']);
                    Route::get('assignuser/list/details/{id}', [AssignAcPayableController::class, 'detailtlist']);
                    /* status of assign ap user list by manager or admin */
                    Route::match(['get','post'],'/assignuser/details/status',[AssignAcPayableController::class, 'changeuserStatus']);
                    Route::match(['get','post'],'/assignuser/status',[AssignAcPayableController::class, 'changeuserApaccess']);
        
                    Route::match(['get','post'],'/assignacp/add',[AssignAcPayableController::class, 'add']);
                    Route::match(['get','post'],'/assignacp/edit/{assignacp_id}',[AssignAcPayableController::class, 'edit']);
                    Route::match(['get','post'],'/assignacp/view/{assignacp_id}',[AssignAcPayableController::class, 'show']);
                    Route::match(['get','post'],'/assignacp/delete/{assignacp_id}',[AssignAcPayableController::class, 'delete']);
                    Route::match(['get','post'],'/assign/apagent/brokerlist',[AssignAcPayableController::class, 'ApagentBrokerList']);
                    Route::match(['get','post'],'/assignacp/notification/{nid}',[NotificationController::class, 'notification_assignuser']);

                    // Carrier Account for Ap Management  27/12/22
                    Route::get('carrierac', [CarrierAccountController::class, 'index']);            
                    Route::match(['get','post'],'/carrierac/edit/{id}',[CarrierAccountController::class, 'edit']);
                    // Route::get('carrierac/view/{id}', [CarrierAccountController::class, 'view']);
                    // Route::get('carrierac/view/apshiplist/{id}', [CarrierAccountController::class, 'apshipmentlist']);
                    // Route::get('carrierac/list', [CarrierAccountController::class, 'list']);
                    // Route::match(['get','post'],'/carrierac/fillter/',[CarrierAccountController::class, 'fillter']);
                    // Route::match(['get','post'],'/carrierac/add',[CarrierAccountController::class, 'add']);
                    
                    // Route::match(['get','post'],'/carrierac/view/{ap_id}',[CarrierAccountController::class, 'show']);
                    // Route::match(['get','post'],'/carrierac/delete/{ap_id}',[CarrierAccountController::class, 'delete']);
                    // Route::match(['get','post'],'/carrierac/notification/{nid}',[NotificationController::class, 'notification_assignuser']);
                 
        
                    Route::get('assignuser', [AssignUserTeamController::class, 'index']);
                    Route::get('assignuser/list', [AssignUserTeamController::class, 'list']);
                    Route::match(['get','post'],'/assignuser/add',[AssignUserTeamController::class, 'add']);
                    Route::match(['get','post'],'/assignuser/edit/{assignuser_id}',[AssignUserTeamController::class, 'edit']);
                    Route::match(['get','post'],'/assignuser/view/{assignuser_id}',[AssignUserTeamController::class, 'show']);
                    Route::match(['get','post'],'/assignuser/delete/{assignuser_id}',[AssignUserTeamController::class, 'delete']);
                    Route::match(['get','post'],'/assignuser/notification/{nid}',[NotificationController::class, 'notification_assignuser']);
                    
                    Route::get('assign/ar', [AssignAcReceivableController::class, 'index']);
                    Route::match(['get','post'],'/ar/assign/all/shipment',[AssignAcReceivableController::class, 'ManagerShipmentList']);
                    Route::match(['get','post'],'/assign/ar/add',[AssignAcReceivableController::class, 'add']);
                    Route::match(['get','post'],'/assign/aragent/brokerlist',[AssignAcReceivableController::class, 'AragentBrokerList']);
                    Route::match(['get','post'],'/ar/assign/agent/list',[AssignAcReceivableController::class, 'AssignAgentList']);
                    Route::match(['get','post'],'/assignARuser/edit/{ar_id}',[AssignAcReceivableController::class, 'edit']);
                    Route::match(['get','post'],'/ar/assignuser/status',[AssignAcReceivableController::class, 'ChangeUserArAccess']);
                    Route::match(['get','post'],'/ar/assignuser/details/status',[AssignAcReceivableController::class, 'ChangeUserArStatus']);
                    Route::get('ar/assign/user/list/{id}', [AssignAcReceivableController::class, 'ArDetailtList']);
                    
        
                    Route::get('ar/shipment-list', [AccountReceivableController::class, 'index']);
                    Route::get('ar/shipment-detail/{id}', [AccountReceivableController::class, 'ShipmentDetail']);
                    Route::match(['get','post'],'/ar/assign/shipmentlist',[AccountReceivableController::class, 'ArAssignShipmentList']);
                    Route::match(['get','post'],'/ar/account/view/{id}',[AccountReceivableController::class, 'view']);
                    Route::match(['get','post'],'/ar/account/list',[AccountReceivableController::class, 'list']);
                    Route::get('ar/customer/InvoiceGenerate/{id}', [AccountReceivableController::class, 'InvoiceGenerate']);
                    Route::get('ar/shipper-EmailSent', [AccountReceivableController::class, 'ShipperEmailSent']); 
                    Route::get('ar/PaymentUpdateForm', [AccountReceivableController::class, 'PaymentUpdateForm']); 
                    Route::get('ar/PaymentUpdateSubmit', [AccountReceivableController::class, 'PaymentUpdateSubmit']); 
                    Route::get('ar/aging/invoiceGenerated', [AccountReceivableController::class, 'AgingInvoiceGenerated']);
                    Route::get('ar/pay/completed', [AccountReceivableController::class, 'ArPayCompleted']);
        
                    Route::get('/ar/payment-history', function () {
                        return view('backend/shipmentManagement/ar-dashboard/payment-history');
                    });
        
                    Route::get('ar/Payment-Comment', [ArCommentController::class, 'PaymentComment']); 
                    Route::get('ar/Payment-CommentSubmit', [ArCommentController::class, 'PaymentCommentSubmit']);                     
        
                    Route::get('apcomment', [ApCommentController::class, 'index']);
                    Route::get('apcomment/list', [ApCommentController::class, 'list']);
                    Route::match(['get','post'],'/apcomment/add',[ApCommentController::class, 'add']);
                    Route::match(['get','post'],'/apcomment/fetchcommentdata/',[ApCommentController::class, 'fetchcommentdata']);
                    Route::match(['get','post'],'/apcomment/documentupload/',[ApCommentController::class, 'documentupload']);
                    Route::match(['get','post'],'/apcomment/apdocumentfetch/',[ApCommentController::class, 'apdocumentfetch']);
                    Route::match(['get','post'],'/apcomment/notification/{nid}',[NotificationController::class, 'notification_assignuser']);
                    
                    Route::get('/setting/company-details', [CompanySettingController::class, 'index']);
                    Route::get('/setting/email', [CompanySettingController::class, 'emailSetting']);
                    Route::post('/setting/SendTestEmail', [CompanySettingController::class, 'SendTestEmail']);
                    Route::get('/setting/email-template', [CompanySettingController::class, 'emailtemplateSetting']);
                    Route::get('/setting/api', [CompanySettingController::class, 'apiSetting']);
                    Route::post('/setting/api-DatSave', [CompanySettingController::class, 'ApiDatSave']);
                    Route::post('/setting/api-carrierpacket', [CompanySettingController::class, 'ApiCarrierPacket']);
                    Route::post('/save-company-details', [CompanySettingController::class, 'addcdetails'])->name('save-company-details');
                    Route::post('/email-setting-action', [CompanySettingController::class, 'addemaildetails'])->name('email-setting-action');
                    Route::get('/setting/ip', [CompanySettingController::class, 'manageIP']);
                    

                    // for ip checker 
                    // Route::get('ipchecker', [AccountsPayableController::class, 'index']);
                    // Route::get('ipchecker/list', [AccountsPayableController::class, 'list']);
                    Route::match(['get','post'],'/ipchecker/add',[IpCheckerController::class, 'add']);
                    Route::match(['get','post'],'/ipchecker/edit/{id}',[IpCheckerController::class, 'edit']);
                    Route::match(['get','post'],'/ipchecker/view/{id}',[IpCheckerController::class, 'show']);
                    Route::match(['get','post'],'/ipchecker/delete/{id}',[IpCheckerController::class, 'delete']);
                     Route::match(['get','post'],'/ipcheckerstatus',[IpCheckerController::class, 'ipStatus']);
                    // Route::match(['get','post'],'/ipchecker/notification/{nid}',[NotificationController::class, 'notification_assignuser']);
                    
                    // DAT Api User credential
                    Route::match(['get','post'],'/setting/user/dat/api',[CompanySettingController::class, 'apiuserSetting']);
                    Route::match(['get','post'],'/setting/user/dat/api/{id}',[CompanySettingController::class, 'apiDatSettingUpdate']);
                    Route::match(['get','post'],'/setting/dat/user/api',[CompanySettingController::class, 'dataapiuserlist']);
                    
                    
                    Route::match(['get','post'],'/setting/dat/user/status/api',[CompanySettingController::class, 'datuserstatus']);
                    
                    
                    Route::match(['get','post'],'/setting/dat/show/admin',[CompanySettingController::class, 'showadminapi']);
                    Route::match(['get','post'],'/setting/dat/show/self',[CompanySettingController::class, 'showselfapi']);
                    
                    
                    
                    //End  for api user dat credential
                    
                    // DAT Api User Auth credential
                    Route::match(['get','post'],'/setting/dat/user/auth/api',[CompanySettingController::class, 'datauthuserapi']);
                    
                    
                    
                    
                    
                    
                    
                    //token generate carrier packet
                    Route::match(['get','post'],'/setting/carriertoken/',[CompanySettingController::class, 'carriertoken']);
                    Route::match(['get','post'],'/setting/dottoken/',[CompanySettingController::class, 'dottoken']);
                    Route::match(['get','post'],'/setting/userdattoken/',[CompanySettingController::class, 'userdattoken']);
                    
                    Route::match(['get','post'],'/setting/userdattoken/info',[CompanySettingController::class, 'userdattokeninfo']);
                    
                    
                    // Activity Module Start
                    Route::match(['get','post'],'/new-activity',[ActivityModuleController::class, 'activity']);
                    Route::match(['get','post'],'/new-activity/{id}',[ActivityModuleController::class, 'activityView']);
                    Route::match(['get','post'],'/delete-activity',[ActivityModuleController::class, 'deleteActivity']);
                    Route::match(['get','post'],'/delete-activity-all',[ActivityModuleController::class, 'deleteActivityAll']);
                    Route::match(['get','post'],'/load-activity/{id}',[ActivityModuleController::class, 'loadActivity']);
                    Route::match(['get','post'],'/load-activity/details/{id}',[ActivityModuleController::class, 'loadActivityDetails']);
                    
                    // Activity Module Start End
                    // All Notification here START
                     Route::match(['get','post'],'/notification',[NotificationController::class, 'index']);
                     Route::match(['get','post'],'/notification/update',[NotificationController::class, 'notifyStatus']);
                     Route::match(['get','post'],'/notification/read',[NotificationController::class, 'notificationRead']);
                     Route::match(['get','post'],'/notification/read/all',[NotificationController::class, 'notificationAllRead']);
					 Route::match(['get','post'],'/notification/message/read/all',[NotificationController::class, 'notificationMessAllRead']);
					 Route::match(['get','post'],'/notification/messsage',[NotificationController::class, 'notificationMesssage']);
					 Route::match(['get','post'],'/notification/messsage/shipper',[NotificationController::class, 'notificationShipper']);
					 Route::match(['get','post'],'/notification/messsage/load',[NotificationController::class, 'notificationLoad']);
                    //  Route::get('admin/notification/update/{id}',[NotificationController::class, 'update']);
                     // All Notification  here End 
                     
                    // Carrier Payments Start
                    Route::match(['get','post'],'/carrier/payment/updates',[CarrierPaymentController::class, 'CarrierPayment']);
                    Route::match(['get','post'],'/carrier/urgent/payment',[CarrierPaymentController::class, 'CarrierUrgentPay']);
                    Route::match(['get','post'],'/carrier/account/details/{id}',[CarrierPaymentController::class, 'CarrierPayUpdate']);
                    Route::match(['get','post'],'/carrier/payment/complete/{id}',[CarrierPaymentController::class, 'PayCompleted']);
                    Route::match(['get','post'],'/carrier/payment/aging',[CarrierPaymentController::class, 'PaymentAging']);
                    Route::match(['get','post'],'/carrier/payment/highlight/{id}',[CarrierPaymentController::class, 'PaymentHighlight']);
                    Route::match(['get','post'],'/carrier/payment/quickpay/',[CarrierPaymentController::class, 'PaymentQuickPay']);
                    Route::match(['get','post'],'/carrier/pending/payment',[CarrierPaymentController::class, 'PendingPayment']);
                    Route::match(['get','post'],'/carrier/pending/payment/{id}',[CarrierPaymentController::class, 'CarrierPayDetails']);
                    Route::match(['get','post'],'/carrier/pending/payment/done/{id}',[CarrierPaymentController::class, 'CarrierPayDone']);
                    Route::match(['get','post'],'/carrier/done/payment',[CarrierPaymentController::class, 'DonePayments']);
                    // Carrier Payments End
                    
                    //Dashboard Chart list For Admin
                    Route::get('/chart', [HomeController::class, 'handleChart']);
                    //report 
                    Route::match(['get','post'],'/report',[ReportController::class, 'index']);
                    Route::get('/load-report/{id}',[ReportController::class, 'loadReport']);

                    //agency
                    // Route::match(['get','post'],'/agency-report',[ReportController::class, 'agencyreport']);
                    Route::get('/agency-report/{id}',[ReportController::class, 'agencyreport']);
                    
                    //shipment
                    Route::get('/shipment-report',[ReportController::class, 'shipmentreport']);
                    //shipper
                    Route::get('/shipper-report',[ReportController::class, 'shipperreport']);
                    
                    Route::get('/file-import',[UserController::class,'importView']);
                    Route::post('/import',[UserController::class,'import']);
                    
                    Route::get('/email-template', function () {
                        return view('emails/CarrierPacketInvite/invite_link');
                    });
        
        
                    Route::get('/search-intellivite', function () {
                        return view('');
                    });
                    Route::get('/carrier-profile', function () {
                        return view('backend/search-intellivite/profile');
                    });
                    
                    Route::get('/setting', function () {
                        return redirect(url('/admin/setting/company-details'));
                    });
                    
                    Route::get('/ar_dashboard', function () {
                        return view('backend/shipmentManagement/ar-dashboard/index');
                    });
                    
                    Route::get('/ar/all-payment', function () {
                        return view('backend/shipmentManagement/ar-dashboard/all-payment');
                    });
                    
                    Route::get('/shipment-pdf', function () {
                        return view('backend/shipmentManagement/shipment/pdf');
                    });
                    
        
        
                    // For internal cache remove only 
                    Route::match(['get','post'],'/clear', function(){
                        Artisan::call('cache:clear');
                        Artisan::call('config:clear');
                        Artisan::call('config:cache');
                        Artisan::call('view:clear');
                        return view('home')->with('success', 'Clear Success Fully Cache, Config, Route, View');
                        // return view('online-games.online-game.show', compact('onlinegame'));
                    });
                    
                    Route::match(['get','post'],'/schedule',[CompanySettingController::class, 'schedule']);
        
            });
        });
        
    Route::match(['get','post'],'/clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return  "Clear Success Fully Cache, Config, Route, View";
        // return Redirect::back()->with('msg', 'The Message');
        // return Redirect::view('welcome')->withErrors(['message' => 'The Message']);
     });
    Route::match(['get','post'],'/migrate', function() {
        Artisan::call('migrate');
        return  "Migration Success Fully";  
        // return Redirect::back()->with('msg', 'The Message');
        // return Redirect::view('welcome')->withErrors(['message' => 'The Message']);
     });
     
    Route::get('/admin/carrier/profile', function () {
        return view('backend/shipmentManagement/carrier/profile');
    });

    Route::get('/setup-new-carrier', [CarrierController::class, 'setup_new_carrier'])->name('new_carrier');
     
    //Route::post('/rest/password', function () { return view('passwordrest');});
    
    Route::match(['get','post'],'/admin/carrier-bol-new/',[ShipmentController::class, 'CarrierBOlnew']);
    
    //Frontend Api Start Here 
            
        Route::match(['get','post'],'/ref/{id}', [NewReferenceController::class, 'showload']);
        Route::match(['get','post'],'/refd', [NewReferenceController::class, 'showload']);
        Route::match(['get','post'],'/refuser', [NewReferenceController::class, 'showudata']);

    
    //Api End Here 
   
if (!defined('PROJECT_NAME')) define('PROJECT_NAME','AMB Logistic');

if (!defined('COPYRIGHT_NAME')) define('COPYRIGHT_NAME','Copyright © 2023. All right reserved.');
if (!defined('BACKEND_COMMON_PATH')) define('BACKEND_COMMON_PATH',asset('public/backend/assets'));
if (!defined('BACKEND_COMMON_DOC')) define('BACKEND_COMMON_DOC',asset('public/shipment_doc'));
if (!defined('BACKEND_INVOICE_DOC')) define('BACKEND_INVOICE_DOC',asset('public/invoice_generate'));
if (!defined('ADMIN_FACKIMG_PATH')) define('ADMIN_FACKIMG_PATH',asset('public/backend/profile/profile.png/'));
if (!defined('ADMIN_DOC_PATH')) define('ADMIN_DOC_PATH',asset('public/backend/default/document.png/'));
if (!defined('SYSTEM_IMG_PATH')) define('SYSTEM_IMG_PATH',asset('public/backend/assets/default/'));
if (!defined('BACKEND_IMG_PATH')) define('BACKEND_IMG_PATH',asset('public/backend/assets/images/'));
if (!defined('BACKEND_CSS_PATH')) define('BACKEND_CSS_PATH',asset('public/backend/assets/css/'));
if (!defined('BACKEND_JS_PATH')) define('BACKEND_JS_PATH',asset('public/backend/assets/js/'));
if (!defined('BACKEND_PLGIN_PATH')) define('BACKEND_PLGIN_PATH',asset('public/backend/assets/plugins/'));

