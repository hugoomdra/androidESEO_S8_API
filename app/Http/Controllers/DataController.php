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

        print_r('<pre>');
        print_r($device_id);
        print_r($device);
        print_r('</pre>');
        die();
        $data = new Data;

        $data->device_id = $device_id;
        $data->luminosity = $request->luminosity;
        $data->battery_level = $request->battery_level;
        $data->pressure = $request->pressure;
        $data->temperature = $request->temperature;
        $data->position = $request->position;

        $data->save();


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
