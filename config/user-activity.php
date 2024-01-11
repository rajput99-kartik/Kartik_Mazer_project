<?php

return [
    'activated'        => true, // active/inactive all logging
    'middleware'       => ['web', 'auth'],
    'route_path'       => 'admin/user-activity',
    'admin_panel_path' => 'admin/dashboard',
    'delete_limit'     => 7, // default 7 days

    'model' => [
        'user' => "App\Models\User",
        'company' => "App\Models\Company",
        'userdetail' => "App\Models\Userdetail",
        'trucksearch' => "App\Models\Truck_search",
        'state' => "App\Models\State",
        'shipperrequest' => "App\Models\Shipper_request",
        'Shipmentrate' => "App\Models\Shipmentrate",
        'Shipmentpick' => "App\Models\Shipmentpick",
        'Shipmentdrop' => "App\Models\Shipmentdrop",
        'ShipmentDoc' => "App\Models\ShipmentDoc",
        'Shipment' => "App\Models\Shipment",
        'PaymentHistory' => "App\Models\PaymentHistory",
        'Ordercategory' => "App\Models\Ordercategory",
        'Order' => "App\Models\Order",
        'Notification' => "App\Models\Notification",
        'LoadComment' => "App\Models\LoadComment",
        'Load' => "App\Models\Load",
        'Invoices' => "App\Models\Invoices",
        'EquipmentType' => "App\Models\EquipmentType",
        'EmailSetting' => "App\Models\EmailSetting",
        'Dat' => "App\Models\Dat",
        'Customer' => "App\Models\Customer",
        'Country' => "App\Models\Country",
        'Companydetail' => "App\Models\Companydetail",
        'City' => "App\Models\City",
        'Carriers' => "App\Models\Carriers",
        'Carrier_account' => "App\Models\Carrier_account",
        'AssignUserTeam' => "App\Models\AssignUserTeam",
        'AssignAcReceivable' => "App\Models\AssignAcReceivable",
        'AssignAcPayable' => "App\Models\AssignAcPayable",
        'ArComment' => "App\Models\ArComment",
        'ApComment' => "App\Models\ApComment",
        'Agency' => "App\Models\Agency",
        'Agency_detail' => "App\Models\Agency_detail",
        'AccountsPayable' => "App\Models\AccountsPayable",
        'AccountReceivable' => "App\Models\AccountReceivable",
        
    ],

    'log_events' => [
        'on_create'     => true,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];
