<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Domain\Device;

use AloisJasa\DeviceManager\Domain\Device\Device;
use AloisJasa\DeviceManager\Domain\Device\DeviceCollection;
use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Device\Exception\DeviceNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use Happyr\DoctrineSpecification\Specification\Specification;
use Traversable;

/**
 * @extends EntitySpecificationRepository<Device>
 */
class DeviceRepository extends EntitySpecificationRepository implements \AloisJasa\DeviceManager\Domain\Device\DeviceRepository
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


	public function query(Specification $specification): DeviceCollection
	{
		$query = $this->getQuery($specification);

		$paginator = new Paginator($query);

		/** @var Traversable<int, Device> $iterator */
		$iterator = $paginator->getIterator();

		return new DeviceCollection(
			$paginator->count(),
			...iterator_to_array($iterator, true),
		);
	}
}
