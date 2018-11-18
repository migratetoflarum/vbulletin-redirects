<?php

namespace MigrateToFlarum\VBulletinRedirects\Tests;

use Flarum\Http\RouteCollection;
use Flarum\Http\RouteCollectionUrlGenerator;
use Flarum\Http\UrlGenerator;

class FakeUrlGenerator extends UrlGenerator
{
    public function __construct()
    {
        // do not call parent

        $routes = new RouteCollection();

        $routes->get(
            '/d/{id:\d+(?:-[^/]*)?}[/{near:[^/]*}]',
            'discussion',
            null
        );
        $routes->get(
            '/u/{username}[/{filter:[^/]*}]',
            'user',
            null
        );
        $routes->get(
            '/t/{slug}',
            'tag',
            null
        );

        $this->routes['forum'] = new RouteCollectionUrlGenerator(
            'https://example.com',
            $routes
        );
    }
}
