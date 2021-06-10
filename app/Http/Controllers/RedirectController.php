<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
	public function index() {
		$url = "https://youjustbetter.cl/";
		return Redirect::away($url);

    }

    public function development() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSd59ziGnReCKq0pNSzsjodtHgyui_hWrk7oZHKxsPavQUuPRQ/viewform";
		return Redirect::away($url);

    }

    public function communications() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSf-6LgbONv4BuFIzoyjDpHFM2EbBZVhHHMeP8P1XKUAOe8jlg/viewform";
		return Redirect::away($url);

    }

    public function administration() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSfI8R2A36mwtSwihtYocuQI9xgJ22L56E5PwvHN-ZFoqsC7Cw/viewform?usp=sf_link";
		return Redirect::away($url);

    }

    public function whatsapp() {
		$url = "https://api.whatsapp.com/send?phone=56933809726&text=Hola%20Equipo%20You";
		return Redirect::away($url);
    }

    public function trainning() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLScpUiedpwx-A20tpT_zVjineUTcGvpkHPpal7ztKekMTqP6TQ/viewform?usp=sf_link";
		return Redirect::away($url);
    }

    public function arancel() {
		$url = "https://docs.google.com/spreadsheets/d/1GeEQi1_4sWTI81nUj4z73SeKPBAh5VrFovGMASiLTMQ/edit?usp=sharing";
		return Redirect::away($url);
    }

    public function pay() {
		$url = "https://pagatuprofesional.cl/profesionales/you-spa";
		return Redirect::away($url);
    }

    public function contreras() {
    	$url = "https://meet.google.com/lookup/by3ys3yn4n";
    	return Redirect::away($url);
    }

	public function barchiesi() {
		$url = "https://meet.google.com/lookup/hjk2sg6ft7";
		return Redirect::away($url);
	}

	public function cristi() {
		$url = "https://meet.google.com/lookup/ezsojtf4ic";
		return Redirect::away($url);
	}

	public function guzman() {
		$url = "https://meet.google.com/lookup/hucadm5kxf";
		return Redirect::away($url);
	}

	public function maldonado() {
		$url = "https://meet.google.com/lookup/dmmpfyk7k7";
		return Redirect::away($url);
	}

	public function martinez() {
		$url = "https://meet.google.com/lookup/ccmxwbtfy7";
		return Redirect::away($url);
	}

	public function moya() {
		$url = "https://meet.google.com/lookup/h5jamuirmy";
		return Redirect::away($url);
	}

	public function niklitschek() {
		$url = "https://meet.google.com/lookup/bcm7tibb3e";
		return Redirect::away($url);
	}

	public function ross() {
		$url = "https://meet.google.com/lookup/hijisrvbtf";
		return Redirect::away($url);
	}

	public function valenzuela() {
		$url = "https://meet.google.com/lookup/d5wap4jf3r";
		return Redirect::away($url);
	}

	public function vivallo() {
		$url = "https://meet.google.com/lookup/cwd7ruxjqj";
		return Redirect::away($url);
	}

	public function internos() {
		$url = "https://meet.google.com/lookup/d6kgixnizn";
		return Redirect::away($url);
	}

	public function meetyou() {
		$url = "https://meet.google.com/lookup/bgymkxkfpy";
		return Redirect::away($url);
	}



}
