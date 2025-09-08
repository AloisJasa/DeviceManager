<?php declare(strict_types = 1);

use AloisJasa\DeviceManager\Bootstrap;
use Mezzio\Application;

require __DIR__ . '/../../../vendor/autoload.php';

$bootstrap = Bootstrap::boot();

$container = $bootstrap->createContainer();

/** @var Application $mezzioApplication */
$mezzioApplication = $container->getByType(Application::class);

/** @var Closure(Application): void $configurePipeline */
$configurePipeline = require __DIR__ . '/../src/Infrastructure/Delivery/RestAPI/Config/pipeline.php';
$configurePipeline($mezzioApplication);

/** @var Closure(Application): void $configureRoutes */
$configureRoutes = require __DIR__ . '/../src/Infrastructure/Delivery/RestAPI/Config/routes.php';
$configureRoutes($mezzioApplication);


$mezzioApplication->run();
