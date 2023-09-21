<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity ;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Shipment;
use App\Models\LoadActivity;
use DB;
use Hash;
use Auth;
use Carbon\Carbon;

class ActivityModuleController extends Controller
{
    public function activityOld(Request $request){
        $agent = new Agent();
        $browser = $agent->browser();
        $authName = Auth::User();
        $data = Activity::orderBy('id','desc')->get();
        $data = Activity::orderBy('created_at','desc')->paginate(16);
        return view('backend.activityModule.index', compact('data','authName'));
    }
    
    public function activity(Request $request){
        $fromDate =$request['fromdate']  ??  "";
        $toDate =$request['todate']  ??  "";
          $date = Carbon::now();
        // dd($date  );
            $search =$request['search']  ??  "";
            if(isset($search)){
                $search =$request['search']  ??  "";
                // dd($search);
                if($search != ""){
                    $data = Activity::where('description', 'LIKE', "%$search%")
                    ->orWhere('event', 'LIKE', "%$search%")
                    ->orWhere('properties', 'LIKE', "%$search%")
                    ->orderBy('created_at','desc')
                    ->paginate('15');
                    $data->appends(array('search'=>  $search,));
                    if(count($data )>0){
                        return view('backend.activityModule.index',['data'=>$data, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                    }
                    return back()->with('error','No results Found');
                }else{
                    $data =  Activity::orderBy('id', 'DESC')->paginate('15');
                }

            }
            // 2023-06-27 00:06:04.351213 Asia/Kolkata (+05:30)
            

            if(isset($fromDate) || isset($toDate)){

                if(empty($toDate) ){
                    
                        //if you want to selected date to current-date data then you can use this select only formdate only
                    
                            //  $data = Activity::whereBetween('created_at', [$fromDate, date('Y-m-d')])->paginate('15');
                            //  $data =  $data->appends(array('fromdate'=>  $fromDate,  'todate'=>  date('Y-m-d')));

                        //if we want to same date data then we use this function 
                        
                            $data = Activity::query()
                            ->whereDate('created_at', '>=', $fromDate)
                            ->whereDate('created_at', '<=', $fromDate)
                            ->paginate('15');

                  //  $toDate = '' ;
                    if(count($data )>0){
                    return view('backend.activityModule.index',['data'=>$data, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                    }
                }
                
                $data = Activity::whereBetween('created_at', [$fromDate, $toDate])->paginate('15');
                $data =  $data->appends(array('fromdate'=>  $fromDate,  'todate'=>  $toDate));

                if(count($data )>0){
                return view('backend.activityModule.index',['data'=>$data, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                }
            }


        $agent = new Agent();
        $browser = $agent->browser();
        $authName = Auth::User();
        $data = Activity::orderBy('id','desc')->get();
        $data = Activity::orderBy('id','desc')->paginate(15);
        return view('backend.activityModule.index', compact('data','authName','search',
        'fromDate', 'toDate'));
    }
    
    
    public function activityView($id){
        $data = Activity::where('id',$id)->first(); 
        
        //dd( $data);
        
        return view('backend.activityModule.view', compact('data','id'));
    }
    
    //delete
    public function deleteActivity(Request $request){
        $deleteActivity = Activity::where('id',$request->activity_id)->delete();
        if($deleteActivity){
            return back()->with('success', 'Activity Deleted Successfully..');
        }
    }
  //  2022-12-02 15:28:19
    //Dec 06, 2022 - 10:45 AM
    public function deleteActivityAll(){
        $deleteActivityall = Activity::whereRaw('DATEDIFF(NOW(), created_at) >= 7')->delete();
        if($deleteActivityall){
            return back()->with('success', 'Success Delete Activity older than 7 days..');
        }else{
            return back();
        }
    }
    
    // load activity
        public function loadActivity($id){
            $loadid = base64_decode($id);
            $LoadActivity = LoadActivity::where('shipment_id_load', $loadid)->orderBy('created_at', 'desc')->get();
            return view('backend.activityModule.load-activity', compact('LoadActivity'));
        }
        
        
        public function loadActivityDetails(Request $request, $id){
            $loadid = $id;
            $LoadActivity = LoadActivity::where('id', $loadid)->first();
            return view('backend.activityModule.load-activity-details', compact('LoadActivity'));
        }
        
}
