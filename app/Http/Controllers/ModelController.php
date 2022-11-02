<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\CarModel;
use Ignite\Brand;
use Ignite\Car;
use Ignite\Http\Request\ModelRequest;
class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = CarModel::all();
        return view('assistant.models.index',compact('models'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::pluck('name','id');
        return view('assistant.models.create',['brands'=> $brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModelRequest $request)
    {
        try{
        
            $validar = CarModel::where([
            ['name','=',$request->name],
            ['brand_id','=',$request->id]
                                ])->get();

        if(count($validar) == 0){

        $model = new CarModel;
        $model->name = $request->name;
        $model->brand_id = $request->id;
        $model->save();

        return redirect()->route('models.index')
                        ->with('registroM',"El modelo se ingreso correctamente.");
        }else{
            return redirect()->route('models.create')
            ->with('registroME',"Ocurrio un error al registrar.");
        }
        
        }catch(\Exception $e){
            return redirect()->route('models.create')
                        ->with('registroME',"Ocurrio un error al registrar.");
        }   
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = CarModel::find($id);
        $cars = Car::join('models','cars.model_id','=','models.id')->where('models.id','=',$id)
                ->join('transmissions', 'cars.transmission_id', '=', 'transmissions.id')
                ->join('brands', 'models.brand_id', '=', 'brands.id')
                ->select('cars.*', 'models.name AS Mname', 'transmissions.name AS Tname', 'brands.name AS Bname')
                ->get();
        return view('assistant.models.show',['model'=>$model,'cars'=>$cars]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = CarModel::findorFail($id);
        $brand = Brand::pluck('name','id');
        return view('assistant.models.edit',['brand'=>$brand, 'model'=>$model]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModelRequest $request, $id)
    {
        try{
        $model = CarModel::findorFail($id);
        if(count($model)>0){
            $model->name = $request->name;
            $model->brand_id = $request->id;
            $model->save();
            return redirect()->route('models.index')->with('modificarM',"Modelo modificado con éxito");
        }else{
            return redirect()->route('models.edit',$id)->with('modificarME',"Ocurrio un error al modificar");
        }
        }catch(\Exception $e){
            return redirect()->route('models.edit',$id)->with('modificarME',"Ocurrio un error al modificar");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(CarModel::find($id)->delete()){
                return 1;
            }else{
                return 0;
            }
        }catch(\Exception $e){
            return 0;
        }
    }
}
