<?php

namespace Ignite\Http\Controllers;

use Illuminate\Http\Request;
use Ignite\Especialty;
use Ignite\User;
use Ignite\Http\Request\EspecialityRequest;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialty = Especialty::all();
        return view('assistant.specialities.index', compact('especialty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assistant.specialities.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialityRequest $request)
    {
        $specialty = new Especialty;
        $specialty->name = $request->name;
        $specialty->description = $request->description;

        $specialty->save();

        return redirect()->route('specialties.index')->with('registroE', "La especialidad se ingreso correctamente!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialty = Especialty::find($id);
        return view('assistant.specialities.show', compact('especialty'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especia = Especialty::find($id);
        return view('assistant.specialities.edit', compact('especia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialityRequest $request, $id)
    {
        $specialty = Especialty::find($id);
        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();
        return redirect()->route('specialties.index')->with('modificarE', "La especialidad se modifico correctamente!!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty = Especialty::find($id);
        if (count($specialty->mechanics) > 0) {
            return 0;
        } elseif (count($specialty->mechanics) == 0) {
            $specialty->delete();

            return 1;
        }
    }

    public function destroyM(Request $request){
        $i = 0;
        $idE = $request->input('idE');

        foreach($request->input('id') as $userM){
            $user = User::find($userM);
            if($user->specialties()->detach([$idE])){
                $i++;
            }
        }
        return $response = ((count($request->input('id')) == $i)? 1 : 0 );
    }

    public function storeM(Request $request){
            $i = 0;
            $idE = $request->input('idE');
        try{
            foreach($request->input('id') as $mechanic){
                $user = User::join('detail_mechanic_specialty','detail_mechanic_specialty.user_id','=','users.id')
                ->select('users.id')->where([
                    ['detail_mechanic_specialty.user_id','=',$mechanic],
                    ['detail_mechanic_specialty.especialty_id','=',$idE],
                ])->get();
                if(count($user) == 0){
                    $userFind = User::find($mechanic);
                    $userFind->specialties()->attach($idE);

                    $relation = User::join('detail_mechanic_specialty','detail_mechanic_specialty.user_id','=','users.id')
                    ->select('users.id')->where([
                        ['detail_mechanic_specialty.user_id','=',$mechanic],
                        ['detail_mechanic_specialty.especialty_id','=',$idE],
                    ])->get();
                    if(count($relation) == 1){
                        $i++;
                    }
                }
            }
        return $response = ((count($request->input('id')) == $i) ? 1 : 0);
        }catch(\Exception $e){
            return $e;
        }
    }

    public function createMC(){
        $especialty = Especialty::all();

        $mechanics = User::where('user_type_id','=','MCO')->get();
        if(count($especialty) > 0){
            if(count($mechanics) > 0){
                return view('assistant.specialities.mechanicstore', ['especialty'=>$especialty,'mechanics'=>$mechanics]);
            }
        }else{
            return view('assistant.specialities.index', compact('especialty'));
        }
    }

    public function recuperarM(Request $request){
        try{
            $idE = $request->input('idE');
            $mechanics = User::leftJoin('detail_mechanic_specialty', 'detail_mechanic_specialty.user_id', '=', 'users.id')->where([
                ['detail_mechanic_specialty.id', '<>', $idE],
                ['users.user_type_id', '=', 'MCO'],
            ])->orWhere(function ($query) {
                $query->where('users.user_type_id', '=', 'MCO')
                    ->whereNull('detail_mechanic_specialty.user_id');
            })->select('users.*')->distinct()->get();   
             
            if(count($mechanics) > 0){
                return $mechanics;
            }else if(count($mechanics) == 0){
                return 0;
            }
        }catch(\Exception $e){
            return 0;
        }
        
    }
    
    }