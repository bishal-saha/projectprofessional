<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 22/11/18
 * Time: 12:56 AM
 */
if (! function_exists('appSettings')) {
    /**
     * Get / set the specified settings value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function appSettings($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('anlutro\LaravelSettings\SettingStore');
        }

        return app('anlutro\LaravelSettings\SettingStore')->get($key, $default);
    }
}

/**
 * Print provided data with formatting.
 *
 * @param $data
 */
function pr($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	exit;
}

if (! function_exists('statusBadge')) {
	/**
	 * Determine css class used for status labels
	 * inside the users table by checking user status.
	 *
	 * @return string
	 */
	function statusBadge($status = '')
	{
		return $status ? "<span class='badge badge-success'>Active</span>"
			: "<span class='badge badge-warning'>Inactive</span>";
	}
}

if (!function_exists('userSalutation')) {
	function userSalutation()
	{
		// I'm India so my timezone is Asia/Calcutta
		date_default_timezone_set('Asia/Calcutta');

		// 24-hour format of an hour without leading zeros (0 through 23)
		$Hour = date('G');

		if ( $Hour >= 5 && $Hour <= 11 ) {
			$salutation = "Good Morning";
		} else if ( $Hour >= 12 && $Hour <= 17 ) {
			$salutation = "Good Afternoon";
		} else if ( $Hour >= 18 || $Hour <= 4 ) {
			$salutation = "Good Evening";
		}

		return $salutation;
	}
}