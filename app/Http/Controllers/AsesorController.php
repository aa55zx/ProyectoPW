<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsesorController extends Controller
{
    /**
     * Mostrar el dashboard del asesor
     */
    public function dashboard()
    {
        return view('asesor.dashboard');
    }

    /**
     * Mostrar la lista de eventos
     */
    public function eventos()
    {
        return view('asesor.eventos');
    }

    /**
     * Mostrar el detalle de un evento
     */
    public function eventoDetalle($id)
    {
        return view('asesor.evento-detalle', compact('id'));
    }

    /**
     * Mostrar la lista de equipos
     */
    public function equipos()
    {
        return view('asesor.equipos');
    }

    /**
     * Mostrar la lista de proyectos
     */
    public function proyectos()
    {
        return view('asesor.proyectos');
    }

    /**
     * Mostrar los rankings
     */
    public function rankings()
    {
        return view('asesor.rankings');
    }

    /**
     * Mostrar el perfil del asesor
     */
    public function miPerfil()
    {
        return view('asesor.mi-perfil');
    }
}
