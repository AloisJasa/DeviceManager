<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Exception;

use LogicException;
use Throwable;

class ApplicationException extends LogicException
{
	public function __construct(
		string $message,
		private readonly int $httpCode,
		Throwable $previous = null,
	)
	{
		parent::__construct($message, 0, $previous);
	}


	public function getHttpCode(): int
	{
		return $this->httpCode;
	}
}
