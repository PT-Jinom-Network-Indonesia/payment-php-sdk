<?php

namespace Jinom\Payment\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Jinom\Payment\Transaction;

trait Snap {

    public function buildParam() {
        $param = [
            "transaction_details" => $this->transaction_details,
            "customer_details" => $this->customer_details,
            "item_details" => $this->item_details
        ];

        return $param;
    }

    public function createSnapToken(Transaction $transaction) {
        $params = $transaction->buildParam();
        $client = new Client();
        $url = $this->getUrl() . "/api/snap/token";
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

            return $body->data->token;
        } catch (RequestException $ce) {
            return "";
        }
    }
}