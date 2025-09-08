<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\User;

use AloisJasa\DeviceManager\Domain\User\Exception\UserNotFoundException;

interface UserRepository
{
	public function add(User $user): void;


	/**
	 * @throws UserNotFoundException
	 */
	public function get(UserId $userId): User;
}
