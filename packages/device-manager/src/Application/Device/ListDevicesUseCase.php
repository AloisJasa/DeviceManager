<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Application\Device;

use AloisJasa\DeviceManager\Domain\Device\DeviceRepository;
use AloisJasa\DeviceManager\Domain\Device\Specification\DeviceFilter;

readonly class ListDevicesUseCase
{
	public function __construct(
		private DeviceRepository $deviceRepository,
	)
	{
	}


	public function execute(
		?int $limit,
		?int $offset,
	): DeviceCollectionResponse
	{
		$filter = new DeviceFilter();
		if ($limit !== null || $offset !== null) {
			$filter = $filter->paginate($limit ?? 100, $offset ?? 0);
		}

		$devices = $this->deviceRepository->query($filter);

		return DeviceCollectionResponse::create($devices);
	}
}
