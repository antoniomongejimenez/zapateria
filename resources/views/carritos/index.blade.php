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
</x-carritos>
