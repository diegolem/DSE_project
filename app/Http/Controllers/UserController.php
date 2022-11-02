<?php

namespace Ignite\Http\Controllers;

use Ignite\User;
use Ignite\UserType;
use Illuminate\Http\Request;
use Validator;
use Ignite\Rules\PhoneNumber;
use Ignite\Rules\Dui;
use Ignite\Rules\BirthdateValidation;
use Ignite\Rules\PasswordConfirm;
use Ignite\Mail\PasswordCreate;
use Illuminate\Support\Facades\Mail;
use Ignite\Rules\UserTypeRule;
use Ignite\Rules\DuiExistRule;
use Ignite\Rules\DuiExistEditRule;
use Ignite\Rules\DuiExist;
use Ignite\Rules\MailExist;
use Ignite\Rules\MailExistEdit;
use Ignite\Rules\MailFormat;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datos = array("tipo" => -1, "nombre" => "");

        $users_list = User::where('id', '<>', auth()->user()->id);
        
        if (isset($request->tipo) && $request->tipo != -1){
            $users_list->where('user_type_id', '=', $request->tipo);
            $datos["tipo"] = $request->tipo;
        }

        if (isset($request->nombre)){
            $users_list->whereRaw("concat(users.name, ' ',users.lastname) LIKE '%$request->nombre%'", []);
            $datos["nombre"] = "".$request->nombre;
        }

        $users = $users_list->get();

        $user_type = UserType::all();
        
        if($request->ajax())
            return view('users.index', compact('users'))->with('datos', $datos)->with(compact('user_type'))->renderSections()['contenido'];
        else
            return view('users.index', compact('users'))->with('datos', $datos)->with(compact('user_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user_type = UserType::all();

        return view('users.create')->with(compact('user_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Generar cadena aleatoria
        $length = rand(5,10);
        $password = "";
        $abecedario = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];

        for ($i=0; $i < $length; $i++) { 
            $password .= $abecedario[rand(0, count($abecedario) - 1)];
        }

        $niceNames = array(
            'name' => 'nombre',
            'lastname' => 'apellido',
            'phone' => 'teléfono',
            'birthdate' => 'cumpleaño',
            'dui' => 'dui',
            'email' => 'correo electrónico',
            'address' => 'dirección',
        );
        
        $validation = Validator::make($request->all(),[
            'name' => 'required|max:30',
            'lastname' => 'required|max:30',
            'phone' => ['required', 'string', new PhoneNumber()],
            'birthdate' => ['required', new BirthdateValidation()],
            'dui' => ['required', 'string', new Dui(), new DuiExist],
            'email' => ['required','max:128', new MailExist],
            'address' => 'required|max:150',
        ]);

        $validation->setAttributeNames($niceNames); 

        if ($validation->passes()) {
            try{

                if(User::where('email', '=', $request->input('email'))->get()->count() > 0){
                    return ['success' => false, 'msg' => "El correo ingresado ya se encuentra registrado!"];
                }else if(User::where('dui', '=', $request->input('dui'))->get()->count() > 0){
                    return ['success' => false, 'msg' => "El DUI ingresado ya se encuentra registrado!"];
                }

                $usuario = new User;

                $usuario->name = $request->input('name');
                $usuario->lastname = $request->input('lastname');
                $usuario->phone = $request->input('phone');
                $usuario->birthdate = $request->input('birthdate');
                $usuario->dui = $request->input('dui');
                $usuario->email = $request->input('email');
                $usuario->password = bcrypt($password);
                $usuario->address = $request->input('address');
                $usuario->user_type_id = is_null($request->input('user_type_id')) ? 'CLE' : $request->input('user_type_id') ;
    
                $date1=date_create($request->input('birthdate'));
                $date2 = date_create(date('Y').'-'.date('m').'-'.date('d'));
                $diff=date_diff($date1,$date2);

                $usuario->age = $diff->format('%y');

                $usuario->save();

                $informacion = array('password' => $password);

                Mail::to($request->input('email'))->send(new PasswordCreate($password));                              

                return ['success' => true, 'msg' => "Usuario $request->email creado con éxito"];
            } catch(Exception $e){
                return ['success' => true, 'msg' => $e->getMessage()];
            }
        }

        $errors = $validation->errors();
        return ['success' => false, 'errors' => $errors];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show')->with(compact('user'));
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
        $user = User::find($id);
        $user_type = UserType::all();

        return view('users.edit')->with(compact('user_type'))->with(compact('user'));
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
        $niceNames = array(
            'name' => 'nombre',
            'lastname' => 'apellido',
            'phone' => 'telefono',
            'birthdate' => 'cumpleaños',
            'dui' => 'dui',
            'user_type_id' => 'tipo de usuario',
            'email' => 'correo electronico',
            'password' => 'contraseña',
            'address' => 'direccion',
            'password_original' => 'Contraseña original'
        );
        
        $validation = Validator::make($request->all(),[
            'name' => 'required|max:30',
            'lastname' => 'required|max:30',
            'phone' => ['required', 'string', new PhoneNumber()],
            'birthdate' => ['required', new BirthdateValidation()],
            'dui' => ['required', 'string', new Dui, new DuiExistEditRule($id)],
            'email' => ['required','max:128', new MailFormat, new MailExistEdit($id)],
            'password' => 'max:200',
            'address' => 'required|max:150',
            'password_original' => ['sometimes', 'required', new PasswordConfirm()],
            'user_type_id' => ['sometimes', 'required', new UserTypeRule()],
        ]);

        $validation->setAttributeNames($niceNames); 

        if ($validation->passes()) {
            try{
                $usuario = User::find($id);

                $usuario->name = $request->input('name');
                $usuario->lastname = $request->input('lastname');
                $usuario->phone = $request->input('phone');
                $usuario->birthdate = $request->input('birthdate');
                $usuario->dui = $request->input('dui');

                if ($request->input('user_type_id') !== null && $request->input('user_type_id') != "")
                    $usuario->user_type_id = $request->input('user_type_id');
                
                $usuario->email = $request->input('email');

                if  (($request->input('password_original') !== null && $request->input('password_original') != "") && ($request->input('password') !== null && $request->input('password') != ""))
                        $usuario->password = bcrypt($request->input('password'));
                
                $usuario->address = $request->input('address');
    
                $date1=date_create($request->input('birthdate'));
                $date2 = date_create(date('Y').'-'.date('m').'-'.date('d'));
                $diff=date_diff($date1,$date2);

                $usuario->age = $diff->format('%y');

                $usuario->save();
    
                return ['success' => true, 'msg' => "Usuario $request->name ha sido actualizado con éxito"];
            } catch(Exception $e){
                return ['success' => true, 'msg' => $e->getMessage()];
            }
        }

        $errors = $validation->errors();
        return ['success' => false, 'errors' => $errors];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
