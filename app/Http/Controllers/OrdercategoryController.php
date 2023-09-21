<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Ordercategory;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class OrdercategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ordercategory.list|ordercategory-list|ordercategory.edit|ordercategory.delete', ['only' => ['index','show']]);
         $this->middleware('permission:ordercategory-list', ['only' => ['create','store']]);
         $this->middleware('permission:ordercategory.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:ordercategory.delete', ['only' => ['destroy']]);
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$category_data = Ordercategory::latest()->paginate(20);

        //  $user->givePermissionTo('customers-list');

        //$dd = User::with('cat');

        $category_data = DB::table('order_categories')
            ->join('users', 'users.id', '=', 'order_categories.user_id')
            ->join('roles', 'roles.id', '=', 'users.id')
            ->where('roles.name', '=', 'superadmin')
            ->get();

        //dd( $shares );

        User::where('id', 'user_id')->get() ;

         $data = auth()->user()->givePermissionTo('ordercategory-list');
         return view('backend.orderManagement.category.index',compact('category_data','data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.orderManagement.category.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
           'category_name' => 'required',
            //'detail' => 'required',
        ]);
    
        Ordercategory::create($request->all());
    
        return redirect()->route('ordercategory.index')
                        ->with('success','Category created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Ordercategory $ordercategory)
    {
        return view('backend.orderManagement.category.show',compact('ordercategory'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Ordercategory $ordercategory)
    {
        return view('backend.orderManagement.category.edit',compact('ordercategory'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ordercategory $ordercategory){
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
        return redirect()->route('customers.index')
                        ->with('success','Order Category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ordercategory $ordercategory){
        $product->delete();
        return redirect()->route('ordercategory.index')
                        ->with('success','Ordercategory deleted successfully');
    }
}
