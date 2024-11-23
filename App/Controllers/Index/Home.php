<?php
namespace App\Controllers\Index;

use App\Core\Application\Configuration;
use App\Core\Framework\Abstracts\Controller;
use App\Core\Framework\Classes\LanguageManager;
use App\Core\Framework\Enumerables\Channels;
use App\Core\Framework\Enumerables\ResourceIntervals;
use App\Core\Server\Actions;
use App\Core\Server\Logger;
use App\Core\Server\Router;
use App\Core\Server\UAParser;
use App\Modules\Index\Index_Module;

class Home extends Controller
{
	private const COOKIE_SETTING_LANG = "app_user_language";

	public function Main(...$args)
	{
		self::localize();
		$this->setView('Default/Landing.php');
	}

	public function DagerFans(...$args){
		self::localize();
		$this->setView('Default/DagerFans.php');
	}

	public static function getParentModule(): string
	{
		return Index_Module::class;
	}

	public static function getModuleChannel(): Channels
	{
		return self::getParentModule()::getChannel();
	}

	public static function localize(){
		$LangOptions = [Configuration::APP_LANG_DISPLAY, "es-419"];
		if (isset($_COOKIE[self::COOKIE_SETTING_LANG])) {
			Logger::LogDebug(null, "Cookie exists");
			try {
				$chooseLang = $_COOKIE[self::COOKIE_SETTING_LANG] ?? Configuration::APP_LANG_DISPLAY;
				Logger::LogDebug(null, $chooseLang);
				if (in_array($chooseLang, $LangOptions)) {
					Logger::LogDebug(null, "Changed language");
					LanguageManager::getInstance()->setLanguage($chooseLang);
				} else {
					self::setUserLang($chooseLang);
				}
			} catch (\Throwable $th) {
				Logger::LogError(null, "Unable to decode lang settings");
			}
		} else {
			Logger::LogDebug(null, "Cookie NOT exists");
			self::setUserLang(Router::getUserLanguage());
		}
	}

	public static function langEn(...$args)
	{
		self::setUserLang(Configuration::APP_LANG_DISPLAY);
		Actions::rootRedirect("");
	}

	public static function langEs(...$args)
	{
		self::setUserLang("es-419");
		Actions::rootRedirect("");
	}

	private static function setUserLang(string $name){
		setcookie(self::COOKIE_SETTING_LANG, $name, time() + ResourceIntervals::ONE_YEAR->value, httponly: true);
	}

	public function favicon()
	{
		$this->setHeader('Content-Type', 'image/x-icon');
		echo file_get_contents('Resources/Images/favicon.ico');
	}
}