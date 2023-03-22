<?php
namespace App\Http\Controllers;
use App\Http\Middleware\SessionManager;

class SessionController extends Controller{

    public function setLanguage($newLang){
        SessionManager::setLanguage($newLang);
    }

}
