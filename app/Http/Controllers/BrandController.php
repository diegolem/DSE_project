<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Brand;
use Ignite\Country;
use Illuminate\Support\Facades\Validator;
use Ignite\Http\Request\BrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Vista

        $brands = Brand::join('countries', 'brands.country_id', '=', 'countries.id')
        ->select('brands.*', 'countries.name AS Cname')
        ->get();

        return view('assistant.brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {//Formulario de registro
        $countries = Country::pluck('name', 'id');

        return view('assistant.brands.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Ingresar en BDD

        $v = Validator::make($request->all(), [
            'nombre' => [
                'required',
                'max:50',
                'regex:/^([A-Z]|[a-z]|[ñÑ]|[áéíóúÁÉÍÓÚA])[+ñÑ0-9áéíóúÁÉÍÓÚAa-zA-Z -]*$/'
            ],
            'country_id' => 'required|max:10',
        ]);
        if ($v->fails()) {
            return redirect()->route('brands.create')->with('Emessage', 'Escribe un nombre válido');
        }

        $brand = new Brand();
        $brand->name = $request->input('nombre');
        $brand->country_id = $request->input('country_id');

        if ($brand->save()) {
            return redirect()->route('brands.index')->with('messageR', 'Registro exitoso');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Modificacion formulario

        $brand = Brand::findOrFail($id);
        $countries = Country::pluck('name', 'id');

        return view('assistant.brands.edit', ['brand' => $brand, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Modificar

        $v = Validator::make($request->all(), [
            'nombre' => [
                'required',
                'max:50',
                'regex:/^([A-Z]|[a-z]|[ñÑ]|[áéíóúÁÉÍÓÚA])[+ñÑ0-9áéíóúÁÉÍÓÚAa-zA-Z -]*$/'
            ],
            'country_id' => 'required|max:10',
        ]);
        if ($v->fails()) {
            return redirect()->route('brands.edit', ['id'=>$id])->with('Emessage', 'Escribe un nombre válido');
        }

        $brand = Brand::findOrFail($id);
        $brand->name = $request->input('nombre');
        $brand->country_id = $request->input('country_id');

        if ($brand->save()) {
            return redirect()->route('brands.index')->with('messageS', 'Modificación exitosa');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(Brand::find($id)->delete()){
                return 1;
            }else{
                return 0;
            }
        }catch(\Exception $e){
            return 0;
        }
    }
}
