<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ventas extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '5']];

    public $date, $name, $identification, $email, $quantity, $service_id, $sale_id;
    public $description;
    public $isOpen = 0;
    public $zone;
    public $services;
    public $total=0;
    public $search = '';
    public $perPage = '5';

    public function render()
    {
        $sales = Sale::whereHas('service', function ($query) {
            $query->where('name', 'LIKE', "%{$this->search}%");
        })
            ->orWhere('name', 'LIKE', "%{$this->search}%")
            ->orWhere('date', 'LIKE', "%{$this->search}%")
            ->orWhere('identification', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->with('service')
            ->latest()
            ->paginate($this->perPage);
        $this->services = Service::all();

        return view('livewire.ventas.ventas', ['sales' => $sales]);

    }

    public function clear()
    {
        $this->search = '';
        $this->page = 1;
        $this->perPage = '5';
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
        $sale->salesUsers()->attach(auth()->user()->getAuthIdentifier(), ['total' => $this->total, 'description' => $this->description]);

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
