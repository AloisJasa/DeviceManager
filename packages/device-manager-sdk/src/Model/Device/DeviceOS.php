<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model\Device;

enum DeviceOS: string
{
	case LINUX = 'linux';
	case WINDOWS = 'windows';
	case MACOS = 'macOS';
	case IOS = 'iOS';
	case ANDROID = 'android';
	case OTHER = 'other';
}
