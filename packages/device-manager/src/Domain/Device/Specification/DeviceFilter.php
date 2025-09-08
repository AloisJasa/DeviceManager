<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Domain\Device\Specification;

use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use Happyr\DoctrineSpecification\Logic\AndX;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;
use Happyr\DoctrineSpecification\Specification\Specification;

class DeviceFilter extends BaseSpecification
{
	/**
	 * @var array<Specification>
	 */
	private array $conditions;


	public function __construct(
		Specification ...$conditions,
	)
	{
		parent::__construct();
		$this->conditions = $conditions;
	}


	public function filterByIds(DeviceId ...$ids): self
	{
		return $this->withSpec(new FilterByIds(...$ids));
	}


	public function paginate(int $limit, int $offset): self
	{
		return $this->withSpec(new Paginate($offset, $limit));
	}


	protected function withSpec(Specification $spec): self
	{
		return new self(
			...[...$this->conditions, $spec],
		);
	}


	protected function getSpec(): AndX
	{
		return Spec::andX(...$this->conditions);
	}


	public static function create(): self
	{
		return new self();
	}
}
