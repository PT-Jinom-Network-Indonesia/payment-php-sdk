<?php

namespace Jinom\Payment\Traits;

trait CreateCustomerDetail {
    public function createCustomerDetail($fullname, $email='', $phone='', $address='') {
        $customer = [
            'fullname' => $fullname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ];

        return $customer;
    }
}