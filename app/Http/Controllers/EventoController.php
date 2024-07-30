<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Evento;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Evento::all();
        if (isset($result[0])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar evento.'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_evento' => 'required',
            'data_inicio' => 'date',
            'data_fim' => 'date',
            'data_prazo_inscricao' => 'date',
            'responsavel' => 'string|max:100',
            'telefone_responsavel' => 'string|max:150',
            'email_responsavel' => 'email',
            'uf' => 'string|max:2',
            'cidade' => 'string|max:100',
            'local' => 'string|max:100',
            'descricao' => 'string|max:500',
            'limite_nscritos' => 'integer',
            'url_inscricao' => 'string|max:300',
        ]);

        $result = Evento::create($request->all());

        if (isset($result['id'])) {
            return response()->json(['status' => 'success', 'msg' => 'Evento criado com sucesso.', 'id' => $result['id']], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar evento.'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Evento::find($id);

        if (isset($result['id'])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar evento.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $evento = Evento::find($id);

        if ($evento === null) {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao encontrar evento.'], 404);
        }

        $validateResquest = $request->validate([
            'nome_evento' => 'required',
            'data_inicio' => 'date',
            'data_fim' => 'date',
            'data_prazo_inscricao' => 'date',
            'responsavel' => 'string|max:100',
            'telefone_responsavel' => 'string|max:150',
            'email_responsavel' => 'email',
            'uf' => 'string|max:2',
            'cidade' => 'string|max:100',
            'local' => 'string|max:100',
            'descricao' => 'string|max:500',
            'limite_nscritos' => 'integer',
            'url_inscricao' => 'string|max:300',
        ]);

        $result = $evento->update($validateResquest);
        
        if ($result) {
            return response()->json(['status' => 'success', 'msg' => 'Evento criado com sucesso.', 'id' => $request['id']], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar evento.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Evento::find($id);
        $result = $evento->delete();

        if ($result) {
            return response()->json(['status' => 'success', 'msg' => 'Excluido com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao excluir evento.'], 404);
        }
    }
}
