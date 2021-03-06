<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Servicios extends Component
{
    use WithPagination;
    public $name, $price, $commission, $service_id;
    public $isOpen = 0;
    public $search = '';
    public $perPage = '5';

    public function render()
    {
        $services = Service::where('name', 'LIKE', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.servicios.servicios', ['services' => $services]);
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
        $this->name = '';
        $this->price = '';
        $this->commission = '';
        $this->service_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'commission' => '',
        ]);

        if (auth()->user()->hasRoles(['consultor']))
        {
            Service::updateOrCreate(['id' => $this->service_id], [
                'name' => $this->name,
                'price' => $this->price,
            ]);
        }
        else
        {
            Service::updateOrCreate(['id' => $this->service_id], [
                'name' => $this->name,
                'price' => $this->price,
                'commission' => $this->commission,
            ]);
        }

        session()->flash('message',
            $this->service_id ? 'Servicio actualizado correctamente' : 'Servicio Creado Correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->service_id = $id;
        $this->name = $service->name;
        $this->price = $service->price;
        $this->commission = $service->commission;

        $this->openModal();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        session()->flash('message', 'Servicio Eliminado Correctamente.');
    }
}
