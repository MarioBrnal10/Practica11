<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTK2jvjpE5Jtv5R4U0PEbsp0kcYctevnPSpW1yT2R8JY0nUMyJYoMi+ALZ6JXmE" crossorigin="anonymous">
</head>

<body>

<h1 class="display-1 mt-5 text-center text-primary">Consulta de Usuarios</h1>
<h3 class="display-3 mb-5 text-center text-danger">FastAPI</h3>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <p class="text-center">
        <a href="{{ route('usuario.inicio') }}" class="btn btn-primary">Agregar Nuevo Usuario</a>
    </p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Edad</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($usuarios) && is_array($usuarios))
                @foreach($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{ $usuario['id'] }}</th>
                        <td>{{ $usuario['name'] }}</td>
                        <td>{{ $usuario['age'] }}</td>
                        <td>{{ $usuario['email'] }}</td>
                        <td>
                            <a href="{{ route('usuario.edit', $usuario['id']) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('usuario.destroy', $usuario['id']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-danger">No se pudieron obtener usuarios.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-Yvcp+rYYBCY3lUHBd6NWkxcds9f9YELlss8AAS5M2DzhyG8kc1ds1xEkW76J6jzl" crossorigin="anonymous"></script>
</body>
</html>
