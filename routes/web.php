<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::resource('ventas', App\Http\Controllers\VentaController::class);
    // Route::get('ventas', App\Http\Livewire\Ventas::class);
    Route::get('ventas', App\Http\Livewire\Ventas::class)->name('ventas');
    Route::get('usuarios', App\Http\Livewire\Usuarios::class)->name('usuarios');
    Route::get('zonas', App\Http\Livewire\Zonas::class)->name('zonas');
    Route::get('servicios', App\Http\Livewire\Servicios::class)->name('servicios');
    Route::get('pdfVentas', [App\Http\Controllers\PDFController::class, 'PDF'])->name('descargarPDF');
    Route::get('VentasAllPdf', [App\Http\Controllers\PDFController::class, 'allSalesPDF'])->name('descargarAllPdf');
    Route::get('pdfVentas/{id}', [App\Http\Controllers\PDFController::class, 'userSalePdf'])->name('detail_sale_user_pdf');
    Route::get('pdfComprobante/{id}', [App\Http\Controllers\PDFController::class, 'invoicePDF'])->name('invoice_pdf');
});

