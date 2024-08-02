<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\User;
use \App\Models\UserPai;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8'
        ]);


        if (auth()->check()) {
            $authID['id'] = auth()->user()->user_id;
        } else {
            $authID = UserPai::create($request->all());
        }
        $user = User::create([
            'user_id' => $authID['id'],
            'name' => $request->name,
            'email' => $request->email,
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
        $result = User::all();
        if (isset($result[0])) {
            return response()->json(['status' => 'success', 'msg' => 'Encontrado com sucesso.', 'data' => $result], 200);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Erro ao buscar evento.'], 404);
        }
    }
}
