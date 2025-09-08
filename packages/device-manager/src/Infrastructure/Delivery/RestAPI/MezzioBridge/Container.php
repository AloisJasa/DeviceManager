<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\MezzioBridge;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
	public function __construct(
		private readonly \Nette\DI\Container $container,
	)
	{
	}


	public function get(string $id): ?object
	{
		return class_exists($id) ? $this->container->getByType($id) : $this->container->getService($id);
	}


	public function has(string $id): bool
	{
		if (class_exists($id)) {
			return (bool) $this->container->getByType($id, false);
		}

		return $this->container->hasService($id);
	}
}
