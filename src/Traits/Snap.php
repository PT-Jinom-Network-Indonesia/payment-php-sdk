<?php

namespace Jinom\Payment\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Jinom\Payment\Transaction;

trait Snap {

    public function buildParam($params = []) {

        $params['transaction_details'] = $this->transaction_details;
        $params['customer_details'] = $this->customer_details;
        $params['item_details'] = $this->item_details;

        if($this->created_by) {
            $params['created_by'] = $this->created_by;
        }

        $params = $this->addExpiryParam($params);
        

        return $params;
    }
    
    public function addExpiryParam($params) {
        if($this->expired_at) {
            $mils = strtotime($this->expired_at) - strtotime($this->created_at);

            $params['custom_expiry'] = [
                'order_time' => date('Y-m-d H:i:s +0800', strtotime($this->created_at)),
                'expiry_duration' => $mils / 60,
                'unit' => 'minute'
            ];

        }

        return $params;
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