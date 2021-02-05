<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ventas = auth()->user()->ventas;
        if ($request->isJson()) {
            return $ventas;
        } else {
            return response()->json([
                'error' => 'Not acceptable, require application/json'
            ], 406, []);
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
        $this->validate($request, [
            'fecha' => 'required',
            'nombre' => 'required',
            'identificacion' => 'required',
            'correo' => 'required',
            'cantidad' => 'required',
            'servicio' => 'required',
            'zona' => 'required'
        ]);

        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->nombre = $request->nombre;
        $venta->identificacion = $request->identificacion;
        $venta->correo = $request->correo;
        $venta->cantidad = $request->cantidad;
        $venta->servicio = $request->servicio;
        $venta->zona = $request->zona;
        $venta->pdf = $request->pdf;

        if (auth()->user()->ventas()->save($venta))
            return response()->json([
                'success' => true,
                'data' => $venta->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Venta not added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = auth()->user()->ventas()->find($id);

        if (!$venta) {
            return response()->json([
                'success' => false,
                'message' => 'Venta not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $venta->toArray()
        ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venta = auth()->user()->ventas()->find($id);

        if (!$venta) {
            return response()->json([
                'success' => false,
                'message' => 'Venta not found'
            ], 400);
        }

        $updated = $venta->fill($request->all()->save());
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Venta can not be updated'
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = auth()->user()->ventas()->find($id);

        if (!$venta) {
            return response()->json([
                'success' => false,
                'message' => 'Venta not found'
            ], 400);
        }

        if ($venta->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Venta can not be deleted'
            ], 500);
        }
    }
}
