<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Persistence\Doctrine\Exception;

use RuntimeException;
use Throwable;

class InvalidMappingTypeException extends RuntimeException
{
	public function __construct(string $message = '', Throwable $previous = null)
	{
		parent::__construct($message, 0, $previous);
	}
}
