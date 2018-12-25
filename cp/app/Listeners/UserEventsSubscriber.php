<?php

namespace App\Listeners;

use App\Events\Settings\Updated as SettingsUpdated;
use App\Events\User\Banned;
use App\Events\User\ChangedAvatar;
use App\Events\User\Created;
use App\Events\User\Deleted;
use App\Events\User\LoggedIn;
use App\Events\User\LoggedOut;
use App\Events\User\Registered;
use App\Events\User\RequestedPasswordResetEmail;
use App\Events\User\ResetedPasswordViaEmail;
use App\Events\User\UpdatedByAdmin;
use App\Events\User\UpdatedProfileDetails;
use App\Services\Logging\UserActivity\Logger;

class UserEventsSubscriber
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onLogin(LoggedIn $event)
    {
        $this->logger->log('Logged in.');
    }

    public function onLogout(LoggedOut $event)
    {
        $this->logger->log('Logged out.');
    }

    public function onRegister(Registered $event)
    {
        $this->logger->setUser($event->getRegisteredUser());
        $this->logger->log('Created an account for user :name.');
    }

    public function onAvatarChange(ChangedAvatar $event)
    {
        $this->logger->log('Updated profile avatar.');
    }

    public function onProfileDetailsUpdate(UpdatedProfileDetails $event)
    {
        $this->logger->log('Updated profile details for :name.');
    }

    public function onDelete(Deleted $event)
    {
		$message = 'Deleted the user '.$event->getDeletedUser()->present()->nameOrEmail;

        $this->logger->log($message);
    }

    public function onBan(Banned $event)
    {
        $message = 'Banned user '.$event->getBannedUser()->present()->nameOrEmail.'.';

        $this->logger->log($message);
    }

    public function onUpdateByAdmin(UpdatedByAdmin $event)
    {
        $message = 'Updated profile details for '.$event->getUpdatedUser()->present()->nameOrEmail.'.';

        $this->logger->log($message);
    }

    public function onCreate(Created $event)
    {
        $message = 'Created an account for user '.$event->getCreatedUser()->present()->nameOrEmail.'.';

        $this->logger->log($message);
    }

    public function onSettingsUpdate(SettingsUpdated $event)
    {
        $this->logger->log('Updated website settings.');
    }



    public function onPasswordResetEmailRequest(RequestedPasswordResetEmail $event)
    {
        $this->logger->setUser($event->getUser());
        $this->logger->log('Requested password reset email.');
    }

    public function onPasswordReset(ResetedPasswordViaEmail $event)
    {
        $this->logger->setUser($event->getUser());
        $this->logger->log('Reseted password using "Forgot Password" option.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Listeners\UserEventsSubscriber';

        $events->listen(LoggedIn::class, "{$class}@onLogin");
        $events->listen(LoggedOut::class, "{$class}@onLogout");
        $events->listen(Registered::class, "{$class}@onRegister");
        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(ChangedAvatar::class, "{$class}@onAvatarChange");
        $events->listen(UpdatedProfileDetails::class, "{$class}@onProfileDetailsUpdate");
        $events->listen(UpdatedByAdmin::class, "{$class}@onUpdateByAdmin");
        $events->listen(Deleted::class, "{$class}@onDelete");
        $events->listen(Banned::class, "{$class}@onBan");
        $events->listen(SettingsUpdated::class, "{$class}@onSettingsUpdate");
        $events->listen(RequestedPasswordResetEmail::class, "{$class}@onPasswordResetEmailRequest");
        $events->listen(ResetedPasswordViaEmail::class, "{$class}@onPasswordReset");
    }
}
