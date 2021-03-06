<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Register application-wide error handler for custom error-page templates.
 */
class ErrorPageHandlerProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app)
    {
        if (!$app instanceof Application) {
            return;
        }
        $app->error(function (\Exception $e, Request $request, $code) use ($app) {
            if ($app['debug']) {
                return null;
            }
            // E.g. looks for 404.html, or 40x.html, or 4xx.html, or default.html
            $templates = [
                'errors/' . $code . '.html.twig',
                'errors/' . substr($code, 0, 2) . 'x.html.twig',
                'errors/' . substr($code, 0, 1) . 'xx.html.twig',
                'errors/default.html.twig',
            ];
            return new Response(
                $app->getTwigService()
                    ->resolveTemplate($templates)
                    ->render([
                        'error_code' => $code,
                        'exception_message' => $e->getMessage(),
                    ]),
                $code
            );
        });
    }
}
