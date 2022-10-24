<?php

namespace Jinom\Payment\Traits;


trait CreateItemDetail {
    public function createItemDetail($name, $price, $quantity) {
        $item = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
        ];

        return $item;
    }
}