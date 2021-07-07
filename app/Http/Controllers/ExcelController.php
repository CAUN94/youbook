<?php

namespace App\Http\Controllers;

use App\Exports\CloseExport;
use App\Exports\LastWeekExport;
use App\Exports\MonthExport;
use App\Exports\ProfessionalsExport;
use App\Exports\TeamExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function occupation($type)
    {
        if($type == "close"){
            $firstday = date('d-m',strtotime("first day of this month"));
	    	$name = 'CierreMes21-'.(date('m')-1).'.xlsx';
	        return Excel::download(new CloseExport, $name);
        }
        elseif ($type == "last-week") {
            $monday = date('d-m',strtotime("Monday last week"));
            $name = 'SemandaDel'. $monday.'.xlsx';
            return Excel::download(new LastWeekExport, $name);
        }
        elseif ($type == "month") {
            $firstday = date('d-m',strtotime("first day of this month"));
            $name = 'DesdePrincipioDeMes'.$firstday.'.xlsx';
            return Excel::download(new MonthExport, $name);
        }
        else {
            return redirect('/');
        }
    }
    public function professionals()
    {
        return Excel::download(new ProfessionalsExport(), "equipoyou.xlsx");
    }

    public function professional($name)
    {
        return Excel::download(new ProfessionalExport($name), $name.".xlsx");
    }

    public function team()
    {
        return Excel::download(new TeamExport(), "equipoyou.xlsx");
    }

}
