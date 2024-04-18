<?php

namespace App\Responses;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

final class WheatherResponse
{
    private string $appId = 'fe4255704ef738d9a57dc9dfc8dda693';

    public function __construct(
        private string $city = 'London',
        private string $language = 'ru',
        /**
         * Possible: metric is celsius and imperial  is fahrenheit
         *
         * @var string
         */
        private string $measureSystem = 'metric'
    ) {}

    public static function ask(string $city, string $language, string $measureSystem)
    {
        $object = new WheatherResponse($city, $language, $measureSystem);
        return $object->process();
    }

    private function process()
    {
        $coords = $this->getCoords();

        if ( $coords->successful() ) {

            $whether = $this->getWheather($coords);

            $collection = $this->roastResponse($whether);

            return $collection->all();
        
        } else {
            abort(500, 'Something went wrong.');
        }
    }

    private function getCoords(): Response
    {
        return Http::get('http://api.openweathermap.org/geo/1.0/direct', [
            'q' => $this->city,
            'appid' => $this->appId
        ]);
    }

    private function getWheather(Response $coords): Response
    {
        $coordObject = $coords->object()[0];

        return Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $coordObject->lat,
            'lon' => $coordObject->lon,
            'units' => $this->measureSystem,
            'lang' => $this->language,
            'mode' => 'xml',
            'appid' => $this->appId
        ]);
    }

    private function roastResponse(Response $whether): Collection
    {
        $xml = simplexml_load_string( $whether->body() );
        $json = json_encode($xml);
        $array = json_decode($json, associative: true);
        $dottedResponse = collect($array)->dot();
        
        $collection = collect();

        $collection->put('city', $dottedResponse->get('city.@attributes.name'));
        $collection->put('temperature', round(
            $dottedResponse->get('temperature.@attributes.value'), 
            mode: PHP_ROUND_HALF_UP
        ));
        $collection->put('temperature.unit', $dottedResponse->get('temperature.@attributes.unit'));
        $collection->put('description', $dottedResponse->get('weather.@attributes.value'));
        $collection->put('wind.speed', $dottedResponse->get('wind.speed.@attributes.value'));
        $collection->put('wind.direction', $dottedResponse->get('wind.direction.name'));
        $collection->put('pressure', (
            (float) $dottedResponse->get('pressure.@attributes.value') / 1.33322
        ));
        $collection->put('humidity', $dottedResponse->get('humidity.@attributes.value'));

        return $collection;
    }
}