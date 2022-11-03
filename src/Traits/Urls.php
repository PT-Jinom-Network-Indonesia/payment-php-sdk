<?php

namespace Jinom\Payment\Traits;

trait Urls {
    public function getUrl() {
        if ($this->production) {
            return 'https://va.jinom.net';
        } else {
            return 'https://va.sandbox.jinom.net';
            // return 'http://127.0.0.1:8000';
        }
    }
}