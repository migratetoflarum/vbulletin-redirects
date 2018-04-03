<?php

namespace MigrateToFlarum\VBulletinRedirects\Tests;

use Flarum\Core\Discussion;
use Flarum\Core\User;
use Flarum\Database\AbstractModel;
use Flarum\Tags\Tag;
use Illuminate\Events\Dispatcher;
use MigrateToFlarum\VBulletinRedirects\Repository;

class FakeRepository extends Repository
{
    public function __construct()
    {
        // do not call parent

        // Set a no-op dispatcher so we can call new Model()
        if (!AbstractModel::getEventDispatcher()) {
            AbstractModel::setEventDispatcher(new Dispatcher());
        }
    }

    public function discussion(int $id = null):? Discussion
    {
        if ($id === 123) {
            return (new Discussion())->forceFill([
                'id' => 123,
                'slug' => 'amazing-discussion',
            ]);
        }

        return null;
    }

    public function user(int $id = null):? User
    {
        if ($id === 5) {
            return (new User())->forceFill([
                'username' => 'amazing-user',
            ]);
        }

        return null;
    }

    public function tag(int $id = null):? Tag
    {
        if ($id === 2) {
            return (new Tag())->forceFill([
                'slug' => 'amazing-tag',
            ]);
        }

        return null;
    }
}
