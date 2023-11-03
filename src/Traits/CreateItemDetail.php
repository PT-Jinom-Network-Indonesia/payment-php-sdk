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


    public function setItemDetails($item_details)
    {
        $this->item_details = $item_details;
    }
}