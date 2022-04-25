<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarritoRequest;
use App\Http\Requests\UpdateCarritoRequest;
use App\Models\Carrito;
use App\Models\Factura;
use App\Models\Linea;
use App\Models\Zapato;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carritos = Carrito::all();

        return view('carritos.index', [
            'carritos' => $carritos->where('user_id', '=', auth()->user()->id),
        ]);
    }


    public function sumar(Zapato $zapato)
    {
        $carrito = Carrito::where('zapato_id', $zapato->id)->where('user_id', auth()->user()->id)->get();

        $carrito[0]->cantidad +=1;
        $carrito[0]->save();

        return redirect()->route('carrito')->with('success', 'Zapato sumado al carrito.');
    }

    public function restar(Zapato $zapato)
    {
        $carrito = Carrito::where('zapato_id', $zapato->id)->where('user_id', auth()->user()->id)->get();

        if ($carrito[0]->cantidad === 1) {
            $carrito[0]->delete();

            return redirect()->route('carrito')->with('success', 'Zapato eliminado del carrito.');
        }

        $carrito[0]->cantidad -=1;
        $carrito[0]->save();

        return redirect()->route('carrito')->with('success', 'Zapato restado del carrito.');
    }

    public function vaciar()
    {
        $carrito = Carrito::where('user_id', auth()->user()->id)->get();

        if ($carrito->isEmpty()) {
            return redirect()->route('carrito')->with('error', 'El carrito esta vacio.');
        }

        $carrito->each->delete();

        return redirect()->route('carrito')->with('success', 'Carrito vaciado.');

    }

    public function meter( Zapato $zapato)
    {
        $carrito = $carrito = Carrito::where('zapato_id', $zapato->id)->where('user_id', auth()->user()->id)->get();

        if ($carrito->isEmpty()) {
            $carrito = new Carrito();
            $carrito->user_id = Auth::user()->id;
            $carrito->zapato_id = $zapato->id;
            $carrito->cantidad = 1;
            $carrito->save();

            return redirect()->route('zapatos')->with('success', 'Zapato anadido al carrito.');

        }

        $carrito[0]->cantidad +=1;
        $carrito[0]->save();

        return redirect()->route('zapatos')->with('success', 'Zapato anadido al carrito.');
    }

    public function facturar(Factura $factura, Linea $linea ) {

        $factura_nueva = new Factura();
        $factura_nueva->user_id = Auth::user()->id;
        $factura_nueva->save();

        $carrito = Carrito::where('user_id', auth()->user()->id)->get();

        foreach ($carrito as $lineacarrito) {
            $linea_nueva = new Linea();
            $linea_nueva->factura_id = $factura_nueva->id;
            $linea_nueva->zapato_id = $lineacarrito->zapato_id;
            $linea_nueva->cantidad = $lineacarrito->cantidad;
            $linea_nueva->save();
        }

        $carrito->each->delete();

        return redirect()->route('carrito')->with('success', 'Pedido realizado.');

    }
}
