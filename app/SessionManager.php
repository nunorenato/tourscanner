<?php

use Illuminate\Http\Request;
class SessionManager{

    public static function getLanguage(Request $request){

        if(!$request->session()->exists('lang'))
            self::setLanguage($request);

        return $request->session()->get('lang');
    }

    public static function setLanguage(Request $request){
        //$lang = self::getLanguage();

        if($request->session()->exists('lang'))
            return;

        $lang = 'en';
        $browser = Request::server('HTTP_ACCEPT_LANGUAGE');
        if(!empty($browser)){
            preg_match_all('/(\W|^)([a-z]{2})([^a-z]|$)/six', $browser, $m, PREG_PATTERN_ORDER);
            $user_langs = $m[2];

            $languages = \App\Language::all();
            $dbLangs = [];
            foreach($languages as $ll)
                $dbLangs[] = $ll->lang_code;
            foreach($user_langs as $user_lang){
                if(in_array($user_lang, $dbLangs)){
                    $lang = $user_lang;
                    break;
                }
            }
        }
        $request->session()->put('lang', $lang);
    }
}
