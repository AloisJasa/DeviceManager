<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManagerSDK\Model\Device;

enum DeviceType: string
{
	case PC = 'pc';
	case LAPTOP = 'laptop';
	case TABLET = 'tablet';
	case SMARTPHONE = 'smartphone';
	case SERVER = 'server';
	case ROUTER = 'router';
	case SWITCH = 'switch';
	case PRINTER = 'printer';
	case OTHER = 'other';
}
