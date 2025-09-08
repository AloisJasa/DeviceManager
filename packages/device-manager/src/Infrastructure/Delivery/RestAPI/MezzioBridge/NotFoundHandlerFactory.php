<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\MezzioBridge;

use Laminas\Diactoros\Response;
use Mezzio\Handler\NotFoundHandler;

class NotFoundHandlerFactory
{
	public function create(): NotFoundHandler
	{
		return new NotFoundHandler(
			static fn (): Response => new Response(),
		);
	}
}
