<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    <x-carritos>
        <table class="table-auto">
            <thead>
                <th class="px-6 py-2 text-gray-500">
                    Zapato
                </th>
                <th class="px-6 py-2 text-gray-500">
                    Cantidad
                </th>
                <th class="px-6 py-2 text-gray-500">
                    Precio individual
                </th>
                <th class="px-6 py-2 text-gray-500">
                    Importe
                </th>
                <th class="px-6 py-2 text-gray-500">
                    Sumar-restar
                </th>
            </thead>
            <tbody>
                @foreach ($carritos as $carrito)
                    <tr>
                        <td class="px-6 py-2">{{ $carrito->zapato->denominacion}}</td>
                        <td class="px-6 py-2">{{ $carrito->cantidad }}</td>
                        <td class="px-6 py-2">{{ $carrito->zapato->precio }} euros</td>
                        <td class="px-6 py-2">{{ $carrito->zapato->precio * $carrito->cantidad }} euros</td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <div>
                                    <form action="{{route('carrito.sumar', $carrito->zapato)}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="inline-flex text-black h-6 px-3 justify-center items-center" type="submit">+</button>
                                    </form>
                                </div>

                                <div>
                                    <form action="{{route('carrito.restar', $carrito->zapato)}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="inline-flex text-black h-6 px-3 justify-center items-center" type="submit"> - </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <form action="{{route('carrito.facturar')}}" method="post">
                @csrf
                @method('POST')
                <button class="bg-green-500 text-black px-5 py-2" type="submit"> Realizar pedido</button>
            </form>
        </div>
        <div class="mt-5">
            <form action="{{route('carrito.vaciar')}}" method="post">
                @csrf
                @method('POST')
                <button class="bg-red-500 text-black px-7 py-2" type="submit"> Vaciar carrito</button>
            </form>
        </div>
    </x-carritos>

</x-app-layout>
