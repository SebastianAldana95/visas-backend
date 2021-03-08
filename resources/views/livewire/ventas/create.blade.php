<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Fecha:</label>
                            <input type="date" min={{ date('Y-m-d') }} class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Fecha" wire:model="date">
                            @error('date') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="name" placeholder="Nombre"></input>
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Cedula:</label>
                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="identification" placeholder="Cedula"></input>
                            @error('identification') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Correo:</label>
                            <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="email" placeholder="Correo Electronico"></input>
                            @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Cantidad:</label>
                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Cantidad" wire:model="amount" required>
                            @error('amount') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                                <!-- This example requires Tailwind CSS v2.0+ -->
                                <div class="relative inline-flex">
                                <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Servicio:&nbsp;&nbsp;&nbsp;</label>
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                    <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:model="service">
                                        <option>ASESORIA VISA AMERICANA</option>
                                        <option>ASESORIA VISA CANADA</option>
                                        <option>DERECHO CONSULAR VISA AMERICANA</option>
                                        <option>DERECHO CONSULAR VISA CANADIENSE</option>
                                        <option>CAMBIO DE FORMULARIOS </option>
                                    </select>
                                </div>

                            @error('service') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4"> 
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Zona:</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="EEUU / Canadá" wire:model="zone" required>
                            @error('zone') <span class="text-red-500">{{ $message }}</span>@enderror
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="quantity" placeholder="Cantidad"></textarea>
                            <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="quantity" placeholder="Cantidad"></input>
                            @error('quantity') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <div class="mb-8">
                                <label class="inline-block w-32 font-bold">Servicio:</label>
                                <select name="service_id" wire:model="service_id" class="border rounded shadow p-2 bg-white" required>
                                    <option value='service_id'>Seleccione un servicio</option>
                                    @foreach($services as $service)
                                        <option class="border rounded shadow p-2 bg-white" value={{ $service->id }}>{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Descripcion:</label>
                            <textarea type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" wire:model="description" placeholder="Descripcion Comprobante"></textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                      <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Guardar
                      </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                      <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancelar
                      </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
