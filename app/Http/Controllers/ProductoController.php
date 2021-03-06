<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\PracticaPedagogica;
use App\Producto;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validar = Producto::where('practica_pedagogicas_id',$request->idPracticaPedagogica)->count();

        $practica_pedagogicas = PracticaPedagogica::find($request->idPracticaPedagogica);
  
        return view('productos.index', compact('practica_pedagogicas', 'validar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $practicas_pedagogicas = PracticaPedagogica::find($request->idPracticaPedagogicas);

        return view('productos.create', compact('request','practicas_pedagogicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {


        $producto = Producto::create($request->all());
    
        toastr()->success('Producto Registrado con Exito');

        return redirect()
            ->route('productos.index',['idPracticaPedagogica' => $producto->practica_pedagogicas_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imprimirPdf(Producto $producto)
    { 
        $files = Storage::disk('public')->files();

        $array_uno = [];

        foreach ($files as $file) {
             $str = substr($file, 0, 1);
             if($str == $producto->id){
              array_push($array_uno, $file);
             }
        }

        $producto = Producto::find($producto->id);

        $practica = PracticaPedagogica::find($producto->practica_pedagogicas_id);

        $pdf = \PDF::loadView('productos.pdf', compact('producto', 'practica', 'array_uno'));

        return $pdf->download('producto.pdf'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {

        $producto = Producto::find($producto->id);

        $practicas_pedagogicas = PracticaPedagogica::find($producto->practica_pedagogicas_id);

        return view('productos.edit', compact('practica','producto','practicas_pedagogicas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request['practica_pedagogicas_id'] = $producto->practica_pedagogicas_id;

        $producto->update($request->all());
    
        toastr()->success('registro Actualizado  con Exito');

        return redirect()
            ->route('productos.index',['idPracticaPedagogica' => $producto->practica_pedagogicas_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect() 
            ->route('productos.index',['idPracticaPedagogica' => $producto->practica_pedagogicas_id]);
    }

    public function aprobarPractica(Producto $producto, Request $request) 

    {
        
        $data = 
        [
        'producto_finalizado'   => true
        ];

        $data2 = 
        [
        'finalizada' => true
        ];

        $data3 = 
        [
        'observaciones' => $request->observaciones
        ];


        $practica_pedagogica = PracticaPedagogica::where('id', $producto->practica_pedagogicas_id)
            ->update($data);

        $practica_pedagogica = PracticaPedagogica::find($producto->practica_pedagogicas_id);
            
        if($practica_pedagogica->producto_finalizado == true && $practica_pedagogica->diario_finalizado ==true)
        {
            $practica_pedagogica = PracticaPedagogica::where('id', $producto->practica_pedagogicas_id)
            ->update($data2);
        }

        $producto = Producto::where('id', $producto->id)->update($data3);

        return redirect()
            ->route('practicas.index');
    }
}
