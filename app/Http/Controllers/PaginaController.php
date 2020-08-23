<?php

namespace App\Http\Controllers;

use App\Violencemeter;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function violentometro()
    {
        $violencemeters = Violencemeter::all();
        // return Violencemeter::all();
        return view('pagina.index', compact('violencemeters'));
    }
}
