<?php

namespace App\Http\Controllers\Web\Backend;

use anlutro\LaravelSettings\SettingsManager;
use App\Events\Settings\Updated as SettingsUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SettingsController
 * @package App\Http\Controllers
 */
class SettingsController extends Controller
{
    /**
     * Display general settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function general()
    {
		return view('backend.settings.general');
    }

    /**
     * Display Authentication & Registration settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function auth()
    {
        return view('backend.settings.auth');
    }

    /**
     * Handle application settings update.
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $this->updateSettings($request->except("_token"));

        return back()->withSuccess('Settings updated successfully.');
    }

    /**
     * Update settings and fire appropriate event.
     *
     * @param $input
     */
    private function updateSettings($input)
    {
        foreach ($input as $key => $value) {
        	setting()->set($key, $value);
        }

        setting()->save();

        event(new SettingsUpdated);
    }

    /**
     * Enable registration captcha.
     *
     * @return mixed
     */
    public function enableCaptcha(Request $request)
    {
        $this->updateSettings(['registration.captcha.enabled' => true]);

        return back()->withSuccess('reCAPTCHA enabled successfully.');
    }

    /**
     * Disable registration captcha.
     *
     * @return mixed
     */
    public function disableCaptcha()
    {
        $this->updateSettings(['registration.captcha.enabled' => false]);

        return back()->withSuccess('reCAPTCHA disabled successfully.');
    }

    /**
     * Display notification settings page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notifications()
    {
        return view('backend.settings.notifications');
    }
}
