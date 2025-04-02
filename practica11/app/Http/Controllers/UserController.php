<?php

namespace App\Http\Controllers;

use App\Services\FastApiService;
use Illuminate\Http\Request;

class userController extends Controller
{
    protected $fastApi;

    public function __construct(FastApiService $fastApi)
    {
        $this->fastApi = $fastApi;
    }

    public function inicio()
    {
        return view('formulario');
    }

    public function store(Request $request)
    {
        $usuarioNuevo = $request->validate([
            'txtNombre' => 'required',
            'txtEdad' => 'required',
            'txtCorreo' => 'required',
        ]);

        $usuarioNuevo = [
            'name' => $usuarioNuevo['txtNombre'],
            'age' => $usuarioNuevo['txtEdad'],
            'email' => $usuarioNuevo['txtCorreo'],
        ];

        try{
            $response = $this->fastApi->post('/usuario/', $usuarioNuevo);


            return redirect()->route('usuario.inicio')
                ->with('success', 'Usuario guardado por FASTAPI!');
        }catch(\Exception $e){
            return back()->with('error', 'No fue posible guardar');
        }
    }

    public function index()
{
    try {
        $response = $this->fastApi->get('/todoUsuarios');


        if (isset($response['error'])) {
            return back()->with('error', $response['error']);
        }

        // Asegúrate que sea un array de arrays
        if (!is_array($response) || !isset($response[0]['id'])) {
            return back()->with('error', 'La API no devolvió una lista válida de usuarios.');
        }

        return view('consulta', ['usuarios' => $response]);

    } catch (\Exception $e) {
        return back()->with('error', 'No se pudo obtener la lista de usuarios');
    }
}

public function edit($id)
{
    $usuario = $this->fastApi->get("/Usuarios/{$id}");
    return view('editar', compact('usuario'));
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'txtNombre' => 'required',
        'txtEdad' => 'required',
        'txtCorreo' => 'required',
    ]);

    $usuarioEditado = [
        'name' => $data['txtNombre'],
        'age' => $data['txtEdad'],
        'email' => $data['txtCorreo'],
    ];

    $response = $this->fastApi->put("/usuario/{$id}", $usuarioEditado);

    if (isset($response['error'])) {
        return back()->with('error', $response['error']);
    }

    return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
}

public function destroy($id)
{
    $response = $this->fastApi->delete("/usuario/{$id}");

    if (isset($response['error'])) {
        return back()->with('error', $response['error']);
    }

    return redirect()->route('usuario.index')->with('success', 'Usuario eliminado correctamente.');
}



}
