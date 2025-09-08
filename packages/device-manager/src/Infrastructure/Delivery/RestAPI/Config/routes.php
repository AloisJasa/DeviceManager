<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\PingHandler;
use Mezzio\Application;

if (isset($mezzioApplication) && $mezzioApplication instanceof Application) {

	/** @var Closure(Application): void $deviceRoutes */
	$deviceRoutes = require __DIR__ . '/../Resources/Device/routes.php';
	$deviceRoutes($mezzioApplication);

	/** @var Closure(Application): void $userRoutes */
	$userRoutes = require __DIR__ . '/../Resources/User/routes.php';
	$userRoutes($mezzioApplication);
}

return static function (Application $mezzioApplication): void {
	$mezzioApplication->get('/ping', PingHandler::class, PingHandler::class);
};
