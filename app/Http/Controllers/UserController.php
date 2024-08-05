<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:20|unique:users',
            'perfil' => 'nullable',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ]);

        if ($request->perfil == '' || $request->perfil == null) {
            $request->perfil = 2;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'telefone' => $request->telefone,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json(['status' => 'success', 'msg' => 'Usuario cadastrado com sucesso.'], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar usuario.'], 404);
        }
    }


    public function index(Request $request)
    {
        $result = User::paginate(20);
        if (isset($result[0])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar evento.'], 404);
        }
    }

    public function show($id)
    {
        $result = User::find($id);

        if (isset($result['id'])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar cadastro.'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if ($user === null) {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao encontrar cadastro.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:20',
            'perfil' => 'required',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8'
        ]);

        $result = $user->update($request->all());

        if ($result) {
            return response()->json(['status' => 'success', 'msg' => 'Atualizado com sucesso.', 'id' => $request['id']], 201);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao criar cadastrar.'], 404);
        }
    }

}
