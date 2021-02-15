<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $token = $user->createToken('userToken')->accessToken;
            $result=[];
            $result['name']=$user->name;
            $result['token']= $token;
            $result['role']= $user->rol;
            return response()->json($result,200);
        }else{
            return response()->json(['error'=>'Not authenticated.'],401);
        }
    }
        
    /*
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token ->revoke();

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
    public function show(Integer $id)
    {
        $user = DB::table('users')->where('id', '=', $id)->get();
        return $user;
    }
}
