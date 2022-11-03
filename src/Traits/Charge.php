<?php

namespace Jinom\Payment\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait Charge {
    public function charge($params) {
        
        $client = new Client();
        $url = $this->getUrl() . "/api/transaction/charge";
        try {
            $request = $client->post($url, [
                "headers" => [
                    "Authorization" => "Bearer " . $this->server_key,
                    "Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                "json" => $params,
            ]);
            $body = json_decode($request->getBody()->getContents());

            return $body;
        } catch (RequestException $ce) {
            dd($ce, json_encode($params));
            return "";
        }
    }
}