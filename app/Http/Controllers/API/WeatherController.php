<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\Weather as WeatherResource;
use Illuminate\Http\Response;
use Validator;
use RakibDevs\Weather\Weather;

class WeatherController extends BaseController
{
    public function showCurrentWeather($city)
    {
        $wt = new Weather();
        $info = $wt->getCurrentByCity($city);   
        return $this->handleResponse(['data' =>$info], 'Weather_info');
    }

    public function showForecastWeather($city)
    {
        $wt = new Weather();
        $info = $wt->get3HourlyByCity($city);   
        return $this->handleResponse(['data' =>$info], 'Weather_info');
    }
}
