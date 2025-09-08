<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Resources;

use GuzzleHttp\Psr7\Request;

class ListDevicesRequest extends Request
{
	public function __construct(
		?int $limit = null,
		?int $offset = null,
	)
	{
		$queryParams = array_filter([
			'limit' => $limit,
			'offset' => $offset,
		], static function (?int $x): bool {
			return $x !== null;
		});

		parent::__construct(
			'GET',
			sprintf('%s?%s', 'devices', http_build_query($queryParams)),
		);
	}
}
