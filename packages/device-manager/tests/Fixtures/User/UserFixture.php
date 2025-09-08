<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Tests\Fixtures\User;

use AloisJasa\DeviceManager\Domain\User\User;
use AloisJasa\DeviceManager\Domain\User\UserId;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends AbstractFixture
{
	public const string USER_ID = 'd06ccd47-479a-4051-85db-271608f6a465';
	public const string USER_ID_REFERENCE = self::class . self::USER_ID;


	public function load(ObjectManager $manager): void
	{
		$user = new User(
			new UserId(self::USER_ID),
			'Viktor',
			'Bone',
		);

		$this->addReference(self::USER_ID_REFERENCE, $user);
		$manager->persist($user);
		$manager->flush();
	}
}
