<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public  $usuarios, $name, $email, $identification, $phone, $password, $user_id;
    public $isOpen = 0;

    public function render()
    {
        $this->usuarios = User::all();
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
        $this->user_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'identification' => 'required',
            'phone' => 'required',
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'identification' => $this->identification,
            'phone' => $this->phone
        ]);

        session()->flash('message',
            $this->user_id ? 'Usuario actualizado correctamente' : 'Usuario Creado Correctamente.');

        $this->closeModal();
        $this->resetInputFields();


    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->identification = $user->identification;
        $this->phone = $user->phone;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario Eliminado Correctamente.');
    }

}
