<?php

namespace Ignite\Http\Controllers;
use Ignite\Repair;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index()
    {
        $idS = auth()->user()->id;
        $repairs = Repair::join('detail_mechanic_repair','detail_mechanic_repair.repair_id','=','repairs.id')
        ->select('repairs.*')->where([
            ['status','=','0'],
            ['detail_mechanic_repair.user_id','=',$idS],
        ])->get();
        return view('mechanic.home',['repairs' => $repairs]);
    }

}
