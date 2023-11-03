<?php

namespace Jinom\Payment\Traits;

trait CreateTransactionDetail {
    public function createTransactionDetail($order_id, $gross_amount, $expired_at = null) {
        $param = [
            "order_id" => $order_id,
            "gross_amount" => $gross_amount,
        ];

        if($expired_at) {
            $param['expired_at'] = $expired_at;
        }

        return $param;
    }

    public function setTransactionDetails($transaction_details)
    {
        $this->transaction_details = $transaction_details;

        if (isset($transaction_details['expired_at'])) $this->setExpiredDate($transaction_details['expired_at']);
    }
}