<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device\CreateDeviceHandler;
use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device\GetDeviceHandler;
use Mezzio\Application;

return static function (Application $mezzioApplication): void {
	$mezzioApplication->get(
		'/devices/{deviceId}',
		[
			GetDeviceHandler::class,
		],
		GetDeviceHandler::class,
	);
	$mezzioApplication->post(
		'/devices',
		[
			CreateDeviceHandler::class,
		],
		CreateDeviceHandler::class,
	);
};
