<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device\Specification;

use Happyr\DoctrineSpecification\Logic\AndX;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class Paginate extends BaseSpecification
{
	private int $offset;

	private int $limit;


	public function __construct(
		int $offset,
		int $limit,
		?string $context = null,
	)
	{
		parent::__construct($context);
		$this->offset = $offset;
		$this->limit = $limit;
	}


	protected function getSpec(): AndX
	{
		return Spec::andX(Spec::limit($this->limit), Spec::offset($this->offset));
	}
}
