<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Delivery\RestAPI\MezzioBridge;

use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterStack;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Laminas\Stratigility\MiddlewarePipe;
use Mezzio\Middleware\ErrorResponseGenerator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

readonly class RequestHandlerRunnerFactory
{
	public function __construct(
		private MiddlewarePipe $middlewarePipe,
	)
	{
	}


	public function create(): RequestHandlerRunner
	{
		$emitter = $this->createEmitter();

		return new RequestHandlerRunner(
			$this->middlewarePipe,
			$emitter,
			static fn (): ServerRequestInterface => ServerRequestFactory::fromGlobals(),
			static function (Throwable $e): ResponseInterface {
				$generator = new ErrorResponseGenerator();

				return $generator($e, new ServerRequest(), new Response());
			},
		);
	}


	/**
	 * @return EmitterStack<EmitterInterface>
	 */
	private function createEmitter(): EmitterStack
	{
		$stack = new EmitterStack();
		$stack->push(new SapiEmitter());

		return $stack;
	}
}
