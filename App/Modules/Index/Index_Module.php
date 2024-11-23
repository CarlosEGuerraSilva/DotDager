<?php
namespace App\Modules\Index;

use App\Controllers\Index\Home;
use App\Core\Application\Configuration;
use App\Core\Server\Router;
use App\Core\Framework\Abstracts\Module;
use App\Core\Framework\Classes\ResourceManager;

class Index_Module extends Module
{
	static function registerRoutes()
	{
		if (Configuration::LOCAL_ENVIRONMENT) {
			Router::getInstance()->addRoute('/', Home::class);
			Router::getInstance()->addRoute('/public/{version}/{@resource}', ResourceManager::class);
			Router::getInstance()->addRoute('/favicon.ico', [Home::class, 'favicon']);
			Router::getInstance()->addRoute('/en', [Home::class, 'langEn']);
			Router::getInstance()->addRoute('/es', [Home::class, 'langEs']);
		} else {
			Router::getInstance()->addRoute('/dotdager/', Home::class);
			Router::getInstance()->addRoute('/dotdager/public/{version}/{@resource}', ResourceManager::class);
			Router::getInstance()->addRoute('/dotdager/favicon.ico', [Home::class, 'favicon']);
			Router::getInstance()->addRoute('/dotdager/en', [Home::class, 'langEn']);
			Router::getInstance()->addRoute('/dotdager/es', [Home::class, 'langEs']);
		}
	}

	static function getFallback()
	{
		//TODO: implement fallback function
	}
}