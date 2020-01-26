<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS1D;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getCodePackage($code){
        $barcode = config('global.gb_code').date('y');
        switch (strlen($code)){
            case 3:
                $barcode .= "000".$code;
                break;
            case 4:
                $barcode .= "00".$code;
                break;
            case 5:
                $barcode .= "0".$code;
                break;
            case 6:
                $barcode .= $code;
                break;
        }
        $dns = new DNS1D();
        $dns->barcode_eanupc($barcode);
        $img = $dns->getBarcodePNG($barcode, "EAN13", 2, 30, [0, 0, 0], true);
        $fullcode = $dns->getBarcodeArray();
        Storage::disk('public')->put('/barcode/'.$fullcode['code'].'.png', base64_decode($img));
        return $fullcode['code'];
    }
}
