<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
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
}
