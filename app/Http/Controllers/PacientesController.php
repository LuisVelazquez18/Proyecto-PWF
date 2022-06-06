<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    // para que solo puedan acceder usuarios autentificados 
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        if (auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');
        }
         
        return view('modulos.Pacientes');
    }

    
    public function create()
    {
        if (auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');
        }
         
        return view('modulos.Crear-Paciente');
        
    }

    public function store(Request $request)
    {
        $datos = request()->validate([
            'name'=>['required'],
            'documento'=>['required'],
            'password'=>['required','string','min:3'],
            'email'=>['required','string','email','unique:users']

        ]);

        Pacientes::create([

            'name'=>$datos['name'],
            'id_consultorio'=>0,
            'email'=>$datos['email'],
            'sexo'=>'',
            'documento'=>$datos['documento'],
            'telefono'=>'',
            'rol'=>'Paciente',
            'password'=>Hash::make($datos['password'])

        ]);

        return redirect('Pacientes')->with('agregado', 'Si');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function show(Pacientes $pacientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Pacientes $pacientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientes $pacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacientes $pacientes)
    {
        //
    }
}
