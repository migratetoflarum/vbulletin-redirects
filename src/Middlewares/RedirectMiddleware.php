<?php

namespace MigrateToFlarum\VBulletinRedirects\Middlewares;

use Exception;
use Flarum\Http\Exception\RouteNotFoundException;
use Flarum\Settings\SettingsRepositoryInterface;
use MigrateToFlarum\VBulletinRedirects\Redirector;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Zend\Diactoros\Response\RedirectResponse;

class RedirectMiddleware implements Middleware
{
    public function process(Request $request, Handler $handler): Response
    {
        try {
            return $handler->handle($request);
        } catch (RouteNotFoundException $exception) {
            /**
             * @var $redirector Redirector
             */
            $redirector = app(Redirector::class);

            $to = $redirector->redirect($request->getUri());

            if ($to) {
                /**
                 * @var $settings SettingsRepositoryInterface
                 */
                $settings = app(SettingsRepositoryInterface::class);

                $status = intval($settings->get('migratetoflarum-vbulletin-redirects.redirectStatus'));

                if (!$status) {
                    // Default redirect type
                    // Not using it as the setting default value as we want to convert an empty string to this value as well
                    $status = 302;
                }

                if (!in_array($status, [301, 302])) {
                    throw new Exception("Invalid vbulletin redirect status code $status");
                }

                return new RedirectResponse($to, $status);
            }

            throw $exception;
        }
    }
}
