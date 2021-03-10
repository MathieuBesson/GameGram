<?php 


class Libarray
{
    public static function pop($array, $element, $key = 0)
    {
        return [$key => $element] + $array ;
    }
}