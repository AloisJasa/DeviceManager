<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Tests\Unit\Model\Device;

use AloisJasa\DeviceManagerSDK\Model\Device\Device;
use AloisJasa\DeviceManagerSDK\Model\Device\DeviceCollection;
use AloisJasa\DeviceManagerSDK\Model\Device\DeviceOS;
use AloisJasa\DeviceManagerSDK\Model\Device\DeviceType;
use AloisJasa\DeviceManagerSDK\Model\User\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class DeviceCollectionTest extends TestCase
{
	public function testCreate(): void
	{
		$payload = [
			'totalCount' => 3,
			'items' => [
				[
					'id' => 'device-1',
					'hostname' => 'Device 1',
					'type' => 'pc',
					'os' => 'macOS',
					'owner' => [
						'id' => 'owner-1',
						'firstName' => 'Owner 1',
						'lastName' => 'Last Name',
					],
				],
				[
					'id' => 'device-2',
					'hostname' => 'Device 2',
					'type' => 'tablet',
					'os' => 'iOS',
					'owner' => [
						'id' => 'owner-2',
						'firstName' => 'Owner 2',
						'lastName' => 'Last Name2',
					],
				],
			],
		];

		$collection = new DeviceCollection(
			3,
			new Device(
				'device-1',
				'Device 1',
				DeviceType::PC,
				DeviceOS::MACOS,
				new User(
					'owner-1',
					'Owner 1',
					'Last Name',
				),
			),
			new Device(
				'device-2',
				'Device 2',
				DeviceType::TABLET,
				DeviceOS::IOS,
				new User(
					'owner-2',
					'Owner 2',
					'Last Name2',
				),
			),
		);

		$collectionFromArray = DeviceCollection::createFromArray($payload);

		Assert::assertEquals($collection, $collectionFromArray);
		Assert::assertSame(3, $collectionFromArray->totalCount);
		Assert::assertCount(2, $collectionFromArray->items);
	}
}
