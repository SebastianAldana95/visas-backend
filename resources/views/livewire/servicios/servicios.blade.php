<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight
            text-center font-black ">
        Administrar Servicios
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
                @if(auth()->user()->hasRoles(['administrador', 'consultor']))
                    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Servicio</button>
                    @if($isOpen)
                        @include('livewire.servicios.create')
                    @endif
                @endif
                <div class="flex">
                    @if($search !== '')
                        <button wire:click="clear" class="text-gray-500 py-2 px-4 shadow-sm mt-1 block rounded-md mr-2">X</button>
                    @endif
                    <input wire:model="search" class="rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Buscar Servicio...">
                    <select wire:model="perPage" class="rounded-md shadow-sm mt-1 block text-gray-500 text-sm ml-6">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="20">20 por página</option>
                    </select>
                </div>
            <table class="table-auto w-full">
                @if($services->count())
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Id.</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="vacation-card-price">$Precio</th>
                        <th class="px-4 py-2">$Comision</th>
                        <th class="px-4 py-2">Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td class="border px-2 py-1">{{ $service->id }}</td>
                            <td class="border px-2 py-1">{{ $service->name }}</td>
                            <td class="border px-2 py-1">${{ number_format($service->price, 3) }}</td>
                            <td class="border px-2 py-1">${{ number_format($service->commission, 3) }}</td>

                            <td class="border px-3 py-5">
                                @if(auth()->user()->hasRoles(['administrador', 'consultor']))
                                    <button wire:click="edit({{ $service->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                @endif
                                @if(auth()->user()->hasRoles(['administrador']))
                                    <button wire:click="delete({{ $service->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <div class="rounded-md shadow-sm mt-1 block w-full text-gray-500 text-center">
                        No hay resultados para la búsqueda "{{$search}}" en la pagina {{$page}} al mostrar {{$perPage}} por página.
                    </div>
                @endif
                </tbody>
            </table>
                <div class="rounded-md shadow-sm mt-1 block w-full">
                    {!! $services->links() !!}
                </div>
        </div>
    </div>
</div>
