<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Middleware;

use AloisJasa\DeviceManager\Domain\Exception\DomainException;
use AloisJasa\DeviceManager\Domain\Exception\NotFoundException;
use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Exception\ApplicationException;
use Laminas\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DomainExceptionMiddleware implements MiddlewareInterface
{
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
	{
		try {
			return $handler->handle($request);
		} catch (NotFoundException $e) {
			throw new ApplicationException(
				$e->getMessage(),
				Response::STATUS_CODE_404,
				previous: $e,
			);
		} catch (DomainException $e) {
			throw new ApplicationException(
				$e->getMessage(),
				Response::STATUS_CODE_412,
				previous: $e,
			);
		}
	}
}
