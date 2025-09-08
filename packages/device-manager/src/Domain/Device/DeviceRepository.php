<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device;

use AloisJasa\DeviceManager\Domain\Device\Exception\DeviceNotFoundException;

interface DeviceRepository
{
	public function add(Device $device): void;


	/**
	 * @throws DeviceNotFoundException
	 */
	public function get(DeviceId $deviceId): Device;
}
