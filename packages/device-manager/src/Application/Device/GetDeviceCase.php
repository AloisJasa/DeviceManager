<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\Device;

use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Device\DeviceRepository;

readonly class GetDeviceCase
{
	public function __construct(
		private DeviceRepository $deviceRepository,
	)
	{
	}


	public function execute(string $id): DeviceResponse
	{
		$device = $this->deviceRepository->get(new DeviceId($id));

		return DeviceResponse::create($device);
	}
}
