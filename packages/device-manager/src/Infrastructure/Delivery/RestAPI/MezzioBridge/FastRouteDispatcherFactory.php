<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\MezzioBridge;

use FastRoute\Dispatcher;
use FastRoute\Dispatcher\GroupPosBased;
use Psr\Container\ContainerInterface;

readonly class FastRouteDispatcherFactory
{
	public function create(ContainerInterface $container): callable
	{
		return static fn (array $data): Dispatcher => new GroupPosBased($data);
	}
}
