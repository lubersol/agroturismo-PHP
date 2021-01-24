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

        $token = $user->createToken('Personal Access Token');
        // if ($request->remember_me)
        //     $token->expires_at = Carbon::now()->addWeeks(1);
        // $token->save();

        return response()->json([
            'access_token' => $token->accessToken,
            // 'token_type' => 'Bearer',
            // 'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
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
