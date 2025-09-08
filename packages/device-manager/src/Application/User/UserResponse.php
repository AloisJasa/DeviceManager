<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\User;

use AloisJasa\DeviceManager\Domain\User\User;
use JsonSerializable;

readonly class UserResponse implements JsonSerializable
{
	public function __construct(
		public string $id,
		public string $firstName,
		public string $lastName,
	)
	{
	}


	public static function create(User $user): self
	{
		return new self(
			$user->getId()->value,
			$user->getFirstName(),
			$user->getLastName(),
		);
	}


	/**
	 * @return array{id: string, firstName: string, lastName: string}
	 */
	public function jsonSerialize(): array
	{
		return [
			'id' => $this->id,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
		];
	}
}
