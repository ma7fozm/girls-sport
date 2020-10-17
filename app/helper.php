<?php
/**
 * Created by PhpStorm.
 * User: mahfouz
 * Date: 3/25/2019
 * Time: 3:12 PM
 */

namespace App;


class helper
{

    public  function convertArabicNumbers($string) {
        //$engish = array(0,1,2,3,4,5,6,7,8,9);
        static $fromchar = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹',
            '٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        static $num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($num, $fromchar, $string);
    }
}