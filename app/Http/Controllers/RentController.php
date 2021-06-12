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
    } //Muestra las reservas

    public function index($id)
    {
        // $arrRentsWithRoomInfo = [
        //     [
        //         "rent" => [
        //             "id" => 1,
        //             "room_id"=> 2
        //         ],
        //         "room" => [
        //             "id" => 2,
        //             "title" => "habitación doble",
        //             "price" => "120",
        //             "..."
        //         ]
        //     ]
        // ];

        $rents = DB::table('rents')
            ->where('user_id', '=', $id)->get();

        $details = Rent::select('rents.*', 'rooms.*', 'users.name')
            ->join('rooms', 'rooms.id', 'rents.room_id')
            ->join('users', 'users.id', 'rents.user_id')
            ->where('rents.user_id', '=', $id)
            ->get();
        return $details;

        return $rents;        //Muestra las reservas de un usuario concreto

    }
    /*   
        foreach($rents as $rent){
            // TODO: hago una query a rooms por cada rent que me devuelve la query de arriba

            // Usaré el $rent->room_id para traer la info de cada room de cada rent

            // Metiendo en arrRentsWithRoomInfo tanto la rent como la room que te devuelve la query nueva
            // metemos cosas en un array con $arrRentsWithRoomInfo.push(["rent" => $rent, "room" => $room ])
        }
            
*/



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required',
            'endDate' => 'required',
            'room_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'created' => false,
                'errors' => $validator->errors()->all()
            ];
        }
        Rent::create($request->all());
        return response()->json(201);
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
