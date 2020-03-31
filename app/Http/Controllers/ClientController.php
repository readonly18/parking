<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class ClientController extends Controller
{
    private function validateRequest(Request $request)
    {
        $this->validate($request, [
            'surname'           => 'required | between: 3, 255',
            'name'              => 'required | between: 3, 255',
            'patronymic'        => 'required | between: 3, 255',
            'gender'            => 'required | in:male,female',
            'phone'             => 'required | digits:11 | unique:clients,phone',
            'address'           => 'max:255',
            'brand'             => 'required | max:255',
            'model'             => 'required | max:255',
            'color'             => 'required | max:255',
            'plate_number'      => 'required | max:7 | regex:/^[A-Z]{3}-[0-9]{3}/ | unique:autos,plate_number',
            'parking_status'    => 'required | in:0,1',
        ]);
    }

    private function createClient(Request $request)
    {
        $address = $request->has('address') ? $request->address : null;
        $id = DB::table('clients')->insertGetId(
            [
                'surname'       => $request->surname,
                'name'          => $request->name,
                'patronymic'    => $request->patronymic,
                'gender'        => $request->gender,
                'phone'         => $request->phone,
                'address'       => $address
            ]
        );

        DB::table('autos')->insert([
            'brand'             => $request->brand,
            'model'             => $request->model,
            'color'             => $request->color,
            'plate_number'      => $request->plate_number,
            'parking_status'    => $request->parking_status,
            'client_id'         => $id
        ]);
    }

    public function getPaginationData()
    {
        $clientsAutos = DB::table('clients')
                            ->join('autos', 'clients.id', '=', 'autos.client_id')
                            ->paginate(15);
        return response()->json($clientsAutos);
        //return view('client.index', ['clientsAutos' => $clientsAutos]);
    }

    public function getPaginationPage()
    {
        return view('client.index');
    }

    public function getCreatePage()
    {
        return view('client.create');
    }

    public function postClientWithAuto(Request $request)
    {
        $this->validateRequest($request);
        $this->createClient($request);

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
