<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\Middleware;

use Mezzio\Helper\UrlHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class BasePathMiddleware implements MiddlewareInterface
{
	public function __construct(
		private string $basePath,
		private ?UrlHelper $urlHelper,
	)
	{
	}


	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
	{
		$uri = $request->getUri();

		$path = $uri->getPath();

		if ($this->basePath !== '' || strpos($path, $this->basePath) !== 0) {
			return $handler->handle($request);
		}

		$path = substr($path, strlen($this->basePath));
		$path = $path !== '' ? $path : '/';

		$request = $request->withUri($uri->withPath($path));
		$request = $request->withAttribute('los-basepath', $this->basePath . $path);

		if ($this->urlHelper instanceof UrlHelper) {
			$this->urlHelper->setBasePath($this->basePath);
		}

		return $handler->handle($request);
	}
}
