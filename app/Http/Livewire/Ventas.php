<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ventas extends Component
{
    public $sales, $date, $name, $identification, $email, $amount, $service, $zone ,$sale_id;
    public $isOpen = 0;

    // $user_id = auth()->user()->getAuthIdentifier();
    // Venta::where('user_id', auth()->user()->id)

    public function render()
    {
        // $ventas = Venta::where('user_id', '=', Auth::id())->get()->toArray();
        $this->sales = Sale::where('user_id', '=', Auth::id())->get();
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
        $this->amount = '';
        $this->service = '';
        $this->zone = '';
        $this->sale_id = '';
    }

    public function store()
    {
        $this->validate([
            'date' => 'required',
            'name' => 'required',
            'identification' => 'required',
            'email' => 'required',
            'amount' => 'required',
            'service' => 'required',
            'zone' => 'required',
        ]);

        $user = auth()->user();
        $user_id = $user->id;

        Sale::updateOrCreate(['id' => $this->sale_id], [
            'date' => $this->date,
            'name' => $this->name,
            'identification' => $this->identification,
            'email' => $this->email,
            'amount' => $this->amount,
            'service' => $this->service,
            'zone' => $this->zone,
            'user_id' => $user_id
        ]);

        session()->flash('message',
            $this->sale_id ? 'Venta actualizada correctamente' : 'Venta Creada Correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $this->id = $id;
        $this->date = $sale->date;
        $this->name = $sale->name;
        $this->identification = $sale->identification;
        $this->email = $sale->email;
        $this->amount = $sale->amount;
        $this->service = $sale->service;
        $this->zone = $sale->zone;

        $this->openModal();
    }

    public function delete($id)
    {
        Sale::find($id)->delete();
        session()->flash('message', 'Venta Eliminada Correctamente.');
    }

}
