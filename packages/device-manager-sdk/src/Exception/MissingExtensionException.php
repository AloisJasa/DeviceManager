<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Exception;

use Exception;
use Throwable;

class MissingExtensionException extends Exception
{
	public function __construct(string $extensionName, Throwable $previous = null)
	{
		parent::__construct(
			sprintf('Missing extension %s', $extensionName),
			0,
			$previous,
		);
	}
}
