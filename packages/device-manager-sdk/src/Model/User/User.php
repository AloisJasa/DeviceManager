<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model\User;

readonly class User
{
	public function __construct(
		public string $id,
		public string $firstName,
		public string $lastName,
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
			$data['firstName'],
			$data['lastName'],
		);
	}
}
