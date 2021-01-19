<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];

        $messages = [
            'name.required' => 'The name field is empty.',
            'email.required' => 'The email field is empty.',
            'password.required' => 'The password field is empty.'
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        } else {
            $user = User::create($input);
            return $user;
        }
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
        //$userRole = $user->role()->first();

        // if ($userRole) {
        //     $this->scope = $userRole->role;
        // }

        $tokenResult = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $tokenResult->accessToken,
        ]);

        }

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();
    //         $token = $user->createToken('userToken')->accessToken;

    //         $respuesta = [];
    //         $respuesta['name'] = $user->name;
    //         $respuesta['token'] = $token;
    //         $respuesta['rol'] = $user->rol;
    //         return response()->json($respuesta, 200);
    //     } else {
    //         return response()->json(['error' => 'Not authenticated.'], 401);
    //     }
     //}
    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
        // $token = $request->user()->token();
        // $token->revoke();

        // return response()->json('Logout done successfully.', 200);
    

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
