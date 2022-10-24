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
}