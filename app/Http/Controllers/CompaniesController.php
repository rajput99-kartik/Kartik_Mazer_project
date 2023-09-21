<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB,Hash,DateTime,Mail,PDF,File,Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\companies;
use App\Http\Requests;
use App\Models\User;
use Auth;

class CompaniesController extends Controller
{
	
	
	public function companies_dashboard(){   
	
	
		 $user_id = auth()->user()->id ;
               
            $user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            
            $Equipments = DB::table('equipments_type')->get();
            
            $companies_data = DB::table('companies')->where([
                        ['user_id', '=', $user_id],
                    ])->orderBy('companies_id','DESC')->get();

            $active = 'companies';
            return view('backend.companyManagement.index',['active'=>$active,'user'=>$user,'companies_data'=>$companies_data,'Equipments'=>$Equipments]);
                    
	
	}
	
	public function create_shipper(){
	    return view("backend.companyManagement.create_shipper");
	}
	
	
	/* Add new shipper function start here */
	public function new_companies(){ 
		
		print_r($_POST);die;
	
	}
	/* Add new shipper function end here */
	
	
 }