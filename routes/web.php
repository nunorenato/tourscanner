<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{lang}/home', function(Request $request, string $lang){
    $currentLang = \App\Http\Middleware\SessionManager::getLanguage();
    if($lang != $currentLang)
        redirect()->to("/$currentLang/home");

    dd($currentLang, \App\Http\Controllers\CityController::getCitiesWithActivities($currentLang));
});

Route::get('set_lang', function (Request $request){

    if($request::exists('lang')) {
        $newLang = \App\Http\Middleware\SessionManager::setLanguage($request::get('lang'));
        print(json_encode($newLang));
    }
    else
        print('lang not defined');
});

//Route::resource('atletas', AtletaController::class);

