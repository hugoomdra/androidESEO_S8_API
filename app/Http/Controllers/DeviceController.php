<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('nom')){

            $devices = DB::table('devices')
                ->join('devices', 'data.device_id', '=', 'devices.id')
                ->where('token', $request->device_token)
                ->get();

            return $devices;



        }else{
            return Device::all();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $devices = DB::table('devices')
            ->where('token', $request->device_token)
            ->get();


        if ($devices->count() == 0){
            $device = Device::create([
                'nom' => $request->nom,
                'token' => $request->device_token,
            ]);

            $device->save();

            return $this->response([
                "status" => "Success",
                "message" => "Parfait"
            ]);
        }else {

            return $this->response([
                'error' => [
                    'message' => "Impossible, le token existe déjà",
                    'status_code' => 400
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return $device;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $device->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
    }
}
