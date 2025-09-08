<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Resources\PingHandler;
use Mezzio\Application;

if (isset($mezzioApplication)) {
}

return static function (Application $app): void {
	$app->get('/ping', PingHandler::class, PingHandler::class);
};
