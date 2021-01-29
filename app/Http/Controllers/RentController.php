<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class RentController extends Controller
{
    public function indexAll()
    {
        return Rent::all();
    }//Muestra las reservas

    public function index($id)
    {
        $rents = DB::table('rents')->where('user_id', '=', $id)->get();
        return $rents;
        // $user = Auth::user();
        // $rents = Rent::where('user_id', '=', $user->id)->get();
        // return $rents;
    }//Muestra las reservas de un usuario concreto

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate'=>'required',
            'endDate'=>'required',
            'room_id'=>'required',
            'user_id'=>'required',  
        ]);
        if ($validator->fails()) {
            return [
                'created'=>false,
                'errors'=>$validator->errors()->all()
            ];
        }
        Rent::create($request->all());
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
