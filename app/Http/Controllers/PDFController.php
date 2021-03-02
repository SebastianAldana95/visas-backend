<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class PDFController extends Controller
{
    public function PDF() {
        $sales = Sale::where('user_id', '=', Auth::id())->get();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
         return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function allSalesPDF(){
        $sales = Sale::all();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
        return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function userSalePdf($id) {
        $sales = Sale::where('user_id', '=', $id)->get();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
        return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function invoicePDF($id) {
        $sales = Sale::where('id', '=', $id)->get();
        /*$path = '/img/LOGOS-VISAS.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);*/
        $pdf = PDF::loadView('livewire.ventas.invoice', compact('sales'));
        return $pdf->setPaper('a4')->stream(now()->toDateTimeString());
    }


}
