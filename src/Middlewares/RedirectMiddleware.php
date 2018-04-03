<?php

namespace MigrateToFlarum\VBulletinRedirects\Middlewares;

use Flarum\Http\Exception\RouteNotFoundException;
use Flarum\Settings\SettingsRepositoryInterface;
use MigrateToFlarum\VBulletinRedirects\Redirector;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class RedirectMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        try {
            $response = $out($request, $response);
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

                $status = $settings->get('migratetoflarum-vbulletin-redirects.redirectStatus', 302);

                return $response->withStatus($status)->withHeader('Location', $to);
            }

            throw $exception;
        }

        return $response;
    }
}
