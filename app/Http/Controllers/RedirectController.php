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

    public function whatsappform(Request $request) {
    	$validated = $request->validate([
	        'message' => 'required',
	        'number' => 'required|min:8',
	    ]);
    	$data = $request->all();
    	$number= substr($data['number'], -8);
    	$data['message'] = $data['message']." ";
    	$data['message'] = preg_replace('/\n+/', '%0A', $data['message']);
    	$data['message'] = preg_replace('/\s+/', '%20', $data['message']);
		$url = "https://api.whatsapp.com/send?phone=569".$number."&text=".$data['message'];
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
		// $url = "https://pagatuprofesional.cl/profesionales/you-spa";
		$url = "https://padpow.com/customer/professionals/3165/payments/new";
		return Redirect::away($url);
    }

    public function contreras() {
    	$url = "https://meet.jit.si/dcontrerasb";
    	return Redirect::away($url);
    }

	public function barchiesi() {
		$url = "https://meet.jit.si/rbarchiesiv";
		return Redirect::away($url);
	}

	public function cristi() {
		$url = "https://meet.jit.si/icristis";
		return Redirect::away($url);
	}

	public function guzman() {
		$url = "https://meet.jit.si/jmguzmanh";
		return Redirect::away($url);
	}

	public function maldonado() {
		$url = "https://meet.jit.si/amaldonados";
		return Redirect::away($url);
	}

	public function martinez() {
		$url = "https://meet.jit.si/mjmartinezm";
		return Redirect::away($url);
	}

	public function moya() {
		$url = "https://meet.jit.si/cmoyac";
		return Redirect::away($url);
	}

	public function niklitschek() {
		$url = "https://meet.jit.si/aniklitscheks";
		return Redirect::away($url);
	}

	public function ross() {
		$url = "https://meet.jit.si/mrossg";
		return Redirect::away($url);
	}

	public function valenzuela() {
		$url = "https://meet.jit.si/cvalenzuelar";
		return Redirect::away($url);
	}

	public function vivallo() {
		$url = "https://meet.jit.si/dvivallov";
		return Redirect::away($url);
	}

	public function internos() {
		$url = "https://meet.jit.si/internos";
		return Redirect::away($url);
	}

	public function meetyou() {
		$url = "https://meet.jit.si/meetyou";
		return Redirect::away($url);
	}

	public function lopez() {
		$url = "https://meet.jit.si/alopezm";
		return Redirect::away($url);
	}

	public function fguzman() {
		$url = "https://meet.jit.si/fguzmanh";
		return Redirect::away($url);
	}

	public function hernandez() {
		$url = "https://meet.jit.si/chernandezc";
		return Redirect::away($url);
	}

	public function vitali() {
		$url = "https://meet.jit.si/svitalimz";
		return Redirect::away($url);
	}

	public function rrhh() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSfp5FjEXouwK0_Tm6hkHaLMvrzqU6OsXmNhIYHUQ3-vdlbJSA/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function techo() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSeRuajbx4B0Ox8fA3g9hRZfIdfdRLAwoU6eJIsec98XlTq2gA/viewform?usp=pp_url";
		return Redirect::away($url);
	}

	public function rsf() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLScCFgcGZG_OAlDUaG2VdAUUYD4m3dCHWcRD33cUl-zv2Wiw4A/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function registro() {
		$url = "https://docs.google.com/forms/d/1NHVEMK_SuUTnFHyACwKxXvydQ0t9BhOLevnWaL3U9Bw/edit";
		return Redirect::away($url);
	}



}
