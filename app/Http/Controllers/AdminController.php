<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard del administrador
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Mostrar la lista de eventos
     */
    public function eventos()
    {
        return view('admin.eventos');
    }

    /**
     * Mostrar la lista de equipos
     */
    public function equipos()
    {
        return view('admin.equipos');
    }

    /**
     * Mostrar los rankings
     */
    public function rankings()
    {
        return view('admin.rankings');
    }

    /**
     * Mostrar el panel de administración
     */
    public function administracion()
    {
        return view('admin.administracion');
    }

    /**
     * Mostrar el perfil del administrador
     */
    public function perfil()
    {
        return view('admin.mi-perfil');
    }
}
