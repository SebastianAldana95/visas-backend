<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight
            text-center font-black ">
        Administrar Usuarios
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-lightest border-t-4 border-teal rounded-b text-teal-darkest px-4 py-3 shadow-md my-2" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
           <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Usuario</button>
                @if($isOpen)
                    @include('livewire.usuarios.create')
                @endif
            <table class="table-auto w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">Id.</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Identificacion</th>
                    <th class="px-4 py-2">Telefono</th>
                    <th class="px-4 py-2">Zona</th>
                    <th class="px-4 py-2">Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $user)
                    <tr>
                        <td class="border px-4 py-2">{{ $user->id }}</td>
                        <td class="border px-4 py-2">{{ $user->name }}</td>
                        <td class="border px-4 py-2">{{ $user->email }}</td>
                        <td class="border px-4 py-2">{{ $user->identification }}</td>
                        <td class="border px-4 py-2">{{ $user->phone }}</td>
                        <td class="border px-4 py-2">{{ $user->zone->name }}</td>

                        <td class="border px-3 py-5">
                            <!--<button wire:click="edit({{ $user->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>-->
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                            <a href="{{ route('detail_sale_user_pdf',$user->id )}}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Reporte</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
