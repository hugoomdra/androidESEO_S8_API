<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('device_token')){

            $datas = DB::table('data')
                ->join('devices', 'data.device_id', '=', 'devices.id')
                ->where('token', $request->device_token)
                ->get();

            return $datas;



        }else{
            return Data::all();
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

        $device = DB::table('devices')
            ->where('token', $request->device_token)
            ->first();

        $device_id = $device->id;

        $data = Data::create([
            'device_id' => $device_id,
            'luminosity' => $request->luminosity,
            'battery_level' => $request->battery_level,
            'pressure' => $request->pressure,
            'temperature' => $request->temperature,
            'position' => $request->position,
            'date' => $request->date,
        ]);

        $data->save();

        return $data;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        $data->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Data $data)
    {
        $data->delete();
    }
}
