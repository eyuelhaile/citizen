<?php

class Encryption {
	/**
	*/
    private $securekey, $iv, $iv2;
    function initialize() {
        $this->securekey = hash('sha256','beza1234',TRUE);
        $this->iv = mcrypt_create_iv(32);
        $this->iv2 = substr(hash('sha256', 'beza1234'), 0, 16);
    }
    function encrypt($input) {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->securekey, $input, MCRYPT_MODE_ECB, $this->iv));
    }
    function decrypt($input) {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
    }
}