<table>
    <thead>
        <tr>
            <td>UBICACION</td>
            <td>SKU</td>
            <td>FAMILIA</td>
            <td>SUB FAMILIA</td>
            <td>ARTICULO</td>
            <td>UNIDAD DE MEDIDA</td>
            <td></td>
            <td></td>
            <td></td>
            <td>ID</td>
            <td>SUB FAMILIA</td>
            <td>FAMILIA</td>
            <td></td>
            <td></td>
            <td></td>


        </tr>
    </thead>
    <tbody>
        @foreach ($SubFamiliaData as $subFamilia)
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
                <td>{{ $subFamilia->id }}</td>
                <td>{{ $subFamilia->nombre }}</td>
                <td>{{ $subFamilia->familia->familia }}</td>
            </tr>  
        @endforeach
    </tbody>
</table>
