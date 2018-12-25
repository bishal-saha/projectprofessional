<?php

namespace App\Listeners;

use App\Events\Role\Created;
use App\Events\Role\PermissionsUpdated;
use App\Events\Role\Updated;
use App\Events\Role\Deleted;
use App\Services\Logging\UserActivity\Logger;

class RoleEventsSubscriber
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function onCreate(Created $event)
    {
        $message = 'Created new role called '.$event->getRole()->display_name;

        $this->logger->log($message);
    }

    public function onUpdate(Updated $event)
    {
        $message = 'Updated role with name '.$event->getRole()->display_name;

        $this->logger->log($message);
    }

    public function onDelete(Deleted $event)
    {
        $message = 'Deleted role named '.$event->getRole()->display_name;

        $this->logger->log($message);
    }

    public function onPermissionsUpdate(PermissionsUpdated $event)
    {
        $this->logger->log('Updated role permissions.');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $class = 'App\Listeners\RoleEventsSubscriber';

        $events->listen(Created::class, "{$class}@onCreate");
        $events->listen(Updated::class, "{$class}@onUpdate");
        $events->listen(Deleted::class, "{$class}@onDelete");
        $events->listen(PermissionsUpdated::class, "{$class}@onPermissionsUpdate");
    }
}
