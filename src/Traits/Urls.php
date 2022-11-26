<?php

namespace Jinom\Payment\Traits;

trait Urls {
    public function getUrl() {
        if ($this->production) {
            return 'https://payment.jinom.net';
        } else {
            return 'https://va.sandbox.jinom.net';
        }
    }
}