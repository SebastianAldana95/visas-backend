<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight
            text-center font-black ">
        Administrar Zonas
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
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Zona</button>
            @if($isOpen)
                @include('livewire.zonas.create')
            @endif
            <table class="table-auto w-50">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">Id.</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Accion</th>
                </tr>
                </thead>
                <tbody>
                @foreach($zones as $zone)
                    <tr>
                        <td class="border px-4 py-2">{{ $zone->id }}</td>
                        <td class="border px-4 py-2">{{ $zone->name }}</td>

                        <td class="border px-3 py-5">
                            <button wire:click="edit({{ $zone->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $zone->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
