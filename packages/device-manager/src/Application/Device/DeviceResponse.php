<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\Device;

use AloisJasa\DeviceManager\Application\User\UserResponse;
use AloisJasa\DeviceManager\Domain\Device\Device;
use JsonSerializable;

readonly class DeviceResponse implements JsonSerializable
{
	public function __construct(
		public string $id,
		public string $hostname,
		public string $type,
		public string $os,
		public UserResponse $owner,
	)
	{
	}


	public static function create(Device $device): self
	{
		return new self(
			$device->getId()->value,
			$device->getHostname(),
			$device->getType()->value,
			$device->getOs()->value,
			UserResponse::create($device->getOwner()),
		);
	}


	/**
	 * @return array{id: string, hostname: string, type: string, os: string, owner: UserResponse}
	 */
	public function jsonSerialize(): array
	{
		return [
			'id' => $this->id,
			'hostname' => $this->hostname,
			'type' => $this->type,
			'os' => $this->os,
			'owner' => $this->owner,
		];
	}
}
