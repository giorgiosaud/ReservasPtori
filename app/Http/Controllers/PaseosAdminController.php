<?php

namespace App\Http\Controllers;

use App\Embarcacion;
use App\Http\Requests\PaseosAdminRequest;
use App\Paseo;
use App\TipoDePaseo;
use Illuminate\Http\Request;

class PaseosAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $paseos = Paseo::all();
        $paseosTableStyle = [];
        foreach ($paseos as $paseo)
        {
            $array = [
                'Id'        => $paseo->id,
                'Hora de Salida'    => $paseo->horaDeSalida,
                'Nombre'    => $paseo->nombre,
                'Descripcion'    => $paseo->descripcion,
                'Tipo'    => $paseo->tipoDePaseo->nombre,
                'Orden'=>$paseo->orden,
                'Público'   => $paseo->publico,
                'Lunes'     => $paseo->lunes,
                'Martes'    => $paseo->martes,
                'Miercoles' => $paseo->miercoles,
                'Jueves'    => $paseo->jueves,
                'Viernes'   => $paseo->viernes,
                'Sábado'    => $paseo->sabado,
                'Domingo'   => $paseo->domingo,
            ];
            array_push($paseosTableStyle, $array);
        }

        return view('Paseos.admin.all', compact('paseosTableStyle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // dd('create Paseo');
        $tiposDePaseos=TipoDePaseo::pluck('nombre','id')->all();
        // dd($tiposDePaseos);
        $embarcaciones=Embarcacion::pluck('nombre','id')->all();
        // dd($embarcaciones);
        $embarcacionesSeleccionadas=null;
        return view('Paseos.admin.create',compact('tiposDePaseos','embarcaciones','embarcacionesSeleccionadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PaseosAdminRequest $request)
    {
        
        $paseo=Paseo::create($request->all());
        $paseo->embarcaciones()->sync($request->input('lista_de_embarcaciones'));
        return redirect()->route('paseos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $tiposDePaseos=TipoDePaseo::pluck('nombre','id');
        $embarcaciones=Embarcacion::pluck('nombre','id');

        $paseo = Paseo::findOrFail($id);
        $embarcacionesSeleccionadas=$paseo->embarcaciones->pluck('id')->all();
        return view('Paseos.admin.edit', compact('paseo','tiposDePaseos','embarcaciones','embarcacionesSeleccionadas'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id,PaseosAdminRequest $request)
    {
        $paseo = Paseo::findOrFail($id);
        $paseo->update($request->all());
        // dd($request->input('lista_de_embarcaciones'));
        $paseo->embarcaciones()->sync($request->input('lista_de_embarcaciones'));
        //	dd($paseo);
        return redirect()->route('paseos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $paseo = Paseo::findOrFail($id);
        $paseo->delete();
        return redirect()->route('paseos.index');
    }


}
