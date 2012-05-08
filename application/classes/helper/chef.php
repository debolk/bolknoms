<?php defined('SYSPATH') or die('No direct script access.');

class Helper_Chef
{
    /**
     * Outputs a random youtube-movie of the swedish chef
     * @return string of HTML
     */
    public static function random_video()
    {
        $codes = array('j1KSaUEu_T4', 'AvDvTnTGjgQ', 'sY_Yf4zz-yo', 'mbs64GvGgPU', 'mXfHyDCcTGQ',
                        '2Qj8PhxSnhg', 'CAsYwW7pt7o', 'B-OFXUaMIv8', 'qT_n__vsguk', 'IwGdHAHg0ig');
        return '<iframe width="420" height="315" src="http://www.youtube.com/embed/'.
                    $codes[array_rand($codes)].'?autoplay=0&amp;controls=1" frameborder="0"></iframe>';
    }
}