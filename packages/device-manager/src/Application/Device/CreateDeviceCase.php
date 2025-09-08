<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\Device;

use AloisJasa\DeviceManager\Domain\Device\Device;
use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Device\DeviceOS;
use AloisJasa\DeviceManager\Domain\Device\DeviceRepository;
use AloisJasa\DeviceManager\Domain\Device\DeviceType;
use AloisJasa\DeviceManager\Domain\User\UserId;
use AloisJasa\DeviceManager\Domain\User\UserRepository;

readonly class CreateDeviceCase
{
	public function __construct(
		private DeviceRepository $deviceRepository,
		private UserRepository $userRepository,
	)
	{
	}


	public function execute(
		string $userId,
		string $hostname,
		string $type,
		string $os,
	): DeviceResponse
	{
		$user = $this->userRepository->get(new UserId($userId));

		$device = new Device(
			DeviceId::createWithUuid4(),
			$hostname,
			DeviceType::from($type),
			DeviceOS::from($os),
			$user,
		);

		$this->deviceRepository->add($device);

		return DeviceResponse::create($device);
	}
}
