<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Administrar Ventas
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
                <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Venta</button>
                <a href="{{ route('descargarPDF') }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reporte Ventas</a>
                <a href="{{ route('descargarAllPdf') }}" target="_blank" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reporte Todas las Ventas</a>
            @if($isOpen)
                @include('livewire.ventas.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">Id.</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Identificacion</th>
                    <th class="px-4 py-2">Correo</th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Servicio</th>
                    <th class="px-4 py-2">Zona</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if($sales !== null)
                        @foreach($sales as $sale)
                            <tr>
                                <td class="border px-4 py-2">{{ $sale->id }}</td>
                                <td class="border px-4 py-2">{{ $sale->date }}</td>
                                <td class="border px-4 py-2">{{ $sale->name }}</td>
                                <td class="border px-4 py-2">{{ $sale->identification }}</td>
                                <td class="border px-4 py-2">{{ $sale->email }}</td>
                                <td class="border px-4 py-2">{{ $sale->amount }}</td>
                                <td class="border px-4 py-2">{{ $sale->service }}</td>
                                <td class="border px-4 py-2">{{ $sale->zone }}</td>

                                <td class="border px-4 py-2">
                                    <button wire:click="edit({{ $sale->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button wire:click="delete({{ $sale->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
