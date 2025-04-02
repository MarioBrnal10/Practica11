<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center text-primary">Editar Usuario</h1>
    <h3 class="text-center text-danger">FastAPI</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('usuario.update', $usuario['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="txtNombre" class="form-label">Nombre</label>
            <input type="text" name="txtNombre" class="form-control" value="{{ $usuario['name'] }}" required>
        </div>

        <div class="mb-3">
            <label for="txtEdad" class="form-label">Edad</label>
            <input type="number" name="txtEdad" class="form-control" value="{{ $usuario['age'] }}" required>
        </div>

        <div class="mb-3">
            <label for="txtCorreo" class="form-label">Correo</label>
            <input type="email" name="txtCorreo" class="form-control" value="{{ $usuario['email'] }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
