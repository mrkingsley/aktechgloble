<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::when(request('search'), function($query){
            return $query->where('supplier_name','like','%'.request('search').'%')
            ->orwhere('product','like','%'.request('search').'%')
            ->orwhere('created_at','like','%'.request('search').'%');
        })
        ->orderBy('created_at','desc')->paginate(100);
        return view('purchase.index', ['purchase' => $purchases]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('purchase.create', ['products'=>$products,'suppliers'=>$suppliers]);
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
            'product' => 'required',
            'purchase_price' => 'required',
            'qty' => 'required',
            'remark' => '',
        ]);
        $input = $request->all();
        $purchase = Purchase::create($input);
        return redirect()->route('purchase.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchase.show', ['client' => $purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('purchase.edit', ['products'=>$products,'suppliers'=>$suppliers], compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $purchase->supplier_name = $request->supplier_name;
        $purchase->product = $request->product;
        $purchase->purchase_price = $request->purchase_price;
        $purchase->qty = $request->qty;
        $purchase->remark = $request->remark;
        $purchase->save();
        return redirect(route('purchase.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect(route('purchase.index'));
    }
}
