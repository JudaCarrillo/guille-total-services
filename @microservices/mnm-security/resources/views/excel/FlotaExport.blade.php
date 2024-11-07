<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>PLACA</td>
            <td>CONDUCTOR</td>
            <td>TIPO</td>
            <td>MARCA</td>
            <td>MODELO</td>
            <td>EMPRESA</td>
            <td></td>
            <td></td>
            <td>ID</td>
            <td>CONDUCTOR</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($Personal as $personal)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $personal->id }}</td>
                <td>{{ $personal->persona->nombre }} {{ $personal->persona->apellido_paterno }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
