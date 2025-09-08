<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int, Device>
 */
class DeviceCollection implements IteratorAggregate, Countable
{
	/**
	 * @var Device[]
	 */
	private array $devices;


	public function __construct(
		public readonly int $totalCount,
		Device ...$devices,
	)
	{
		$this->devices = $devices;
	}


	/**
	 * @return Device[]
	 */
	public function getDevices(): array
	{
		return $this->devices;
	}


	/**
	 * @return ArrayIterator<int, Device>
	 */
	public function getIterator(): ArrayIterator
	{
		return new ArrayIterator($this->devices);
	}


	public function count(): int
	{
		return count($this->devices);
	}
}
