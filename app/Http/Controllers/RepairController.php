<?php

namespace Ignite\Http\Controllers;

use Ignite\User;
use Illuminate\Http\Request;
use Ignite\Repair;
use Ignite\Car;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repairs = Repair::all();

        foreach($repairs as $repair){
            $aux = $repair->car->clients;
            $repair->car->clients = collect(new User);
            $repair->car->clients->push($repair->car->owner);
            
            foreach($aux as $client){
                $repair->car->clients->push($client);
            }
        }

        return view('assistant.repairs.index', ['repairs' => $repairs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repair = new Repair();
        $mechanics = User::where('user_type_id', '=', 'MCO')->get();
        $cars = Car::leftJoin('repairs', 'repairs.car_id', '=', 'cars.id')->where('repairs.status', '=', '1')->orWhereNull('repairs.id')->select('cars.*')->get();

        foreach($cars as $car){
            $aux = $car->clients;
            $car->clients = collect(new User);
            $car->clients->push($car->owner);
            
            foreach($aux as $client){
                $car->clients->push($client);
            }
        }

        return view('assistant.repairs.create',['repair' => $repair, 'cars' => $cars, 'mechanics' => $mechanics]);
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
//            dd(User::find(json_decode($request->mechanics_id)));
             Repair::create([
                'code' => Repair::genCode(),
                'admissionDate' => Carbon::now()->format('Y-m-d'),
                'car_id' => $request->car_id
            ])->mechanics()->attach(json_decode($request->mechanics_id));

            return redirect()->route('repairs.index')->with(['msg' => 'La reparación ha sido registrada éxitosamente!', 'msg_type' => 'green']);
        }catch (\Exception $e){
            return redirect()->route('repairs.index')->with(['msg' => 'Ha ocurrido un error al intentar ingresar los datos, intentelo más tarde.', 'msg_type' => 'red']);
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
        $repair = Repair::find($id);
        if(!is_null($repair)){
            $aux = $repair->car->clients;
            $repair->car->clients = collect(new User);
            $repair->car->clients->push($repair->car->owner);
            
            foreach($aux as $client){
                $repair->car->clients->push($client);
            }

            return view('assistant.repairs.show', ['repair' => ($repair)]);
        }else{
            return redirect()->route('repairs.index')->with(['msg' => 'Esa reparación no existe...', 'msg_type' => 'yellow']);
        }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function finish(Request $req)
    {
        $repair = Repair::find($req->id);
        if(is_null($repair)){
            echo "-1";
        }else{
            try{
                $f = false;
                if($req->role == 'd'){
                    $user = User::find($req->user_id);

                    if(!is_null($user)){
                        foreach($user->car as $_cars){
                            if($_cars->id == $repair->car->id){
                                $f = true;
                            }else{
                                echo "-1";
                            }
                        }
                    }else{
                        echo "0";
                    }
                }else if($req->role == 'r'){
                    foreach($repair->car->clients as $client){
                        if($client->pivot->user_id == $req->user_id && $client->pivot->emabled === 1){
                            $f = true;;
                        }else{
                            break;
                        }
                    }
                }else{
                    echo "0";
                }

                if($f){
                    $repair->status = 1;
                    $repair->departureDate = Carbon::now()->format('Y-m-d');
                    $repair->save();
                    echo "1";
                }else{
                    echo "-2";
                }
            }catch (\Exception $e){
                echo $e->getMessage();
                echo "0";
            }
        }
    }

    public function pdf($id){ //Crear pdf con el paquete (Factura)
        $repair = Repair::findOrFail($id);
        $pdf = PDF::loadView('assistant.repairs.pdf', ['repair' => $repair]);
        return $pdf->download("".$repair->code.".pdf");
    }
}
