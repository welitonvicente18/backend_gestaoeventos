<?php

namespace App\Http\Controllers;

use App\Models\Inscrito;
use Illuminate\Http\Request;

class InscritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Inscrito::all();

        if (isset($result[0])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar cadastro.'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|string|max:11',
            'rg' => 'string|max:20',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|string|max:150',
            'cidade' => 'string|max:100',
            'endereco' => 'string|max:200',
            'cep' => 'string|max:9'
        ]);

        $result = Inscrito::create($request->all());

        if (isset($result['id'])) {
            return response()->json(['status' => 'success', 'msg' => 'Cadastrado criado com sucesso.', 'id' => $result['id']], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar cadastrar.'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Inscrito::find($id);

        if (isset($result['id'])) {
            return response()->json(['status' => 'success', 'msg' => 'Cadastrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar cadastro.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $inscrito = Inscrito::find($id);

        if ($inscrito === null) {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao encontrar cadastro.'], 404);
        }

        $validateResquest = $request->validate([
            'nome' => 'required',
            'cpf' => 'required|string|max:11',
            'rg' => 'string|max:20',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|string|max:150',
            'cidade' => 'string|max:100',
            'endereco' => 'string|max:200',
            'cep' => 'string|max:9'
        ]);

        $result = $inscrito->update($validateResquest);

        if ($result) {
            return response()->json(['status' => 'success', 'msg' => 'Cadastrado com sucesso.', 'id' => $request['id']], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar cadastrar.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Inscrito::find($id);
        $result = $evento->delete();

        if ($result) {
            return response()->json(['status' => 'success', 'msg' => 'Excluido com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao excluir evento.'], 404);
        }
    }
}