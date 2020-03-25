<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colegio;
class ColegioController extends Controller
{
    
    public function index()
    {
        $colegios = Colegio::all();

        return view('colegios.index', compact('colegios'));
    }

   
    public function create()
    {
        return view('colegios.create');
    }

    
    public function store(Request $request)
    {
      $file =   $request->file('imagen');

        \Storage::disk('local')->put('demo5.jpg',  \File::get($file));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
