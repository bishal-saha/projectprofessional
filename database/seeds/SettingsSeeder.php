<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setting([
            'app_name'                      => 'CertifyProfessional',
            'reg_enabled'                   => '1',
            'reg_email_confirmation'        => '1',
            'notifications_signup_email'    => '1',
            'forgot_password'               => '1',
            'login_reset_token_lifetime'    => '30',
            'throttle_enabled'              => '1',
            'throttle_attempts'             => '5',
            'throttle_lockout_time'         => '5',
            'registration.captcha.enabled'  => false,
            'captcha.enabled'               => false,
            'tos'                           => '1'
        ]);
        setting()->save();
    }
}
