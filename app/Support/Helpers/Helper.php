<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 28/11/18
 * Time: 8:18 AM
 */

namespace App\Support\Helpers;


class Helper
{
    public static function pr($args)
    {
        echo "<pre>";
        print_r($args);
        echo "<pre>";
    }

    public static function printMonthName($month)
	{
		$months = [
			1 => 'January',
			2 => 'February',
			3 => 'March',
			4 => 'April',
			5 => 'May',
			6 => 'June',
			7 => 'July',
			8 => 'August',
			9 => 'September',
			10 => 'October',
			11 => 'November',
			12 => 'December',
		];

		return $months[$month];
	}
}