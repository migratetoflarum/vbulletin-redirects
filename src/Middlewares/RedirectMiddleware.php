<?php

namespace MigrateToFlarum\VBulletinRedirects\Middlewares;

use Exception;
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

                $status = intval($settings->get('migratetoflarum-vbulletin-redirects.redirectStatus'));

                if (!$status) {
                    // Default redirect type
                    // Not using it as the setting default value as we want to convert an empty string to this value as well
                    $status = 302;
                }

                if (!in_array($status, [301, 302])) {
                    throw new Exception("Invalid vbulletin redirect status code $status");
                }

                return $response->withStatus($status)->withHeader('Location', $to);
            }

            throw $exception;
        }

        return $response;
    }
}
