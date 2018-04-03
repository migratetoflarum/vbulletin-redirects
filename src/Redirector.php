<?php

namespace MigrateToFlarum\VBulletinRedirects;

use Flarum\Forum\UrlGenerator;
use Psr\Http\Message\UriInterface;

class Redirector
{
    protected $repository;
    protected $url;

    public function __construct(Repository $repository, UrlGenerator $url)
    {
        $this->repository = $repository;
        $this->url = $url;
    }

    public function redirect(UriInterface $uri):? string
    {
        switch ($uri->getPath()) {
            case '/showthread.php':
                return $this->redirectDiscussion($uri);
            case '/member.php':
                return $this->redirectUser($uri);
            case '/forumdisplay.php':
                return $this->redirectTag($uri);
            case '/activity.php':
            case '/forum.php':
            case '/login.php':
            case '/register.php':
            case '/search.php':
                return $this->url->toPath('');
        }

        return null;
    }

    protected function idFromQueryString(UriInterface $uri):? int
    {
        if (preg_match('~^([0-9]+)~', $uri->getQuery(), $matches) === 1) {
            return intval($matches[1]);
        }

        return null;
    }

    protected function redirectDiscussion(UriInterface $uri):? string
    {
        $discussion = $this->repository->discussion($this->idFromQueryString($uri));

        if (!$discussion || $discussion->is_private) {
            return null;
        }

        $discussionIdentifier = $discussion->id;

        if ($discussion->slug) {
            $discussionIdentifier .= '-' . $discussion->slug;
        }

        return $this->url->toRoute('discussion', ['id' => $discussionIdentifier]);
    }

    protected function redirectUser(UriInterface $uri):? string
    {
        $user = $this->repository->user($this->idFromQueryString($uri));

        if (!$user) {
            return null;
        }

        return $this->url->toRoute('user', ['username' => $user->username]);
    }

    protected function redirectTag(UriInterface $uri):? string
    {
        $tag = $this->repository->tag($this->idFromQueryString($uri));

        if (!$tag) {
            return null;
        }

        return $this->url->toRoute('tag', ['slug' => $tag->slug]);
    }
}
