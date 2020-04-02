<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AutoController extends Controller
{
    private function checkClient($clientId)
    {
        $clientAutos = DB::table('autos')->where('client_id', '=', $clientId)
                                               ->count();
        if($clientAutos < 1)
            DB::table('clients')->where('id', '=', $clientId)
                                      ->delete();
    }

    private function getOwnerId($phone)
    {
        return  DB::table('clients')->where('phone','=',$phone)
                                          ->pluck('id')
                                          ->first();
    }

    private function createAuto(Request $request)
    {
        $id = $this->getOwnerId($request->phone);
        DB::table('autos')->insert([
            'brand'         =>    $request->brand,
            'model'         =>    $request->model,
            'color'         =>    $request->color,
            'plate_number'  =>    $request->plate_number,
            'parking_status'=>    $request->parking_status,
            'client_id'     =>    $id
        ]);
    }

    private function updateAutoWithClient(Request $request)
    {
        $address = isset($request->client['address']) ? $request->client['address'] : null;
        DB::table('clients')->where('id', $request->auto['client_id'])
                                  ->update([
            'surname'       =>    $request->client['surname'],
            'name'          =>    $request->client['name'],
            'patronymic'    =>    $request->client['patronymic'],
            'gender'        =>    $request->client['gender'],
            'phone'         =>    $request->client['phone'],
            'address'       =>    $address
        ]);
        DB::table('autos')->where('id', $request->auto['id'])
                                ->update([
            'brand'         =>    $request->auto['brand'],
            'model'         =>    $request->auto['model'],
            'color'         =>    $request->auto['color'],
            'plate_number'  =>    $request->auto['plate_number'],
            'parking_status'=>    $request->auto['parking_status'],
            'client_id'     =>    $request->auto['client_id']
        ]);
    }

    private function validatePutRequest(Request $request)
    {
        Validator::make($request->client, [
            'id'            =>    'required|max:10|exists:clients,id',
            'surname'       =>    'required | between: 3, 255',
            'name'          =>    'required | between: 3, 255',
            'patronymic'    =>    'required | between: 3, 255',
            'gender'        =>    'required | in:male,female',
            'address'       =>    'max:255',
            'phone'         =>    [
                                    'required',
                                    'digits:11',
                                    Rule::unique('clients')->ignore($request->client['id'])
            ],
        ])->validate();
        Validator::make($request->auto, [
            'client_id'     =>    'required|max:10|exists:clients,id',
            'id'            =>    'required|max:10|exists:autos,id',
            'brand'         =>    'required | max:255',
            'model'         =>    'required | max:255',
            'color'         =>    'required | max:255',
            'parking_status'=>    'required | in:0,1',
            'plate_number'  =>    [
                                    'required',
                                    'max:7',
                                    'regex:/^[A-Z]{3}-[0-9]{3}/',
                                    Rule::unique('autos')->ignore($request->auto['id'])
            ]
        ])->validate();
    }

    private function validatePostRequest(Request $request)
    {
        $this->validate($request, [
            'phone'         => 'required | digits:11 | exists:clients,phone',
            'brand'         => 'required | max:255',
            'model'         => 'required | max:255',
            'color'         => 'required | max:255',
            'plate_number'  => 'required | max:7 | regex:/^[A-Z]{3}-[0-9]{3}/ | unique:autos,plate_number',
            'parking_status'=> 'required | in:0,1',
        ]);
    }

    private function validateAutoId($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id'            => 'required|max:10|exists:autos,id',
        ]);

        if($validator->fails())
            return false;
        else return true;
    }

    public function validatePlateNumber(Request $request)
    {
        if(!$request->has('value'))
            return response()->json([
                'status'    => 'error'
            ])               ->header('Status', 400);

        $validator = Validator::make([
            'plate_number'  => $request->value
        ],                           [
            'plate_number'  => 'required | max:7 | regex:/^[A-Z]{3}-[0-9]{3}/ | unique:autos,plate_number',
        ]);

        if($validator->fails())
            return response()->json([
                'status'    => 'failed'
            ])               ->header('Status', 422);
        else return response()->json([
            'status'        => 'ok'
        ]);
    }

    public function deleteAuto($id)
    {
        if(!$this->validateAutoId($id))
            return response('Bad', 400);

        $clientId = DB::table('autos')->where('id', '=', $id)
                                            ->pluck('client_id')
                                            ->first();
        DB::table('autos')->where('id', '=', $id)
                                ->delete();
        $this->checkClient($clientId);
        return response('Success', 200);
    }

    public function postAuto(Request $request)
    {
        $this->validatePostRequest($request);
        $this->createAuto($request);

        return redirect()->route('home');
    }

    public function getAutoWithClientData($id)
    {
        if(!$this->validateAutoId($id))
            return redirect()->route('home');

        $clientId = DB::table('autos')->where('id', '=', $id)
                                            ->pluck('client_id')
                                            ->first();
        $autoClient['client'] = DB::table('clients')->where('id', '=', $clientId)
                                                          ->get();
        $autoClient['auto'] = DB::table('autos')->where('id', '=', $id)
                                                      ->get();
        return response()->json($autoClient);
    }

    public function putAutoWithClient(Request $request, $id)
    {
        $this->validatePutRequest($request);
        $this->updateAutoWithClient($request);

        return response()->json([
            'status'        => 'ok'
        ]);
    }
}
