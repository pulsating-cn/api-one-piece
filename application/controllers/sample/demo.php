<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class demo extends REST_Controller
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * @param  [array]
     * @param  [int]
     * @return [array]
     */
    private function twoSum($nums, $target){
        $flip_nums = array_flip($nums);
        foreach($flip_nums as $key=> $value) {
            $number = $target - $key;

            echo 'f:'.$flip_nums[$number];
            echo "<pre>";
            echo 'v:'.$value;
            echo "<pre>";
            if( isset($flip_nums[$number]) && $flip_nums[$number] != $value ){
                return array($value,$flip_nums[$number]);
            }
        }
    }
    public function testTwoSum_get()
    {
        $nums = array(1,4,4,9);
        $target = 8;
        $res = $this->twoSum($nums, $target);
        print_r($res);
    }

}