<?php

namespace App\Http\Controllers;

use App\Models\AddApprover;
use Illuminate\Http\Request;

class AddApproverController extends Controller
{
    function index(){
        return view('backend.addApprover.index');
    }

    public function approverSubmit(Request $request){

        
        $abc = new AddApprover;
        $abc->name = $request->inputapprovername;
        $abc->email = $request->inputapproveremail;
        $abc->save();
        

        return redirect('admin/create-approver');

    }
}
