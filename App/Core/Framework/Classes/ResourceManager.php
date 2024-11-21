<?php

namespace App\Core\Framework\Classes;

use App\Core\Application\Configuration;
use App\Core\Application\SharedConsts;
use App\Core\Framework\Enumerables\DataUnits;
use App\Core\Server\Actions;
use App\Core\Server\FileManager;
use App\Core\Server\Logger;
use App\Core\Framework\Enumerables\ResourceIntervals;

/**
 * The ResourceManager class provides methods for loading and managing resources.
 */
class ResourceManager {
	public function __construct($Method, $args = []) {
		if (!isset($args['version']) || !isset($args['resource'])) {
			http_response_code(SharedConsts::HTTP_RESPONSE_BAD_REQUEST);
			echo "Bad Request";
			return;
		}
		if (!self::isValidStoreFrequency($args['version'])) {
			http_response_code(SharedConsts::HTTP_RESPONSE_NOT_FOUND);
			echo Actions::printLocalized(Strings::RESOURCE_NOT_FOUND);
			return;
		} else {
			$Resource = $args['resource'];
			if (strpos($Resource, '..') !== false || strpos($Resource, '/') === 0) {
				http_response_code(SharedConsts::HTTP_RESPONSE_FORBIDDEN);
				echo Actions::printLocalized(Strings::FORBIDDEN);
				return;
			}
			$time = ResourceIntervals::ONE_YEAR;
			match ($args['version']) {
				Actions::STORE_ONE_DAY => $time = ResourceIntervals::ONE_DAY,
				Actions::STORE_ONE_WEEK => $time = ResourceIntervals::ONE_WEEK,
				Actions::STORE_ONE_MONTH => $time = ResourceIntervals::ONE_MONTH,
				Actions::STORE_THREE_MONTHS => $time = ResourceIntervals::THREE_MONTHS,
				Actions::STORE_SIX_MONTHS => $time = ResourceIntervals::SIX_MONTHS,
				default => $time = ResourceIntervals::ONE_YEAR
			};
			self::loadResource($Resource, $time->value);
		}
	}

	public static function loadResource(string $path, int $cacheTime): void {
		$safePath = self::sanitizePath($path);
		if (!self::isValidPath($safePath)) {
			self::sendErrorResponse(SharedConsts::HTTP_RESPONSE_NOT_FOUND, Strings::RESOURCE_NOT_FOUND);
			return;
		}
		if (!self::isFileAccessible($safePath)) {
			self::sendErrorResponse(SharedConsts::HTTP_RESPONSE_FORBIDDEN, Strings::FORBIDDEN);
			return;
		}
		self::sendResource($safePath, $cacheTime);
	}

	private static function sanitizePath(string $path): string {
		$safePath = str_replace(['..', '\\', '/./', '/../'], '', $path);
		$safePath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $safePath);
		return realpath(Configuration::RESOURCES_PATH . DIRECTORY_SEPARATOR . $safePath);
	}

	private static function isValidStoreFrequency(?string $storeFrequency): bool {
		return in_array($storeFrequency, Actions::STORE_OPTIONS);
	}

	private static function isValidPath(?string $safePath): bool {
		return $safePath !== false && strpos($safePath, realpath(Configuration::RESOURCES_PATH)) === 0;
	}

	private static function isFileAccessible(string $safePath): bool {
		if (!file_exists($safePath)) {
			return false;
		}
		if (FileManager::getFileSize($safePath, DataUnits::MEGABYTES) > Configuration::MAX_RESOURCE_SIZE_MB) {
			Logger::LogWarning(self::class, "Resource exceeds maximum size: {$safePath}");
			return false;
		}
		$extension = pathinfo($safePath, PATHINFO_EXTENSION);
		if (in_array($extension, self::EXCLUDED_EXTENSIONS)) {
			Logger::LogWarning(self::class, "Attempted to access a restricted file: {$safePath}");
			return false;
		}
		return true;
	}

	private static function sendErrorResponse(int $statusCode, string $message): void {
		http_response_code($statusCode);
		echo Actions::printLocalized($message);
	}

	private static function sendResource(string $safePath, int $cacheTime): void {
		$extension = pathinfo($safePath, PATHINFO_EXTENSION);
		$mimeType = in_array($extension, array_keys(self::$commonMimeTypes)) ? self::$commonMimeTypes[$extension] : FileManager::getFileMimeType($safePath);
		header('Content-Type: ' . $mimeType);
		header('Content-Length: ' . filesize($safePath));
		header('Cache-Control: public, max-age=' . $cacheTime);
		header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cacheTime) . ' GMT');
		header('Pragma: public');
		header('Fetch-As: ' . $extension);
		readfile($safePath);
	}

	public static $commonMimeTypes = [
		'3gp' => 'video/3gpp',
		'7z' => 'application/x-7z-compressed',
		'aac' => 'audio/aac',
		'abw' => 'application/x-abiword',
		'apng' => 'image/apng',
		'apk' => 'application/vnd.android.package-archive',
		'arc' => 'application/x-freearc',
		'avif' => 'image/avif',
		'azw' => 'application/vnd.amazon.ebook',
		'avi' => 'video/x-msvideo',
		'bin' => 'application/octet-stream',
		'bmp' => 'image/bmp',
		'css' => 'text/css',
		'csv' => 'text/csv',
		'dmg' => 'application/x-apple-diskimage',
		'doc' => 'application/msword',
		'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'eot' => 'application/vnd.ms-fontobject',
		'epub' => 'application/epub+zip',
		'exe' => 'application/octet-stream',
		'gif' => 'image/gif',
		'gz' => 'application/gzip',
		'htm' => 'text/html',
		'html' => 'text/html',
		'ico' => 'image/x-icon',
		'ics' => 'text/calendar',
		'iso' => 'application/x-iso9660-image',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'jsonld' => 'application/ld+json',
		'mid' => 'audio/midi',
		'midi' => 'audio/x-midi',
		'mjs' => 'application/javascript',
		'm4a' => 'audio/mp4',
		'mp3' => 'audio/mpeg',
		'mp4' => 'video/mp4',
		'mpeg' => 'video/mpeg',
		'mpkg' => 'application/vnd.apple.installer+xml',
		'odp' => 'application/vnd.oasis.opendocument.presentation',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		'odt' => 'application/vnd.oasis.opendocument.text',
		'oga' => 'audio/ogg',
		'ogv' => 'video/ogg',
		'ogx' => 'application/ogg',
		'opus' => 'audio/opus',
		'otf' => 'font/otf',
		'pdf' => 'application/pdf',
		'png' => 'image/png',
		'ppt' => 'application/vnd.ms-powerpoint',
		'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'rar' => 'application/x-rar-compressed',
		'sfnt' => 'font/sfnt',
		'svg' => 'image/svg+xml',
		'tar' => 'application/x-tar',
		'tif' => 'image/tiff',
		'tiff' => 'image/tiff',
		'ts' => 'video/mp2t',
		'ttf' => 'font/ttf',
		'txt' => 'text/plain',
		'wav' => 'audio/wav',
		'webm' => 'video/webm',
		'webp' => 'image/webp',
		'woff2' => 'application/font-woff2',
		'woff' => 'application/font-woff',
		'xls' => 'application/vnd.ms-excel',
		'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'xml' => 'application/xml',
		'zip' => 'application/zip',
	];

	const EXCLUDED_EXTENSIONS = [
		'php',
		'php3',
		'php4',
		'php5',
		'php7',
		'phtml',
		'phar',
		'cgi',
		'pl',
		'py',
		'rb',
		'sh',
		'bash',
		'zsh',
		'sh',
		'csh',
		'ksh',
		'cmd',
		'bat',
		'com',
		'exe',
		'dll',
		'vbs',
		'jar',
		'env'
	];
}