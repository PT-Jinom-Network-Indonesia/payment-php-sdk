<?php

namespace Jinom\Payment\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait VirtualAccount {
    public function createVirtualAccount($customer_code = "", $bank = "bri,bni,bca") {
        $client = new Client();
        $url = $this->getUrl() . '/api/virtual-account/create';

        try {
            $request = $client->post($url, [
                "headers" => [
                    "Authorization" => "Bearer " . $this->server_key,
                    "Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                "json" => [
                    "bank" => $bank,
                    "customer_code" => $customer_code
                ],
            ]);
            $body = json_decode($request->getBody()->getContents());

            return $body->data;
        } catch (RequestException $ce) {
            dd($ce);
            return [];
        }
    }
}