<?php

namespace Adyen;

class AdyenException extends \Exception {
    
    public function __construct($msg) {
        return parent::__construct($msg, 500);
    }
}

