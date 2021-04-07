<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller{

    public function setLanguage(Request $request){
        $lang = $request->input('lang');
        Cookie::queue('rr_lang', $lang, 2628000);
        return null;
    }

}
