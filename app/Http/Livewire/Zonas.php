<?php

namespace App\Http\Livewire;

use App\Models\Zone;
use Livewire\Component;

class Zonas extends Component
{

    public $zones, $name, $zone_id;
    public $isOpen = 0;

    public function render()
    {
        $this->zones = Zone::all();
        return view('livewire.zonas.zonas');
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
        $this->zone_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        Zone::updateOrCreate(['id' => $this->zone_id], [
            'name' => $this->name,
        ]);

        session()->flash('message',
            $this->zone_id ? 'Zona actualizada correctamente' : 'Zona Creada Correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $this->zone_id = $id;
        $this->name = $zone->name;

        $this->openModal();
    }

    public function delete($id)
    {
        Zone::findOrFail($id)->delete();
        session()->flash('message', 'Zona Eliminada Correctamente.');
    }
}
