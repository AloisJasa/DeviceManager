<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\User\GetUserHandler;
use Mezzio\Application;

return static function (Application $mezzioApplication): void {
	$mezzioApplication->get(
		'/users/{userId}',
		[
			GetUserHandler::class,
		],
		GetUserHandler::class,
	);
};
