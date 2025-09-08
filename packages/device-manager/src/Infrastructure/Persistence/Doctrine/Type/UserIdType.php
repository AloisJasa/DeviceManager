<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Persistence\Doctrine\Type;

use AloisJasa\DeviceManager\Domain\User\UserId;
use AloisJasa\DeviceManager\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class UserIdType extends Type
{
	public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
	{
		return $platform->getStringTypeDeclarationSQL($column);
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform): string
	{
		if ($value instanceof UserId) {
			return $value->value;
		}

		throw new InvalidMappingTypeException();
	}


	public function convertToPHPValue($value, AbstractPlatform $platform): UserId
	{
		if (is_string($value)) {
			return new UserId($value);
		}

		throw new InvalidMappingTypeException();
	}


	public function getName(): string
	{
		return 'deviceManager.user.userId';
	}
}
