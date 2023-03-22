<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    //

    public static function getCitiesWithActivities($language)
    {

        $results = \Illuminate\Support\Facades\DB::select("SELECT cities.*, ifnull(cl.name_alias, cities.name) as localized_name
                    FROM cities LEFT JOIN
                        cities_localizations cl ON cities.id = cl.city_id AND cl.lang = '?'
                    WHERE cities.id IN (SELECT city_id FROM activities)
                    LIMIT 7", [$language]);

        return $results;
    }
}
