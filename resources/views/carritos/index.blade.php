<x-carritos>
    <table class="table-auto">
        <thead>
            <th class="px-6 py-2 text-gray-500">
                Zapato
            </th>
            <th class="px-6 py-2 text-gray-500">
                Cantidad
            </th>
        </thead>
        <tbody>
            @foreach ($carritos as $carrito)
                <tr>
                    <td class="px-6 py-2">{{ $carrito->zapato->denominacion}}</td>
                    <td class="px-6 py-2">{{ $carrito->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/dashboard" class="mt-4 text-blue-900 hover:underline">Volver</a>
</x-carritos>
