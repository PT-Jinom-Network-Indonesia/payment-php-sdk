<?php

namespace Jinom\Payment\Traits;

trait CreateOrderId {
    public function generate_order_id($prefix = "", $suffix = "") {
        $order_id = "$prefix" . date("YmdHis") . $suffix;
        return $order_id;
    }

    public function setOrderId($order_id) {
        $this->transaction_details['order_id'] = $order_id;
    }
}