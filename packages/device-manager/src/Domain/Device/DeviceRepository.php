<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device;

use AloisJasa\DeviceManager\Domain\Device\Exception\DeviceNotFoundException;
use Happyr\DoctrineSpecification\Specification\Specification;

interface DeviceRepository
{
	public function add(Device $device): void;


	/**
	 * @throws DeviceNotFoundException
	 */
	public function get(DeviceId $deviceId): Device;


	public function query(Specification $specification): DeviceCollection;
}
