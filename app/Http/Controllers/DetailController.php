<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Repair;
use Ignite\Detail;
use Ignite\Category;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($repair_id)
    {
        $repair = Repair::find($repair_id);

        if(!is_null($repair)){
            $categories = Category::pluck('description', 'id');
            $detail = new Detail();
    
            return view('assistant.details.create', ['detail' => $detail, 'repair' => $repair, 'categories' => $categories]);
        }else{
            return redirect()->route(auth()->user()->user_type_id == 'MCO' ? 'mechanic.index' : 'repairs.index')->with(['msg' => 'La reparación a la que deseas acceder no existe...', 'msg_type' => 'yellow']);            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Detail::create([
                'detail' => $request->detail,
                'description' => $request->description,
                'amount' => $request->amount,
                'date' => $request->date,
                'repair_id' => $request->repair_id,
                'category_id' => $request->categorie_id
            ]);

            return redirect()->route(auth()->user()->user_type_id == 'ASI' ? 'repairs.index' : 'mechanic.index')->with(['msg' => 'El detalle ha sido registrado éxitosamente!', 'msg_type' => 'green']);
        }catch (Exception $e){
            return redirect()->route(auth()->user()->user_type_id == 'ASI' ? 'repairs.index' : 'mechanic.index')->with(['msg' => 'Ha ocurrido un error al intentar registrar los datos, pruebe mas tarde.', 'msg_type' => 'red']);
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
