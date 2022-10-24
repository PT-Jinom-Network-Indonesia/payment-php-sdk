<?php

namespace Jinom\Payment;

use Jinom\Payment\Traits\CreateItemDetail;
use Jinom\Payment\Traits\Snap;
use Jinom\Payment\Traits\Urls;
use Jinom\Payment\Traits\CreateOrderId;

class JinomPayment 
{
    use Urls, Snap, CreateOrderId;

    private $server_key;
    public $production = false;

    public function __construct($server_key, $production = false)
    {
        $this->server_key = $server_key;
        $this->production = $production;
    }

    public function createEmptyTransaction() {
        return new Transaction();
    }



}
