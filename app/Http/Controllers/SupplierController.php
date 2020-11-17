<?php

namespace App\Http\Controllers;


use App\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class SupplierController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index','show']]);
         $this->middleware('permission:supplier-create', ['only' => ['create','store']]);
         $this->middleware('permission:supplier-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::when(request('search'), function($query){
            return $query->where('supplier_name','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('supplier.index', ['supplier' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'supplier_name' => 'required',
            'phone' => 'required',
            'email' => '',



        ]);
        $input = $request->all();
        $supplier = Supplier::create($input);
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->supplier_name = $request->supplier_name;
        $supplier->phone = $request->phone;
        $supplier->company = $request->company;
        $supplier->save();
        return redirect(route('supplier.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect(route('supplier.index'));
    }
}
