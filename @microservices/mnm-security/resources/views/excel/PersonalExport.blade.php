<table>
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>APELLIDO PATERNO</th>
            <th>APELLIDO MATERNO</th>
            <th>NUMERO DOCUMENTO</th>
            <th>AREA</th>
            <th></th>
            <th></th>
            <th>ID</th>
            <th>AREA</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($Area as $area)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $area->id }}</td>
                <td>{{ $area->nombre }}</td>

            </tr>
        @endforeach
    </tbody>
</table>