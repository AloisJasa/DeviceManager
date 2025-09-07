<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Identity\Exception;

use AloisJasa\DeviceManager\Domain\Exception\DomainException;
use AloisJasa\DeviceManager\Domain\Identity\Identity;
use Throwable;

class InvalidIdentityValueException extends DomainException
{
	public function __construct(string $value, Throwable $previous = null)
	{
		$validationPattern = Identity::FORMAT_PATTERN;

		parent::__construct(
			sprintf('Value should follow pattern %s, given %s.', $validationPattern, $value),
			previous: $previous,
		);
	}
}
