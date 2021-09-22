<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
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

        $profesionals = UserApp::where('medilinkname','<>','null')->get();

        $summarys = [];

        foreach($profesionals as $profesional)
        {
            $actions = Action::professionalCloseMonth($profesional->medilinkname);
            $summary = $this->summary($actions);
            foreach ($actions as $key => $action) {
                $actions[$key]->Prestación = $this->moneda_chilena($actions[$key]->Prestación);
                $actions[$key]->Abono = $this->moneda_chilena($actions[$key]->Abono);
            }
            $goal = 300;
            $percentage = round($summary['Total']*100/$goal,1);
            $remuneration = $this->moneda_chilena($summary['Prestación']*$this->coefficient($profesional->medilinkname));
            $summary['Prestación'] = $this->moneda_chilena($summary['Prestación']);
            $summary['Abono'] = $this->moneda_chilena($summary['Abono']);

            $summarys[] = $summary;
            $names[] = $profesional->name;
            $goals[] = $goal;
            $percentages[] = $percentage;
            $remunerations[] = $remuneration;

        }
        return view('youapp.team.index',compact('summarys','names','goals','percentages','remunerations'));
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
        $numero = (string)$numero;
        $puntos = floor((strlen($numero)-1)/3);
        $tmp = "";
        $pos = 1;
        for($i=strlen($numero)-1; $i>=0; $i--){
        $tmp = $tmp.substr($numero, $i, 1);
        if($pos%3==0 && $pos!=strlen($numero))
        $tmp = $tmp.".";
        $pos = $pos + 1;
        }
        $formateado = "$ ".strrev($tmp);
        return $formateado;
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
            'Diego Ignacio Contreras Briceño' => 0.7,
            'You Entrenamiento' => 1,
            'Camila Valentini Rojas' => 0.42,
        ];

        return $coff[$name];
    }
}
