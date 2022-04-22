<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarritoRequest;
use App\Http\Requests\UpdateCarritoRequest;
use App\Models\Carrito;
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
        $carrito = $carrito = Carrito::where('zapato_id', $zapato->id)->where('user_id', auth()->user()->id)->get();

        $carrito[0]->cantidad +=1;
        $carrito[0]->save();

        return redirect()->route('carrito')->with('success', 'Zapato sumado al carrito.');
    }

    public function restar(Zapato $zapato)
    {
        $carrito = $carrito = Carrito::where('zapato_id', $zapato->id)->where('user_id', auth()->user()->id)->get();

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
        $carrito = $carrito = Carrito::where('user_id', auth()->user()->id)->get();

            $carrito->delete();

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
}
