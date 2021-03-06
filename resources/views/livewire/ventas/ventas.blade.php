<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight
    text-center font-black">
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
                @if(auth()->user()->hasRoles(['consultor']))
                    <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear Venta</button>
                    <a href="{{ route('descargarPDF') }}" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Reporte Ventas</a>
                @endif
                <!--@if(auth()->user()->hasRoles(['administrador']))
                    <a href="{{ route('descargarAllPdf') }}" target="_blank" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reporte Todas las Ventas</a>
                @endif-->
                @if($isOpen)
                    @include('livewire.ventas.create')
                @endif
                <div class="flex">
                    @if($search !== '')
                        <button wire:click="clear" class="text-gray-500 py-2 px-4 shadow-sm mt-1 block rounded-md mr-2">X</button>
                    @endif
                    <input wire:model="search" class="rounded-md shadow-sm mt-1 block w-full" type="text" placeholder="Buscar Venta por servicio">
                    <select wire:model="perPage" class="rounded-md shadow-sm mt-1 block text-gray-500 text-sm ml-6">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="20">20 por página</option>
                    </select>
                </div>
            <table class="table-auto w-full">
                @if($sales->count())
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Id.</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Identificacion</th>
                        <th class="px-4 py-2">Correo</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Servicio</th>
                        @if(auth()->user()->hasRoles(['consultor']))
                            <th class="px-4 py-2">Total Venta</th>
                        @endif
                        <th class="px-4 py-2">Accion</th>
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
                                    <td class="border px-4 py-2">{{ $sale->quantity }}</td>
                                    <td class="border px-4 py-2">{{ $sale->service->name }}</td>
                                    @if(auth()->user()->hasRoles(['consultor']))
                                        <td class="border px-4 py-2">${{ number_format($sale->pivot->total, 3) }}</td>
                                    @endif

                                    <td class="border px-4 py-2">
                                        @if(auth()->user()->hasRoles(['administrador']))
                                            <a href="{{ route('invoice_pdf_detalle', ['id' => $sale->id]) }}" target="_blank" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Detalle</a>
                                            <button wire:click="delete({{ $sale->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                        @endif
                                        @if(auth()->user()->hasRoles(['consultor']))
                                                <button wire:click="edit({{ $sale->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                                            <a href="{{ route('invoice_pdf', ['id' => $sale->id, 'email' => $sale->email, 'name' => $sale->name]) }}" target="_blank" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"> Gen. PDF</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="rounded-md shadow-sm mt-1 block w-full text-gray-500 text-center">
                                No hay ventas asociadas para mostrar.
                            </div>
                        @endif
                    </tbody>
                @else
                    <div class="rounded-md shadow-sm mt-1 block w-full text-gray-500 text-center">
                        No hay resultados para la búsqueda "{{$search}}" en la pagina {{$page}} al mostrar {{$perPage}} por página.
                    </div>
                @endif
            </table>
                <div class="rounded-md shadow-sm mt-1 block w-full">
                    {!! $sales->links() !!}
                </div>
        </div>
    </div>
</div>
