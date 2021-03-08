<?php

namespace App\Http\Livewire;

use App\Models\Zone;
use Livewire\Component;
use Livewire\WithPagination;

class Zonas extends Component
{
    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '5']];

    public $name, $zone_id;
    public $isOpen = 0;
    public $search = '';
    public $perPage = '5';

    public function render()
    {
        $zones = Zone::where('name', 'LIKE', "%{$this->search}%")
            ->latest()
            ->paginate($this->perPage);
        return view('livewire.zonas.zonas', ['zones' => $zones]);
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
