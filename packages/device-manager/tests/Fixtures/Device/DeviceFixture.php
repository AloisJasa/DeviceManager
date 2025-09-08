<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Tests\Fixtures\Device;

use AloisJasa\DeviceManager\Domain\Device\Device;
use AloisJasa\DeviceManager\Domain\Device\DeviceId;
use AloisJasa\DeviceManager\Domain\Device\DeviceOS;
use AloisJasa\DeviceManager\Domain\Device\DeviceType;
use AloisJasa\DeviceManager\Domain\User\User;
use AloisJasa\DeviceManager\Tests\Fixtures\User\UserFixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DeviceFixture extends AbstractFixture implements DependentFixtureInterface
{
	public function load(ObjectManager $manager): void
	{
		/** @var User $user */
		$user = $this->getReference(UserFixture::USER_ID_REFERENCE);

		$mobile = new Device(
			DeviceId::createWithUuid4(),
			'Viktor\'s iPhone',
			DeviceType::SMARTPHONE,
			DeviceOS::IOS,
			$user,
		);

		$pc = new Device(
			DeviceId::createWithUuid4(),
			'Viktor\'s MacBookPro',
			DeviceType::PC,
			DeviceOS::MACOS,
			$user,
		);

		$manager->persist($mobile);
		$manager->persist($pc);
		$manager->flush();
	}


	/**
	 * @return list<class-string<FixtureInterface>>
	 */
	public function getDependencies(): array
	{
		return [
			UserFixture::class,
		];
	}
}
