<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Identity;

use AloisJasa\DeviceManager\Domain\Identity\Exception\InvalidIdentityValueException;
use Ramsey\Uuid\Uuid;
use Stringable;

abstract class Identity implements Stringable
{
	public const string FORMAT_PATTERN = '/^[a-zA-Z0-9-_.]+$/';


	final public function __construct(
		public readonly string $value,
	)
	{
		if ( ! $this->isValid($value)) {
			throw new InvalidIdentityValueException($value);
		}
	}


	private function isValid(string $name): bool
	{
		return preg_match(self::FORMAT_PATTERN, $name) === 1;
	}


	public static function createWithUuid4(): static
	{
		return new static(
			Uuid::uuid4()->toString(),
		);
	}


	public function __toString(): string
	{
		return $this->value;
	}
}
