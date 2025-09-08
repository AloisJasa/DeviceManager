<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model\Device;

use AloisJasa\DeviceManagerSDK\Model\User\User;

readonly class Device
{
	public function __construct(
		public string $id,
		public string $hostname,
		public DeviceType $type,
		public DeviceOS $os,
		public User $owner,
	)
	{
	}


	/**
	 * @param array<mixed> $data
	 */
	public static function createFromArray(array $data): self
	{
		return new self(
			$data['id'],
			$data['hostname'],
			DeviceType::from($data['type']),
			DeviceOS::from($data['os']),
			User::createFromArray($data['owner']),
		);
	}
}
