<?php

namespace MigrateToFlarum\VBulletinRedirects;

use Flarum\Core\Discussion;
use Flarum\Core\User;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Tags\Tag;

class Repository
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    protected function idWithIncrement(string $model, int $id = null)
    {
        if (!is_null($id) && $increment = intval($this->settings->get('migratetoflarum-vbulletin-redirects.' . $model . 'Increment'))) {
            $id += $increment;
        }

        return $id;
    }

    public function discussion(int $id = null):? Discussion
    {
        $id = $this->idWithIncrement('discussion', $id);

        if (!$id) {
            return null;
        }

        return Discussion::find($id);
    }

    public function user(int $id = null):? User
    {
        $id = $this->idWithIncrement('user', $id);

        if (!$id) {
            return null;
        }

        return User::find($id);
    }

    public function tag(int $id = null):? Tag
    {
        $id = $this->idWithIncrement('tag', $id);

        if (!$id) {
            return null;
        }

        return Tag::find($id);
    }
}
