<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device\Exception;

use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Exception\NotFoundException;
use Throwable;

class DeviceNotFoundException extends NotFoundException
{
	public function __construct(DeviceId $deviceId, Throwable $previous = null)
	{
		parent::__construct(
			sprintf('Device id="%s" not found.', $deviceId->value),
			$previous,
		);
	}
}
