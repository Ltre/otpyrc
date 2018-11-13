<?php

class AES {

    private $_key;
    private $_iv;
    private $_method;

    function __construct($key, $iv = 'www.abc.com', $method = 'aes-256-cfb') {
        $this->_key = $key;
        $this->_iv = $iv;
        $this->_method = $method;
    }

    function encode($str) {
        if (function_exists('openssl_encrypt')) {
            return openssl_encrypt($str, $this->_method, $this->_key, false, $this->_iv);
        } else {
            $cmd = "echo \"" . $str . "\" | openssl enc -" . $this->_method . " -base64 -nosalt -K " . bin2hex($this->_key) . " -iv " . bin2hex($this->_iv);
            $ret = shell_exec($cmd);
            return trim($ret);
        }
    }

    function decode($str) {
        if (function_exists('openssl_decrypt')) {
            return trim(openssl_decrypt($str, $this->_method, $this->_key, false, $this->_iv));
        } else {
            $cmd = "echo \"" . $str . "\" | openssl enc -" . $this->_method . " -d -base64 -nosalt -K " . bin2hex($this->_key) . " -iv " . bin2hex($this->_iv);
            $ret = shell_exec($cmd);
            return trim($ret);
        }
    }


}