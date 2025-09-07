<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Tests\Unit\Domain\Identity;

use AloisJasa\DeviceManager\Domain\Identity\Exception\InvalidIdentityValueException;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class IdentityTest extends TestCase
{
	#[DataProvider('validIdentityDataProvider')]
	public function testValidIdentity(string $newId): void
	{
		Assert::assertSame($newId, (new TestId($newId))->value);
	}


	/**
	 * @return list<string[]>
	 */
	public static function validIdentityDataProvider(): array
	{
		return [
			['a-zA-Z0-9-_.'],
			['456789'],
			['c7d00731-38ae-4c12-a1e5-3aed2f9bfdf7'],
		];
	}


	#[DataProvider('invalidIdentityDataProvider')]
	public function testInvalidIdentity(string $newId): void
	{
		$this->expectException(InvalidIdentityValueException::class);
		new TestId($newId);
	}


	/**
	 * @return list<string[]>
	 */
	public static function invalidIdentityDataProvider(): array
	{
		return [
			[''],
			[' '],
			["\n"],
			["\t"],
			["\r"],
		];
	}


	public function testCreateMethod(): void
	{
		$identity = TestId::createWithUuid4();
		Assert::assertInstanceOf(TestId::class, $identity); // @phpstan-ignore-line
		Assert::assertTrue(Uuid::isValid($identity->value));
	}
}
