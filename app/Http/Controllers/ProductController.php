<?php

namespace App\Http\Controllers;
use File;
use App\Product;
use App\HistoryProduct;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use yajra\Datatables\Datatables;

class ProductController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(){

        $products = Product::when(request('search'), function($query){
                        return $query->where('name','like','%'.request('search').'%');
                    })
                    ->orderBy('created_at','desc')
                    ->paginate(8);
        return view('product.index',compact('products'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){

        DB::beginTransaction();

        try{
            $id = $request->id;

            if($id){
                $this->validate($request, [
                    'name' => 'required|min:2|max:200',
                    'product_code' => 'required',
                    'price' => 'required',
                    'sales_price' => 'required',

                ]);

                if($request->addQty){
                    $qty = $request->qty + $request->addQty;
                    if($qty < 0){
                        return redirect()->back()->with('errorQty','Quantity cant be lower than zero');
                    }
                }else{
                    $qty = $request->qty;
                }

                $product_id = Product::find($id);
                if($request->has('image')){
                    $gambar = $request->image;
                    $new_gambar = time().$gambar->getClientOriginalName();
                    Image::make($gambar->getRealPath())->resize(null, 200, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();

                    File::delete(public_path($product_id->image));

                    $product = [
                        'name' => $request->name,
                        'price' => $request->price,
                        'qty' => $qty,
                        'image' => 'uploads/images/'.$new_gambar,
                    ];
                }
                else{
                    $product = [
                        'name' => $request->name,
                        'model' => $request->model,
                        'brand' => $request->brand,
                        'category' => $request->category,
                        'price' => $request->price,
                        'price' => $request->sales_price,
                        'qty' => $qty,
                    ];
                }
                $product_id->update($product);
                if($request->addQty){
                    HistoryProduct::create([
                        'product_id' => $product_id->id,
                        'user_id' => Auth::id(),
                        'qty' => $request->qty,
                        'qtyChange' => $request->addQty,
                        'tipe' => 'change product qty from admin'
                    ]);
                }

                $message = 'Data Berhasil di update';

                DB::commit();
                return redirect()->back()->with('success',$message);
            }else{
                $this->validate($request, [
                    'name' => 'required|min:2|max:200',
                    'price' => 'required',
                    'qty' => 'required',
                    // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:25000',
                ]);

                // $gambar = $request->image;
                // $new_gambar = time().$gambar->getClientOriginalName();

                $product = Product::create([
                        'name' => $request->name,
                        'model' => $request->model,
                        'brand' => $request->brand,
                        'category' => $request->category,
                        'price' => $request->price,
                        'sales_price' => $request->sales_price,
                        'qty' => $request->qty,
                        // 'image' => 'uploads/images/'.$new_gambar,
                        'user_id' => Auth::id()
                ]);

                // Image::make($gambar->getRealPath())->resize(null, 200, function ($constraint) {
                //     $constraint->aspectRatio();
                // })->save(public_path('uploads/images/' . $new_gambar));

                HistoryProduct::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::id(),
                    'qty' => $request->qty,
                    'qtyChange' => 0,
                    'tipe' => 'created product'
                ]);

                $message = 'Data successfully saved';

                DB::commit();
                return redirect()->route('products.index')->with('success',$message);
            }
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->route('products.create')->with('error',$e);
        }
    }

    public function edit($id){

        $product = Product::find($id);
        $history = HistoryProduct::where('product_id',$id)->orderBy('created_at','desc')->get();
        return view('product.edit',compact('product','history'));
    }

    public function destroy(Request $request,$id){
        DB::beginTransaction();

        try{
        $product = Product::find($id);
        $product->delete();
        File::delete(public_path($product->image));

        DB::commit();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
        }
        catch(\Exeception $e){
            DB::rollback();
            return redirect()->route('products.index')->with('error',$e);
        }


    }

}
