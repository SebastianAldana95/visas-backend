<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public  $usuarios, $name, $email, $identification, $phone, $password, $zone_id, $user_id;
    public $isOpen = 0;
    public $zones=[];

    public function render()
    {
        $this->usuarios = User::with('zone')->get();
        return view('livewire.usuarios.usuarios');
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
        $this->email = '';
        $this->identification = '';
        $this->phone = '';
        $this->password = '';
        $this->zone_id = '';
        $this->user_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'identification' => 'required',
            'phone' => 'required',
            'password' => 'required|password',
            'zone_id' => 'required'
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'identification' => $this->identification,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'zone_id' => $this->zone_id,
        ]);

        session()->flash('message',
            $this->user_id ? 'Usuario actualizado correctamente' : 'Usuario Creado Correctamente.');

        $this->closeModal();
        $this->resetInputFields();


    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->identification = $user->identification;
        $this->phone = $user->phone;
        $this->zone_id = $user->zone_id;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario Eliminado Correctamente.');
    }

}
