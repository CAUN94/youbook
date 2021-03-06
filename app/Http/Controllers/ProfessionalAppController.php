<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessionalAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!auth::user()->isAdmin()){
                abort(401);
        }
        if(auth::user()->isAdmin()){
            $actions = Action::professionalsCloseMonth();
            $summary = $this->summary($actions);
            foreach ($actions as $key => $action) {
                $actions[$key]->Prestación = $this->moneda_chilena($actions[$key]->Prestación);
                $actions[$key]->Abono = $this->moneda_chilena($actions[$key]->Abono);
            }
            $goal = 300;
            $percentage = round($summary['Total']*100/$goal,1);
            $summary['Prestación'] = $this->moneda_chilena($summary['Prestación']);
            $summary['Abono'] = $this->moneda_chilena($summary['Abono']);
            return view('youapp.professionals.index',compact('actions','summary','goal','percentage'));
        }
    }

    public function show($name)
    {
        if(!auth::user()->isAdmin()){
                abort(401);
        }
        if(auth::user()->isAdmin()){
            $actions = Action::professionalCloseMonth($name);
            $summary = $this->summary($actions);
            foreach ($actions as $key => $action) {
                $actions[$key]->Prestación = $this->moneda_chilena($actions[$key]->Prestación);
                $actions[$key]->Abono = $this->moneda_chilena($actions[$key]->Abono);
            }
            $goal = 300;
            $percentage = round($summary['Total']*100/$goal,1);
            $remuneration = $this->moneda_chilena($summary['Prestación']*$this->coefficient($name));
            $summary['Prestación'] = $this->moneda_chilena($summary['Prestación']);
            $summary['Abono'] = $this->moneda_chilena($summary['Abono']);
            return view('youapp.professionals.show',compact('actions','summary','name','goal','percentage','remuneration'));
        }


    }

    public function summary($actions)
    {
    	$values = ['Convenio','Sin_Convenio','Embajador','Prestación','Abono'];
        $summary = [];
        $summary['Total'] = 0;
        $summary['Convenio'] = 0;
        $summary['Sin_Convenio'] = 0;
        $summary['Embajador'] = 0;
        $summary['Prestación'] = 0;
        $summary['Abono'] = 0;

        foreach ($actions as $key => $action) {
        	$summary['Total'] += 1;
        	if($action->Convenio_Nombre != 'Sin Convenio' and $action->Convenio_Nombre != 'Embajador' and $action->Convenio_Nombre != 'Pro Bono'){
        		$summary['Convenio'] +=1;
        	}
        	elseif ($action->Convenio_Nombre == 'Sin Convenio') {
        		$summary['Sin_Convenio'] +=1;
        	}
        	elseif ($action->Convenio_Nombre = 'Embajador' or $action->Convenio_Nombre = 'Pro Bono') {
        		$summary['Embajador'] +=1;
        	}
	        $summary['Prestación'] += $action->Prestación;
	        $summary['Abono'] += $action->Abono;
        }
        return $summary;
    }

    public function moneda_chilena($numero){
        $fmt = numfmt_create('es_CL', \NumberFormatter::CURRENCY);
        return  $fmt->formatCurrency($numero, "CLP");
    }

    public function coefficient($name)
    {
        $coff = [
            'Alonso Niklitschek Sanhueza' => 0.6,
            'César Moya Calderón' => 0.32,
            'Daniella Vivallo Vera' => 0.45,
            'Juan Manuel Guzmán Habinger' => 0.7,
            'Iver Cristi Sánchez' => 0.6,
            'Renata Barchiesi Vitali' => 0.6,
            'Sofía Vitali Magasich' => 0.5,
            'Carolina Avilés Espinoza' => 0.7,
            'Mariano Neira Palomo' => 0.45,
            'Sara Tarifeño Ramos' => 1,
            'María Jesús Martinez León' => 0.45,
            'Melissa Ross Guerra' => 0.55,
            'Cristina Valenzuela ' => 0.42,
            'Adolfo Lopez Macera' => 0.46,
            'Diego Contreras Briceño' => 0.7,
            'You Entrenamiento' => 1,
            'Camila Valentini Rojas' => 0.42,
            'Jaime Pantoja Rodriguez' => 0.54,
            'Fernanda Cárdenas Muñoz' => 0.6,
            'Rocío Nuche Salgado' => 0.7,
            'Constanza Ahumada Huerta' => 0.32,
            'Antonio Ceresuela Phillips' => 0.7,
            'Ángel Saez Miranda' => 0.32,
            'Nicole Cedeño Wolf ' => 0.35,
            'Manuel Silva Ávila' => 0.56,
            'Josefa Andrea Valcárcel Silva' => 0.46,

        ];

        return $coff[$name];
    }
}
