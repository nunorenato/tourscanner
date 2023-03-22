<?php

namespace App\Http\Controllers;

use App\Atleta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AtletaController extends Controller
{
    //

    public function index(): View{
        return view('atletas', ['atletas' => Atleta::all()]);
    }
}
