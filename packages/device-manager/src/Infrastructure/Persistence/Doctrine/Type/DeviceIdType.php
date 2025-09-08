<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Persistence\Doctrine\Type;

use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Infrastructure\Persistence\Doctrine\Exception\InvalidMappingTypeException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class DeviceIdType extends Type
{
	public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
	{
		return $platform->getStringTypeDeclarationSQL($column);
	}


	public function convertToDatabaseValue($value, AbstractPlatform $platform): string
	{
		if ($value instanceof DeviceId) {
			return $value->value;
		}

		throw new InvalidMappingTypeException();
	}


	public function convertToPHPValue($value, AbstractPlatform $platform): DeviceId
	{
		if (is_string($value)) {
			return new DeviceId($value);
		}

		throw new InvalidMappingTypeException();
	}


	public function getName(): string
	{
		return 'deviceManager.device.deviceId';
	}
}
