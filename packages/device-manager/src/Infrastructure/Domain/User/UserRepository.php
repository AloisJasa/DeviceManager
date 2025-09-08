<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Infrastructure\Domain\User;

use AloisJasa\DeviceManager\Domain\User\Exception\UserNotFoundException;
use AloisJasa\DeviceManager\Domain\User\User;
use AloisJasa\DeviceManager\Domain\User\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * @extends EntityRepository<User>
 */
class UserRepository extends EntityRepository implements \AloisJasa\DeviceManager\Domain\User\UserRepository
{
	public function __construct(EntityManagerInterface $em)
	{
		parent::__construct($em, $em->getClassMetadata(User::class));
	}


	public function add(User $user): void
	{
		$this->getEntityManager()->persist($user);
	}


	public function get(UserId $userId): User
	{
		return $this->find($userId) ?? throw new UserNotFoundException($userId);
	}
}
