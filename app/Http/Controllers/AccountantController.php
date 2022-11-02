<?php

namespace Ignite\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Ignite\Charts\SampleChart;
use Illuminate\Http\Request;
use Ignite\Category;
use Ignite\Repair;
use Ignite\User;
use PDF;

class AccountantController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function repairs(){
        $repairs = Repair::all();

        return view('accountant.repairs', ['repairs' => $repairs]);
    }

    public function usuarios_registrados($year = null){
        $now = "".date('Y');

        if ($year == null) 
            $year = "YEAR(now())";
        else
            $now = $year;
        
        $clientes = User::selectRaw('count(*) as total, MONTH(created_at) as month')->where('user_type_id', '=', 'CLE')->whereRaw("YEAR(created_at) = $year")->groupBy('month')->get();

        $count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        foreach ($clientes as $cliente)
            $count[$cliente["month"] - 1] = $cliente["total"];

        $chr_usuarios_actual = new SampleChart;
        $chr_usuarios_actual->dataset('Registros de clientes por mes', 'line', $count)->options(['borderColor' => '#ff0000']);
        $chr_usuarios_actual->height(400);
        $chr_usuarios_actual->width(600);

        // SELECT DISTINCT YEAR(users.created_at) FROM users
        $fechas = User::selectRaw('YEAR(users.created_at) as fecha')->distinct()->get();

        return view('accountant.chartnewclient', ['chr_usuarios_actual' => $chr_usuarios_actual, 'now' => $now, 'fechas' => $fechas]);
    }

    public function ingresos($year = null){
        $now = "".date('Y');

        if ($year == null) 
            $year = "YEAR(now())";
        else
            $now = $year;
        
        // La cantidad de dinero obtenido por año //////////////////////
        // SELECT SUM(repair_details.amount) as amount, MONTH(repairs.departureDate) as month FROM repairs INNER JOIN repair_details on repair_details.repair_id = repairs.id WHERE status = 1 and YEAR(repairs.departureDate) = YEAR(now()) GROUP BY month
        $repairs = Repair::selectRaw("SUM(repair_details.amount) as amount, MONTH(repairs.departureDate) as month")->join('repair_details', 'repair_details.repair_id', '=', 'repairs.id')->where('status', '=', 1)->whereRaw("YEAR(repairs.departureDate) = $year")->groupBy('month')->get();

        $count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        foreach ($repairs as $repair)
            $count[$repair["month"] - 1] = $repair["amount"];

        $chr_dinero_mensual = new SampleChart;
        $chr_dinero_mensual->dataset('Ingresos por mes', 'line', $count)->options(['borderColor' => '#ffff00']);
        $chr_dinero_mensual->height(400);
        $chr_dinero_mensual->width(600); 
        
        $fechas = Repair::selectRaw('YEAR(repairs.departureDate) as fecha')->distinct()->get();

        // /////////////////////////////////////////////////////////////

        return view('accountant.chartingresos', ['chr_dinero_mensual' => $chr_dinero_mensual, 'now' => $now, 'fechas' => $fechas]);
    }

    public function automoviles($year = null){
        $now = "".date('Y');

        if ($year == null) 
            $year = "YEAR(now())";
        else
            $now = $year;

        // Lista de los clientes que han dejado su automovil /////////////
        // SELECT COUNT(*) as total, MONTH(repairs.departureDate) as month FROM users INNER JOIN detail_client_car ON detail_client_car.user_id = users.id INNER JOIN repairs ON repairs.car_id = detail_client_car.car_id WHERE users.user_type_id = 'CLE' AND YEAR(repairs.admissionDate) = YEAR(now()) GROUP BY month

        $clientes = User::selectRaw('COUNT(*) as total, MONTH(repairs.departureDate) as month')->join('detail_client_car', 'detail_client_car.user_id', '=', 'users.id')->join('repairs', 'repairs.car_id', '=', 'detail_client_car.car_id')->where('user_type_id', '=', 'CLE')->whereRaw("YEAR(repairs.admissionDate) = $year")->groupBy('month')->get();

        $count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        foreach ($clientes as $cliente)
            $count[$cliente["month"] - 1] = $cliente["total"];

        $chr_clientes = new SampleChart;
        $chr_clientes->dataset('Automovil ingresados', 'line', $count)->options(['borderColor' => '#ff0000']);
        $chr_clientes->height(400);
        $chr_clientes->width(600); 

        $fechas = Repair::selectRaw('YEAR(repairs.admissionDate) as fecha')->distinct()->get();
        // ///////////////////////////////////////////////////////////////

        return view('accountant.chartautomoviles', ['chr_clientes' => $chr_clientes, 'now' => $now, 'fechas' => $fechas]);
    }

    public function mecanicos(){
        // Los 10 mejores mecanicos  ///////////////////////////////////
        // SELECT COUNT(*) as Cantidad, detail_mechanic_repair.user_id as user_id FROM users INNER JOIN detail_mechanic_repair ON detail_mechanic_repair.user_id = users.id WHERE users.user_type_id = 'MCO' GROUP BY detail_mechanic_repair.user_id ORDER by Cantidad DESC LIMIT 10
        $mecanicos = User::selectRaw('COUNT(*) as cantidad, detail_mechanic_repair.user_id as user_id')->join('detail_mechanic_repair', 'detail_mechanic_repair.user_id', '=', 'users.id')->where('users.user_type_id', '=', 'MCO')->groupBy('detail_mechanic_repair.user_id')->orderBy('Cantidad', 'desc')->limit(10)->get();

        $count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $label = array('', '', '', '', '', '', '', '', '', '');
        $i = 0;

        foreach ($mecanicos as $mecanico) {
            $count[$i] = $mecanico["cantidad"];

            $user = User::where('id', '=', $mecanico["user_id"])->first();
            $label[$i] = ($user->name);

            $i++;
        }
        
        $chr_mecanicos = new SampleChart;
        $chr_mecanicos->labels($label);
        $chr_mecanicos->dataset('Mecanicos mas activos', 'bar', $count)->options(['borderColor' => '#ff0000']);
        $chr_mecanicos->height(400);
        $chr_mecanicos->width(600);
        // ///////////////////////////////////////////////////////////////

        return view('accountant.chartmecanicos', ['chr_mecanicos' => $chr_mecanicos]);
    }

    public function categorias(){
                // El total de reparaciones por categorias ///////////////////////
        // SELECT COUNT(*) as total, detail_category_repair.category_id as categoria FROM detail_category_repair INNER JOIN repairs on repairs.id = detail_category_repair.repair_id WHERE repairs.status = 1 GROUP by detail_category_repair.category_id
        
        // SELECT COUNT(*) as total, detail_category_repair.category_id as categoria FROM detail_category_repair INNER JOIN repairs on repairs.id = detail_category_repair.repair_id WHERE repairs.status = 1 GROUP by detail_category_repair.category_id
        $detalles =  Repair::selectRaw('COUNT(*) as total, repair_details.category_id as categoria')->join('repair_details', 'repairs.id', '=', 'repair_details.repair_id')->where('repairs.status', '=', 1)->groupBy('repair_details.category_id')->get();

        $count = array();
        $label = array();

        foreach ($detalles as $detalle) {
            array_push($count, $detalle->total);

            $categoria = Category::where('id', '=', $detalle->categoria)->first();
            array_push($label, $categoria->name);
        }
        
        $chr_categorias = new SampleChart;
        $chr_categorias->labels($label);
        $chr_categorias->dataset('Reparaciones segun categorias', 'pie', $count)->options(['borderColor' => '#ff0000']);
        $chr_categorias->height(400);
        $chr_categorias->width(600);
        
        // ///////////////////////////////////////////////////////////////

        return view('accountant.chartcategorias', ['chr_categorias' => $chr_categorias]);
    }

    public function clientes()
    {
        // Clientes con la informacion de los ////////////////////////////
        // SELECT COUNT(*) as Cantidad, detail_client_car.user_id as user_id FROM users  INNER JOIN detail_client_car  ON detail_client_car.user_id = users.id INNER JOIN repairs ON repairs.car_id = detail_client_car.car_id WHERE users.user_type_id = 'CLE' GROUP BY detail_client_car.user_id ORDER by Cantidad DESC LIMIT 10
        
        $clientes = User::selectRaw('COUNT(*) as cantidad, detail_client_car.user_id as user_id')->join('detail_client_car', 'detail_client_car.user_id', '=', 'users.id')->join('repairs', 'repairs.car_id', '=', 'detail_client_car.car_id')->where('users.user_type_id', '=', 'CLE')->groupBy('detail_client_car.user_id')->orderBy('Cantidad', 'desc')->limit(10)->get();

        $count = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $label = array('', '', '', '', '', '', '', '', '', '');
        $i = 0;

        foreach ($clientes as $cliente) {
            $count[$i] = $cliente["cantidad"];

            $user = User::where('id', '=', $cliente["user_id"])->first();
            $label[$i] = ($user->name);

            $i++;
        }
        
        $chr_clientes_historial = new SampleChart;
        $chr_clientes_historial->labels($label);
        $chr_clientes_historial->dataset('Clientes mas activos', 'bar', $count)->options(['borderColor' => '#ff0000']);
        $chr_clientes_historial->height(400);
        $chr_clientes_historial->width(600);
        
        // ///////////////////////////////////////////////////////////////

        return view('accountant.chartclientes', ['chr_clientes_historial' => $chr_clientes_historial]);
    }
}
