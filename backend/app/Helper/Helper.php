<?php

namespace App\Helper;

class Helper {
    public static function ddh($var) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: *');
        header('Access-Control-Allow-Headers: *');
        dd($var);
    } 
}