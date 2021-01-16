<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // FUNCIONA 
        return $users;
    }
    public function store(Request $request)
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
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('userToken')->accessToken;

            $respuesta = [];
            $respuesta['name'] = $user->name;
            $respuesta['token'] = $token;
            $respuesta['rol'] = $user->rol;
            return response()->json($respuesta, 200);
        } else {
            return response()->json(['error' => 'Not authenticated.'], 401);
        }
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json('Logout done successfully.', 200);
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
