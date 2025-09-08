<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Domain\Device;

use AloisJasa\DeviceManager\Domain\Device\Device;
use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Device\Exception\DeviceNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<Device>
 */
class DeviceRepository extends EntityRepository implements \AloisJasa\DeviceManager\Domain\Device\DeviceRepository
{
	public function __construct(EntityManagerInterface $em)
	{
		parent::__construct($em, $em->getClassMetadata(Device::class));
	}


	public function add(Device $device): void
	{
		$this->getEntityManager()->persist($device);
	}


	public function get(DeviceId $deviceId): Device
	{
		return $this->find($deviceId) ?? throw new DeviceNotFoundException($deviceId);
	}
}
