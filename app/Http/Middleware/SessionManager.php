<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class SessionManager
{
    private const DEFAULT_LANG = 'en';

    public static function getLanguage()
    {

        // if it doesn't exist, set the default
        if (!request()->session()->exists('lang'))
            self::setLanguage();

        return request()->session()->get('lang');
    }

    public static function setLanguage($lang)
    {
        //$lang = self::getLanguage();

       /* if (request()->session()->exists('lang'))
            return;
*/
        if($lang == '') {

            // set a default in case no suitable language is found
            $lang = self::DEFAULT_LANG;

            $browser = request()->server('HTTP_ACCEPT_LANGUAGE');
            if ($browser != '') {
                // parse the browser languages
                preg_match_all('/(\W|^)([a-z]{2})([^a-z]|$)/six', $browser, $m, PREG_PATTERN_ORDER);
                $user_langs = $m[2];

                // get the DB languages and load the codes into an array
                $languages = \App\Language::all();
                $dbLangs = [];
                foreach ($languages as $ll)
                    $dbLangs[] = $ll->lang_code;

                // find the first compatible language
                foreach ($user_langs as $user_lang) {
                    if (in_array($user_lang, $dbLangs)) {
                        $lang = $user_lang;
                        break;
                    }
                }
            }
        }
        request()->session()->put('lang', $lang);

        return $lang;
    }
}
