<?php

namespace Ignite\Http\Controllers;

use Ignite\Car;
use Ignite\CarModel;
use Ignite\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \Ignite\User;
use \Ignite\Image;
use Ignite\Rules\License;
use Ignite\Rules\YearCar;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //Vista de Carros
        if(auth()->check() && auth()->user()->isAssistant() ){//Asistente
            // $cars = Car::join('models', 'cars.model_id', '=', 'models.id')
            //     ->join('transmissions', 'cars.transmission_id', '=', 'transmissions.id')
            //     ->join('brands', 'models.brand_id', '=', 'brands.id')
            //     ->select('cars.*', 'models.name AS Mname', 'transmissions.name AS Tname', 'brands.name AS Bname')
            //     ->get();

            $cars = Car::all();
            return view('assistant.cars.index', ['cars' => $cars]);
        }
        if(auth()->check() && auth()->user()->isClient() ){ //Cliente
            // $user = User::find(auth()->user()->id);
            $cars = Car::where('user_id', '=', auth()->user()->id)->get();

            return view('client.cars.index', ['cars' => $cars, 'r_cars' => auth()->user()->cars]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //Formulario de registro de coche
        $models = CarModel::pluck('name', 'id');
        $transmissions = Transmission::pluck('name', 'id');
        $users = User::where('user_type_id', '=', 'CLE')->get();
        return view('assistant.cars.create', ['models' => $models, 'transmissions' => $transmissions, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//Guardar en BDD

        $message = [ //Español
            'motor.required' => 'El campo motor es requerido',
            'motor.max' => 'El campo motor sobrepasa la longitud permitida',
            'displacement.required' => 'El campo cilindraje es requerido',
            'displacement.max' => 'El campo cilindraje sobrepasa la longitud permitida',
            'displacement.regex' => 'El campo cilindraje no posee formato válido',
            'mileage.required' => 'El campo millaje es requerido',
            'mileage.max' => 'El campo millaje sobrepasa la longitud permitida',
            'mileage.regex' => 'El campo millaje no posee formato válido',
            'observations.required' => 'El campo observaciones es requerido',
            'observations.max' => 'El campo observaciones sobrepasa la longitud permitida',
            'year.required' => 'El campo año es requerido',
            'year.max' => 'El campo año sobrepasa la longitud permitida',
            'year.regex' => 'El campo año no posee formato válido',
            'model_id.required' => 'El campo modelo es requerido',
            'model_id.max' => 'El campo modelo sobrepasa la longitud permitida',
            'transmission_id.required' => 'El campo transmisión es requerido',
            'transmission_id.max' => 'El campo modelo transmisión la longitud permitida',
            //'clients.required' => 'El campo clientes es requerido',
            'license.required' => 'El campo matrícula es requerdio',
            'owner.required' => 'Es necesario un dueño'
        ];
        $v = Validator::make($request->all(), [
            'motor' => 'required|max:20',
            'displacement' => [
                'required', 
                'max:10', 
                'regex: /^[1-9]\d*$/'
            ],
            'mileage' => [
                'required', 
                'max:11',
                'regex: /^[1-9]\d*$/'
            ],
            'observations' => 'required|max:255',
            'year' => [
                'required', 
                'max:4',
                'regex: /^[1-9]\d*$/',
                new YearCar()
            ],
            'model_id' => 'required|max:11',
            'transmission_id' => 'required:max:11',
            //'clients' => 'required',
            'owner' => 'required',
            'license' => ['required', 'string', new License()]
        ], $message)->validate();

        if($request->hasFile('images')){ //Validación de imagenes (si existe)
            Validator::make($request->all(), [
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048'
            ])->validate();
        }

        $car = new Car(); //Se crea y asigna valores a un carro
        $car->motor = $request->input('motor');
        $car->displacement = $request->input('displacement');
        $car->mileage = $request->input('mileage');
        $car->observations = $request->input('observations');
        $car->year = $request->input('year');
        $car->model_id = $request->input('model_id');
        $car->transmission_id = $request->input('transmission_id');
        $car->license = $request->input('license');
        $car->user_id = $request->input('owner');

        try{
            if( Car::where('license', '=', $car->license)->get()->isEmpty() ) {
                if($car->save()){
                    $id = $car->id;

                    if($request->input('clients') != null){
                        foreach(explode(',', $request->input('clients')) as $client) {
                            $client = User::find($client);
                            if($client->id != $car->user_id){
                                Car::find($id)->clients()->attach($client->id); //Registro en la tabla detalle
                            }
                        }
                    }
        
                    if($request->hasFile('images')){
                        foreach($request->file('images') as $item){ //Registra en la tabla car_images
                            $image = new Image();
                            $image->name = $item->store('public/cars');
                            Car::find($id)->images()->save($image);
                        }
                    }
                    return redirect('/asi/cars')->with('message', 'Registro exitoso!');
                }
                return redirect()->route('cars.create')->with('message', 'Algo ha ido mal!');
            }else{
                return redirect()->route('cars.create')->with('message', 'Matrícula ingresada ya existe!');
            }
        }catch(\Exception $e){
            return redirect()->route('cars.create')->with('message', 'ERROR: Alguno de los datos pueden ser no válidos.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { //Ver individualmente un carro
        if(auth()->user()->isClient()){ //Cliente
            
            if(Car::where('id', '=', $id)->count() > 0){
                $car = Car::findOrFail($id);
                return view('client.cars.show', ['car' => $car]);
            }else{
                return redirect()->route('cars.index')->with('message', 'El vehículo no existe.');
            }

        }else{//Asistente
            $car = Car::findOrFail($id);
            return view('assistant.cars.show', ['car' => $car]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {//Formulario de modificación de carro
        $car = Car::findOrFail($id);

        $models = CarModel::pluck('name', 'id');
        $transmissions = Transmission::pluck('name', 'id');
        //$users = User::all(['dui', 'id', 'user_type_id'])->where('user_type_id', '=', 'CLE'); //con ajax
        $users = User::where('user_type_id', '=', 'CLE')->get();
        $clients = Car::find($id)->clients->pluck('id');
        return view('assistant.cars.edit', ['car' => $car, 'models' => $models, 'transmissions' => $transmissions, 'users' => $users, 'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {//Modifica un carro
        $car = Car::findOrFail($id);
        $message = [ //Español
            'motor.required' => 'El campo motor es requerido',
            'motor.max' => 'El campo motor sobrepasa la longitud permitida',
            'displacement.required' => 'El campo cilindraje es requerido',
            'displacement.max' => 'El campo cilindraje sobrepasa la longitud permitida',
            'displacement.regex' => 'El campo cilindraje no posee formato válido',
            'mileage.required' => 'El campo millaje es requerido',
            'mileage.max' => 'El campo millaje sobrepasa la longitud permitida',
            'mileage.regex' => 'El campo millaje no posee formato válido',
            'observations.required' => 'El campo observaciones es requerido',
            'observations.max' => 'El campo observaciones sobrepasa la longitud permitida',
            'year.required' => 'El campo año es requerido',
            'year.max' => 'El campo año sobrepasa la longitud permitida',
            'year.regex' => 'El campo año no posee formato válido',
            'model_id.required' => 'El campo modelo es requerido',
            'model_id.max' => 'El campo modelo sobrepasa la longitud permitida',
            'transmission_id.required' => 'El campo transmisión es requerido',
            'transmission_id.max' => 'El campo modelo transmisión la longitud permitida',
            //'clients.required' => 'El campo clientes es requerido',
            'license.required' => 'El campo matrícula es requerdio',
            'owner.required' => 'Es necesario un dueño'
        ];

        $v = Validator::make($request->all(), [
            'motor' => 'required|max:20',
            'displacement' => [
                'required', 
                'max:10', 
                'regex: /^[1-9]\d*$/'
            ],
            'mileage' => [
                'required', 
                'max:11',
                'regex: /^[1-9]\d*$/'
            ],
            'observations' => 'required|max:255',
            'year' => [
                'required', 
                'max:4',
                'regex: /^[1-9]\d*$/',
                new YearCar()
            ],
            'model_id' => 'required|max:11',
            'transmission_id' => 'required:max:11',
            //'clients' => 'required',
            'owner' => 'required',
            'license' => ['required', 'string', new License()]
        ], $message)->validate();

        $car->motor = $request->input('motor');
        $car->displacement = $request->input('displacement');
        $car->mileage = $request->input('mileage');
        $car->observations = $request->input('observations');
        $car->year = $request->input('year');
        $car->model_id = $request->input('model_id');
        $car->transmission_id = $request->input('transmission_id');
        $car->license = $request->input('license');
        $car->user_id = $request->input('owner');

        try{
            if( Car::where('license', '=', $car->license )->where('id', '<>', $id)->get()->isEmpty() ) {
                if($car->save()){
                    $id = $car->id;
                    Car::find($id)->clients()->detach(); //Eliminar todas las relaciones
                    if($request->input('clients') != null){
                        foreach(explode(',', $request->input('clients')) as $client) {
                            $client = User::find($client);
                            if($client->id != $car->user_id){
                                Car::find($id)->clients()->attach($client->id); //Registro en la tabla detalle
                            }
                        }
                    }
                    return redirect('/asi/cars')->with('message', 'modificación exitosa!');
                }
                return redirect()->route('cars.edit', ['id' => $id])->with('message', 'Algo ha ido mal en la modificación!');
            }else{
                return redirect()->route('cars.edit', ['id' => $id])->with('message', 'Matrícula ingresada ya existe!');
            }
        }catch(\Exception $e){
            return redirect()->route('cars.edit', ['id' => $id])->with('message', $e->getMessage());
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
        if(Car::find($id)->delete()){
            return 1;
        }else{
            return 0;
        }
    }

    public function enabledClient(Request $request){ //ID CAR
        try{
            $car = Car::find( intval($request->input('car')) );
            
            if($car){
                if($car->owner->id == auth()->user()->id){ //Verifica que posea el id del logeado
                    $car->clients()->updateExistingPivot(
                    $request->input('client'),
                    [
                        'enabled' => $request->input('status')
                    ]);
                    return 1;
                }
            }
            return 0;
        }catch(\Exception $e){
            return 0;
        }
    }
}
