<?php
namespace App\Modules\Index;

use App\Controllers\Index\Home;
use App\Core\Server\Router;
use App\Core\Framework\Abstracts\Module;
use App\Core\Framework\Classes\ResourceManager;

class Index_Module extends Module
{
	static function registerRoutes()
	{
		Router::getInstance()->addRoute('/dotdager/', Home::class);
		Router::getInstance()->addRoute('/dotdager/public/{version}/{@resource}', ResourceManager::class);
		Router::getInstance()->addRoute('/dotdager/favicon.ico', [Home::class,'favicon']);
	}

	static function getFallback()
	{
		//TODO: implement fallback function
	}
}