<x-zapatos>

    <table class="table-auto">
        <thead>
            <th class="px-6 py-2 text-gray-500">
                Código
            </th>
            <th class="px-6 py-2 text-gray-500">
                Zapato
            </th>
            <th class="px-6 py-2 text-gray-500">
                Precio
            </th>
            <th class="px-6 py-2 text-gray-500">
                Añadir al carrito
            </th>

        </thead>
        <tbody>
            @foreach ($zapatos as $zapato)
                <tr>
                    <td class="px-6 py-2">{{ $zapato->codigo}}</td>
                    <td class="px-6 py-2">{{ $zapato->denominacion}}</td>
                    <td class="px-6 py-2">{{ $zapato->precio }}</td>
                    <td class="px-6 py-2">
                        <div class="text-sm text-gray-900 ">
                            <form action="{{ route('carrito.meter', $zapato) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="px-4 py-1 text-sm text-white bg-red-400 rounded">Añadir al carrito</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/carritos" class="mt-4 text-blue-900 hover:underline">Carrito</a>
    <a href="/dashboard" class="mt-4 text-blue-900 hover:underline">Volver</a>
</x-zapatos>
