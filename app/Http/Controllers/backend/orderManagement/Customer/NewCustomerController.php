<?php

namespace App\Http\Controllers\backend\orderManagement\Customer;
use Illuminate\Http\Request;
use App\Models\Customer;

class NewCustomerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:customers-list|customers-create|customers-edit|customers-delete', ['only' => ['index','show']]);
         $this->middleware('permission:customers-create', ['only' => ['create','store']]);
         $this->middleware('permission:customers-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customers-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(20);
        return view('backend.orderManagement.customers.index',compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.orderManagement.customers.create');
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
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Customer::create($request->all());
    
        return redirect()->route('customers.index')
                        ->with('success','Customers created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        return view('backend.orderManagement.customers.show',compact('customers'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        return view('backend.orderManagement.customers.edit',compact('customers'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customers){
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
        return redirect()->route('customers.index')
                        ->with('success','customers updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers){
        $product->delete();
        return redirect()->route('customers.index')
                        ->with('success','Customers deleted successfully');
    }
}
