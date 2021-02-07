<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Mostrar vistas
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            response()->json([
                'created' => false,
                'errors'  => $validator->errors()->all()
            ], 400);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();
        $token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $token->accessToken,
        ]);
    }
    /*
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    //Funcion para obtener de la base de datos el email
    public function getUserByEmail(String $email)
    {
        $userem = DB::table('users')->where('email', '=', $email)->get();
        return $userem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(Integer $id)
    // {
    //     $user = DB::table('users')->where('id', '=', $id)->get();
    //     return $user;
    // }
}
