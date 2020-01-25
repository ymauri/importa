<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getCode6Package($code){
        switch (strlen($code)){
            case 3:
                return "000".$code;
            case 4:
                return "00".$code;
            case 5:
                return "0".$code;
            case 6:
                return $code;
        }
    }
}
