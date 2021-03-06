<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{

    use WithPagination;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '5']];

    public $name, $email, $identification, $phone, $password, $zone_id, $user_id, $role_id;
    public $isOpen = 0;
    public $search = '';
    public $perPage = '5';
    public $zones;
    public $roles;

    public function render()
    {
        $users = User::whereHas('zone', function ($query) {
            $query->where('name', 'LIKE', "%{$this->search}%");
        })
            ->orWhere('name', 'LIKE', "%{$this->search}%")
            ->orWhere('identification', 'LIKE', "%{$this->search}%")
            ->orWhere('phone', 'LIKE', "%{$this->search}%")
            ->orWhere('email', 'LIKE', "%{$this->search}%")
            ->with('zone')
            ->with('role')
            ->latest()
            ->paginate($this->perPage);
        $this->zones = Zone::all();
        $this->roles = Role::all();
        return view('livewire.usuarios.usuarios', ['users' => $users]);
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
        $this->email = '';
        $this->identification = '';
        $this->phone = '';
        $this->password = '';
        $this->zone_id = '';
        $this->user_id = '';
        $this->role_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'zone_id' => 'required',
            'role_id' => 'required'
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'phone' => $this->phone,
            'zone_id' => $this->zone_id,
            'role_id' => $this->role_id,
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
        $this->password = $user->password;
        $this->zone_id = $user->zone_id;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario Eliminado Correctamente.');
    }

}
