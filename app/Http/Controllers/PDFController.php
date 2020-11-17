<?php
namespace App\Http\Controllers;
use App\Transcation;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $transaksi = Transcation::with('productTranscation');
        $pdf = PDF::loadView('laporan.myPDF', array('Transcation'=>$transaksi,'productTranscation'=>$transaksi));

        return $pdf->download('princeajahcom.pdf');
    }
}
