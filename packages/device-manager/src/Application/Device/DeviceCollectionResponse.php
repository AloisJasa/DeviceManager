<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\Device;

use AloisJasa\DeviceManager\Domain\Device\Device;
use AloisJasa\DeviceManager\Domain\Device\DeviceCollection;
use JsonSerializable;

readonly class DeviceCollectionResponse implements JsonSerializable
{
	/**
	 * @var DeviceResponse[]
	 */
	public array $devices;


	public function __construct(
		public int $totalCount,
		DeviceResponse ...$devices,
	)
	{
		$this->devices = $devices;
	}


	public static function create(DeviceCollection $collection): self
	{
		return new self(
			$collection->totalCount,
			...array_map(
				static fn (Device $device): DeviceResponse => DeviceResponse::create($device),
				$collection->getDevices(),
			),
		);
	}


	/**
	 * @return array{totalCount: int, items: DeviceResponse[]}
	 */
	public function jsonSerialize(): array
	{
		return [
			'totalCount' => $this->totalCount,
			'items' => $this->devices,
		];
	}
}
