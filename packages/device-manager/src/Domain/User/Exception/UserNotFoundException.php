<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\User\Exception;

use AloisJasa\DeviceManager\Domain\Exception\NotFoundException;
use AloisJasa\DeviceManager\Domain\User\UserId;
use Throwable;

class UserNotFoundException extends NotFoundException
{
	public function __construct(UserId $userId, Throwable $previous = null)
	{
		parent::__construct(
			sprintf('User id="%s" not found.', $userId->value),
			$previous,
		);
	}
}
