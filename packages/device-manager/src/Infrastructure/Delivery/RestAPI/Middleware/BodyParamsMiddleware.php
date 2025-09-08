<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Middleware;

use Mezzio\Helper\BodyParams\JsonStrategy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BodyParamsMiddleware implements MiddlewareInterface
{
	public function process(
		ServerRequestInterface $request,
		RequestHandlerInterface $handler,
	): ResponseInterface
	{
		$bodyParamsMiddleware = new \Mezzio\Helper\BodyParams\BodyParamsMiddleware();

		$bodyParamsMiddleware->clearStrategies();
		$bodyParamsMiddleware->addStrategy(new JsonStrategy());

		return  $bodyParamsMiddleware->process($request, $handler);
	}
}
