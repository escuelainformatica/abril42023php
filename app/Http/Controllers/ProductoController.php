<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use View;

class ProductoController extends Controller
{
    //
    public function listar() {
        $productos=Producto::all();
        // dump($productos);
        return view("listar",['productos'=>$productos]);
    }
}
