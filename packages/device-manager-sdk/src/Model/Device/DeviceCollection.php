<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model\Device;

use AloisJasa\DeviceManagerSDK\Model\ResponseTrait;

readonly class DeviceCollection
{
	use ResponseTrait;


	/** @var Device[] */
	public array $items;


	public function __construct(
		public int $totalCount,
		Device ...$devices,
	)
	{
		$this->items = $devices;
	}


	/**
	 * @param array<mixed> $data
	 */
	public static function createFromArray(array $data): self
	{
		return new self(
			$data['totalCount'],
			...array_map(
				static fn (array $deviceData): Device => Device::createFromArray($deviceData),
				$data['items'],
			),
		);
	}
}
