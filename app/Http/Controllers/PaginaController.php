<?php

namespace App\Http\Controllers;

use App\Violencemeter;
use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function violentometro()
    {
        $violencemeters = Violencemeter::all();
        return view('pagina.violentometro', compact('violencemeters'));
    }
}
