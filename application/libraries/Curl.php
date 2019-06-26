<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/libraries/Requests.php';

class Curl extends Requests {
    public function __construct() {
        self::register_autoloader();
    }
}