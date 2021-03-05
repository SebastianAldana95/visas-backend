<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\AssignOp\Concat;

class PDFController extends Controller
{
    public function PDF() {
        $sales = Auth::user()->sales()->get();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
         return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function allSalesPDF(){
        $sales = Sale::all();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
        return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function userSalePdf($id) {
        $sales = User::find($id)->sales()->get();
        $pdf = PDF::loadView('livewire.ventas.ventapdf', compact('sales'));
        return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function invoicePDF($id) {

        $sales = Auth::user()->sales()->where('sale_id', $id)->get();
        $pdf = PDF::loadView('livewire.ventas.invoice', compact('sales'));

        /*Mail::send('livewire.ventas.invoice', [$sales], function ($sales) use ($pdf){
            $sales->from(auth()->user()->email, auth()->user()->name);
            $sales->to('juancamilop@gmail.com')->subject('Comprobante de Pago');
            // $message->attachData($pdf->output(), 'comprobante.pdf');
            $sales->attachData($pdf, 'comprobante.pdf');
        });*/

        return $pdf->setPaper('a4')->stream(now()->toDateTimeString());
    }


}
