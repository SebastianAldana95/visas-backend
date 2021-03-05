<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ventas extends Component
{
    public $sales, $date, $name, $identification, $email, $quantity, $service_id, $sale_id;
    public $isOpen = 0;
    public $zone;
    public $services=[];
    public $total=0;

    public function render()
    {
        $this->sales = Sale::with(['salesUsers', 'service'])->get();
        $this->zone = Auth::user()->zone()->get()->first();
        $this->services = Service::all();
        return view('livewire.ventas.ventas');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->date = '';
        $this->name = '';
        $this->identification = '';
        $this->email = '';
        $this->quantity = '';
        $this->service_id = '';
        $this->sale_id = '';
    }

    public function store()
    {
        $this->validate([
            'date' => 'required',
            'name' => 'required',
            'identification' => 'required',
            'email' => 'required',
            'quantity' => 'required',
            'service_id' => 'required',
        ]);

        $sale = Sale::updateOrCreate(['id' => $this->sale_id], [
            'date' => $this->date,
            'name' => $this->name,
            'identification' => $this->identification,
            'email' => $this->email,
            'quantity' => $this->quantity,
            'service_id' => $this->service_id,
        ]);
        // $sale->salesUsers()->sync(auth()->user()->getAuthIdentifier());
        $this->total = $sale->quantity * $sale->service['price'];
        $sale->salesUsers()->attach(auth()->user()->getAuthIdentifier(), ['total' => $this->total]);

        session()->flash('message',
            $this->sale_id ? 'Venta actualizada correctamente' : 'Venta Creada Correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $this->sale_id = $id;
        $this->date = $sale->date;
        $this->name = $sale->name;
        $this->identification = $sale->identification;
        $this->email = $sale->email;
        $this->quantity = $sale->quantity;
        $this->service_id = $sale->service_id;

        $this->openModal();
    }

    public function delete($id)
    {
        Sale::findOrFail($id)->delete();
        session()->flash('message', 'Venta Eliminada Correctamente.');
    }

}
