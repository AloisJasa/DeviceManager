<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device;

use AloisJasa\DeviceManager\Domain\User\User;

class Device
{
	public function __construct(
		private DeviceId $id,
		private string $hostname,
		private DeviceType $type,
		private DeviceOS $os,
		private User $owner,
	)
	{
	}


	public function changeHostname(string $hostname): void
	{
		$this->hostname = $hostname;
	}


	public function getId(): DeviceId
	{
		return $this->id;
	}


	public function getHostname(): string
	{
		return $this->hostname;
	}


	public function getType(): DeviceType
	{
		return $this->type;
	}


	public function getOs(): DeviceOS
	{
		return $this->os;
	}


	public function getOwner(): User
	{
		return $this->owner;
	}
}
