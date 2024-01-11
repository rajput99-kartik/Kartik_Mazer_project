<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Customer;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

    
class RoleController extends Controller
{

    public $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:admin.approve', ['only' => ['create','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);


         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
            
    public function index(Request $request) {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        $roles = Role::all();
        //dd($roles);
        return view('backend.userManagement.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role-create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }

        $permission = Permission::get();
        $all_permissions  = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.userManagement.roles.create', compact('all_permissions', 'permission_groups','permission'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('role-create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.requried' => 'Please give a role name'
        ]);
        // Process Data
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        session()->flash('success', 'Role has been created !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        // $roleid = Crypt::decrypt($id);
        $roleid = base64_decode($id); 
        $role = Role::find($roleid);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$roleid)
            ->get();
    
        return view('backend.userManagement.roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    


    public function edit($id)
    {
         //dd( $id);
        $id = base64_decode($id);
        $role = Role::findById($id, 'web');
        
        //dd($role);        
        if (is_null($this->user) || !$this->user->can('role-edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any role !');
        }

       // $role = Role::findById($id, 'web');
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        // $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

           //dd( $permission);
            //dd( $rolePermissions);
            //dd( $rolePermissions);
        return view('backend.userManagement.roles.edit', compact('role', 'all_permissions', 'permission_groups','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function update(Request $request, $id){
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to edit this role !');
            return back();
        }
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);
        $role = Role::findById($id);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been updated !!');
        return back();
    }
    public function updateOld(Request $request, $id)
    {
        $id = base64_decode($id);
        
        //dd($request);
        
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}