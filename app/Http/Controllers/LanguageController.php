<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(Request $request)
    {

        $locale = $request->input('language');
        if (in_array($locale, ['es', 'en'])) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
