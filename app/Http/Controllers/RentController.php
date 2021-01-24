<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class RentController extends Controller
{
    public function indexAll()
    {
        return Rent::all();
    }//Muestra las reservas

    public function index()
    {
        $user = Auth::user();
        $rents = Rent::where('user_id', '=', $user->id)->get();
        return $rents;
    }//Muestra las reservas de un usuario concreto

    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $rules = [
                'startDate' => 'required',
                'endDate' => 'required',
            ];

            $messages = [
                'startDate.required' => 'La fecha de entrada está vacía.',
                'endDate.required' => 'La fecha de salida está vacía.',
            ];

            $validator = Validator::make($input, $rules, $messages);

            if ($validator->fails()) {
                return response()->json([$validator->errors()], 400);
            }

            $user = Auth::user();
            $rent = new Rent($input);
            $rent->user_id = $user->id;
            $rent->save();
            return response()->json($rent, 201);
        } catch (\Exception $e) {
            return response()->json($e, 400);
        }
    }

    /**
     * Change status to cancelled (0) 
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            $deleted = Rent::whereId($id)->delete();
            if ($deleted)
                return response()->json(['message' => 'Reserva cancelada con éxito.'], 200);
            else
                return response()->json(['message' => 'Nada que eliminar.'], 200);
        } catch (\Exception $e) {
            return response()->json($e, 400);
        }
    }
}
