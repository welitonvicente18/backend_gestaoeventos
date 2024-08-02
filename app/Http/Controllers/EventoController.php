<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Evento::paginate(2);
        foreach ($result as $evento) {
            $evento->logo_evento = Storage::disk('public')->url($evento->logo_evento);
        }

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
        // if (!auth()->check()) {
        //     return response()->json(['status' => 'error', 'msg' => 'Usuário não autenticado.'], 401);
        // }

        $validateData = $request->validate([
            'nome_evento' => 'required',
            'data_inicio' => 'date',
            'data_fim' => 'date',
            'data_prazo_inscricao' => 'date',
            'responsavel' => 'string|max:100',
            'telefone_responsavel' => 'string|max:150',
            'email_responsavel' => 'email',
            'cidade' => 'string|max:100',
            'uf' => 'string|max:2',
            'local' => 'string|max:100',
            'descricao' => 'string|max:500',
            'limite_nscritos' => 'integer',
            'url_inscricao' => 'string|max:300',
            'logo_evento' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Salvar o arquivo
        if ($request->hasFile('logo_evento')) {
            $file = $request->file('logo_evento');
            $file = $file->store('logo_evento', 'public');
            $validateData['logo_evento'] = $file;
        }

        // $validateData['user_id'] = 1;
        $validateData['user_id'] = auth()->user()->user_id;

        $result = Evento::create($validateData);

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

        if($result['logo_evento'] != null){
            $result['logo_evento'] = Storage::disk('public')->url($result['logo_evento']);
        }

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
            'user_id' => 'required',
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
