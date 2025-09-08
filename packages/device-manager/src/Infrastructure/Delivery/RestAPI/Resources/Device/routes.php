<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device\CreateDeviceHandler;
use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device\GetDeviceHandler;
use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\Device\ListDevicesHandler;
use Mezzio\Application;

return static function (Application $mezzioApplication): void {
	$mezzioApplication->get(
		'/devices/{deviceId}',
		[
			GetDeviceHandler::class,
		],
		GetDeviceHandler::class,
	);
	$mezzioApplication->get(
		'/devices',
		[
			ListDevicesHandler::class,
		],
		ListDevicesHandler::class,
	);
	$mezzioApplication->post(
		'/devices',
		[
			CreateDeviceHandler::class,
		],
		CreateDeviceHandler::class,
	);
};
