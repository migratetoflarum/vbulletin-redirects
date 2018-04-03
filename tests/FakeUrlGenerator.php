<?php

namespace MigrateToFlarum\VBulletinRedirects\Tests;

use Flarum\Forum\UrlGenerator;
use Flarum\Http\RouteCollection;

class FakeUrlGenerator extends UrlGenerator
{
    public function __construct()
    {
        // do not call parent

        $this->routes = new RouteCollection();

        $this->routes->get(
            '/d/{id:\d+(?:-[^/]*)?}[/{near:[^/]*}]',
            'discussion',
            null
        );
        $this->routes->get(
            '/u/{username}[/{filter:[^/]*}]',
            'user',
            null
        );
        $this->routes->get(
            '/t/{slug}',
            'tag',
            null
        );
    }

    public function toBase()
    {
        return 'https://example.com';
    }
}