<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device\Specification;

use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use Happyr\DoctrineSpecification\Filter\In;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class FilterByIds extends BaseSpecification
{
	/**
	 * @var DeviceId[]
	 */
	private array $deviceIds;


	public function __construct(
		DeviceId ...$deviceIds,
	)
	{
		parent::__construct(null);
		$this->deviceIds = $deviceIds;
	}


	protected function getSpec(): In
	{
		return Spec::in('id', $this->deviceIds);
	}
}
