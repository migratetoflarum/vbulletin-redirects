<?php

namespace MigrateToFlarum\VBulletinRedirects\Tests;

use MigrateToFlarum\VBulletinRedirects\Redirector;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\Uri;

class RedirectorTest extends TestCase
{
    /**
     * @var $redirector Redirector
     */
    protected $redirector;

    protected function setUp()
    {
        $repository = new FakeRepository();
        $url = new FakeUrlGenerator();

        $this->redirector = new Redirector($repository, $url);
    }

    public function test_discussion_redirect()
    {
        $this->assertEquals('https://example.com/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/showthread.php?123')));
        $this->assertEquals('https://example.com/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/showthread.php?123-Amazing-Discussion')));
        $this->assertEquals('https://example.com/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/showthread.php?123-Amazing-Discussion&s=1234567890')));

        $this->assertEquals('https://example.com/d/234', $this->redirector->redirect(new Uri('https://example.com/showthread.php?234-no-slug-in-flarum')));
        $this->assertEquals('https://example.com/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/subfolder/showthread.php?123')));

        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/showthread.php')));
        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/showthread.php?12-Non-Existing-Thread')));
        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/showthread.php?345-Private-Thread')));
    }

    public function test_user_redirect()
    {
        $this->assertEquals('https://example.com/u/amazing-user', $this->redirector->redirect(new Uri('https://example.com/member.php?5')));
        $this->assertEquals('https://example.com/u/amazing-user', $this->redirector->redirect(new Uri('https://example.com/member.php?5-Amazing-User')));
        $this->assertEquals('https://example.com/u/amazing-user', $this->redirector->redirect(new Uri('https://example.com/member.php?5-Amazing-User&s=1234567890')));

        $this->assertEquals('https://example.com/u/amazing-user', $this->redirector->redirect(new Uri('https://example.com/subfolder/member.php?5')));

        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/member.php')));
        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/member.php?12-Non-Existing-User')));
    }

    public function test_tag_redirect()
    {
        $this->assertEquals('https://example.com/t/amazing-tag', $this->redirector->redirect(new Uri('https://example.com/forumdisplay.php?2')));
        $this->assertEquals('https://example.com/t/amazing-tag', $this->redirector->redirect(new Uri('https://example.com/forumdisplay.php?2-Amazing-Forum')));
        $this->assertEquals('https://example.com/t/amazing-tag', $this->redirector->redirect(new Uri('https://example.com/forumdisplay.php?2-Amazing-Forum&s=1234567890')));

        $this->assertEquals('https://example.com/t/amazing-tag', $this->redirector->redirect(new Uri('https://example.com/subfolder/forumdisplay.php?2')));

        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/forumdisplay.php')));
        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/forumdisplay.php?12-Non-Existing-Forum')));
    }

    public function test_home_redirect()
    {
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/activity.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/forum.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/index.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/login.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/register.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/search.php?do=getnew&contenttype=vBForum_Post')));

        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/subfolder/forum.php')));
        $this->assertEquals('https://example.com/', $this->redirector->redirect(new Uri('https://example.com/subfolder/index.php')));

        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/faq.php')));
        $this->assertNull($this->redirector->redirect(new Uri('https://example.com/sendmessage.php')));
    }

    public function test_subfolder()
    {
        $repository = new FakeRepository();
        $url = new FakeUrlGenerator('/sub');
        $this->redirector = new Redirector($repository, $url);

        $this->assertEquals('https://example.com/sub/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/showthread.php?123')));
        $this->assertEquals('https://example.com/sub/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/sub/showthread.php?123')));
        $this->assertEquals('https://example.com/sub/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/incorrect-sub/showthread.php?123')));
        $this->assertEquals('https://example.com/sub/d/123-amazing-discussion', $this->redirector->redirect(new Uri('https://example.com/multiple/sub/showthread.php?123')));
        $this->assertEquals('https://example.com/sub/', $this->redirector->redirect(new Uri('https://example.com/sub/activity.php')));
    }
}
