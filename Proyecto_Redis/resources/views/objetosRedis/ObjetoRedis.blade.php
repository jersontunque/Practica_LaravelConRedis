{{-- resources/views/objetos/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Objetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-3">Listado de Objetos ({{ $objetos->count() }})</h1>

    {{-- Formulario de filtro --}}
    <form method="GET" action="{{ route('objetos.index') }}" class="row g-2 mb-4">
        <div class="col-auto">
            <select name="persona" class="form-select">
                <option value="">-- Todas las personas --</option>
                @foreach ($personas as $p)
                    <option value="{{ $p }}" {{ request('persona') == $p ? 'selected' : '' }}>
                        {{ $p }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <input type="text" name="buscar" class="form-control"
                   placeholder="Buscar por nombre..."
                   value="{{ request('buscar') }}">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('objetos.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Persona</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($objetos as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->nombre }}</td>
                    <td>{{ $obj->descripcion }}</td>
                    <td>{{ $obj->Persona }}</td>
                    <td>{{ $obj->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay resultados con ese filtro</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>