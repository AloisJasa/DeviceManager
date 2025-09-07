<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\User;

class User
{
	public function __construct(
		private UserId $id,
		private string $firstName,
		private string $lastName,
	)
	{
	}


	public function getId(): UserId
	{
		return $this->id;
	}


	public function getFirstName(): string
	{
		return $this->firstName;
	}


	public function getLastName(): string
	{
		return $this->lastName;
	}
}
