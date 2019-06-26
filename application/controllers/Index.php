<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class Index extends REST_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function test_get()
    {
        $this->response(array('errno'=>0,'data'=>'get_success'));
    }

    public function test_post()
    {
        $this->response(array('errno'=>0,'data'=>'post_success'));
    }

}