<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\User;

use AloisJasa\DeviceManager\Domain\User\UserId;
use AloisJasa\DeviceManager\Domain\User\UserRepository;

readonly class GetUserCase
{
	public function __construct(
		private UserRepository $userRepository,
	)
	{
	}


	public function execute(string $id): UserResponse
	{
		$user = $this->userRepository->get(new UserId($id));

		return UserResponse::create($user);
	}
}
