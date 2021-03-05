<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Servicios extends Component
{
    public $services, $name, $price, $commission, $service_id;
    public $isOpen = 0;

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.servicios.servicios');
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
            'commission' => 'required',
        ]);

        Service::updateOrCreate(['id' => $this->service_id], [
            'name' => $this->name,
            'price' => $this->price,
            'commission' => $this->commission,
        ]);

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
