<?php

namespace App\Service;

class Numbering
{
    public static function getStringNumber($number, $digit)
    {
        $string = '';
        for ($i=0; $i < $digit - strlen($number); $i++) {
            $string .= '0';
        }

        return $string.$number;
    }
}
