<?php

namespace Jinom\Payment\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Jinom\Payment\Transaction;

trait Charge {
    public function charge(Transaction $transaction, $params = []) {
        $client = new Client();
        $finalParams = $transaction->buildParam($params);
        $url = $this->getUrl() . "/api/transaction/charge";
        try {
            $request = $client->post($url, [
                "headers" => [
                    "Authorization" => "Bearer " . $this->server_key,
                    "Content-Type" => "application/json",
                    "Accept" => "application/json"
                ],
                "json" => $finalParams,
            ]);

            $body = json_decode($request->getBody()->getContents());

            return $body;
        } catch (RequestException $ce) {
            throw $ce;
        }
    }
}