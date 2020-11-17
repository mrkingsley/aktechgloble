<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
  
class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function import(Request $request)

    {

        $request->validate([

            'import_file' => 'required'

        ]);

 

        $path = $request->file('import_file')->getRealPath();

        $data = Excel::load($path)->get();

 

        if($data->count()){

            foreach ($data as $key => $value) {

                $arr[] = ['name' => $value->name, 'price' => $value->price];

            }

 

            if(!empty($arr)){

                Product::insert($arr);

            }

        }

 

        return back()->with('success', 'Insert Record successfully.');

    }

}
