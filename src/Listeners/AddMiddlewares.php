<?php

namespace MigrateToFlarum\VBulletinRedirects\Listeners;

use Flarum\Event\ConfigureMiddleware;
use Illuminate\Contracts\Events\Dispatcher;
use MigrateToFlarum\VBulletinRedirects\Middlewares\RedirectMiddleware;

class AddMiddlewares
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureMiddleware::class, [$this, 'configureMiddleware']);
    }

    public function configureMiddleware(ConfigureMiddleware $event)
    {
        $event->pipe->pipe(app(RedirectMiddleware::class));
    }
}
