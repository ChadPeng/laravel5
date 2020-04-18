<?php

namespace App\Http\Services;

use GuzzleHttp;

class BaseService
{
    public function GuzzleHttp($method , $url ,$body = array(), $params = array()){
        $client = new Guzzlehttp\Client();
        $string = '';

        if($method == 'post'){
            $params['headers'] = ["Content-Type" => "application/json"];
            $params['json'] = $body;
            $string = $client->post($url,$params);
        }

        if($method == 'get'){
            $string = $client->get($url, $params);
            return $string->getBody()->getContents();
        }

        return json_decode($string->getBody(),true);
    }
}
