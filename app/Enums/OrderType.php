<?php

namespace App\Enums;

class OrderType {

    public const ENA = 1;
    public const ENVIO = 2;

    public static function getName (int $value) {
        switch ($value) {
            case 1:
                return 'ENA';
            case 2:
                return 'ENVIO';
            default:
                return '';
        }
    }
}
