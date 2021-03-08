<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\AssignOp\Concat;

class PDFController extends Controller
{
    public function PDF() {
        $sales = Auth::user()->sales()->get();
        $pdf = PDF::loadView('livewire.ventas.invoice', compact('sales'));
         return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function allSalesPDF(){
        $sales = Sale::all();
        $pdf = PDF::loadView('livewire.ventas.allinvoices', compact('sales'));
        return $pdf->setPaper('a4', 'landscape')->stream(now()->toDateTimeString());
    }

    public function userSalePdf($id) {
        $sales = User::find($id)->sales()->get();
        $user = User::where('id', $id)
            ->with('zone')
            ->get();
        $pdf = PDF::loadView('livewire.ventas.invoice', ['sales' => $sales, 'user' => $user]);
        return $pdf->setPaper('letter')->stream(now()->toDateTimeString());
    }

    public function invoicePDF($id, $email, $name) {

        $sales = Auth::user()->sales()->where('sale_id', $id)->get();
        $user = User::where('id', auth()->id())
            ->with('zone')
            ->get();

        $pdf = PDF::loadView('livewire.ventas.invoice', ['sales' => $sales, 'user' => $user]);
        $date = Carbon::now();
        $date->format('Y-m-d');

        Mail::send('livewire.ventas.invoice', ['sales' => $sales], function ($message) use ($pdf, $email, $name, $date){
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to($email)->subject('Comprobante de Pago');
            $message->attachData($pdf->output(), "COMPROBANTE"."_"."DE"."_"."PAGO"."_".$name."_".$date.".pdf");
        });

        return $pdf->setPaper('a4')->stream(now()->toDateTimeString());
    }

    public function detailSale($id) {
        $sales = Sale::with('salesUsers')->where('id', '=', $id)->get();
        $pdf = PDF::loadView('livewire.ventas.detail_invoice', ['sales' => $sales]);
        return $pdf->setPaper('letter')->stream(now()->toDateTimeString());
    }


}
