<?php

namespace App\Core\Application;

/**
 * Class Configuration
 * 
 * This class contains constants for configuring the application.
 */
class Configuration
{
    /**
     * The version of the application.
     */
    public const APP_VERSION = "1.0";

    /**
     * The URL path where is located the application locally.
     */
    public const PATH_URL = "/";

    /**
     * The domain of the application (without the protocol, ending with a slash).
     */
    public const APP_DOMAIN = "previews.expringsoft.com/dotdager/";

    /**
     * The default language code for default lang file.
     */
    public const APP_LANG_DISPLAY = "en";

    /**
     * The session key to store app language.
     */
    public const APP_LANG_SESSION_KEY = "APP_CURRENT_LANGUAGE";

    /**
     * The application timezone used by all date/time functions.
     * See supported list on: https://www.php.net/manual/en/timezones.php
     */
    public const APP_TIMEZONE = "America/New_York";

    /**
     * The name of environment variable which stores encryption key for the application.
     */
    public const ENV_CRYPTOGRAPHY_KEY_NAME = "GUSI_FRAMEWORK_ENCRYPTION_KEY";

    /**
     * Enable or disable debug mode.
     */
    public const DEBUG_ENABLED = false;

    /**
     * Set whether the application is running in a local environment.
     */
    public const LOCAL_ENVIRONMENT = false;

    /**
     * Allow or disallow testing outside the local environment.
     */
    public const ALLOW_TESTING_OUTSIDE_LOCAL = false;

    /**
     * If the application is only accessible via HTTPS (production).
     */
    public const APP_ONLY_OVER_HTTPS = true;

    /**
     * Prevents setting model properties if they are not defined in the model.
     */
    public const STRICT_MODELS = true;

    public const PATH_APP_ERROR_PAGE = "Default/App-Error.php";

    public const PATH_APP_NOT_FOUND_PAGE = "Default/Not-Found.php";

    /**
     * Automatically log exceptions.
     */
    public const AUTOLOG_EXCEPTIONS = true;

    /**
     * Automatically log errors.
     */
    public const AUTOLOG_ERRORS = true;

    /**
     * Log errors.
     */
    public const LOG_ERRORS = true;

    /**
     * Log language errors.
     */
    public const LOG_LANGUAGE_ERRORS = true;



    #region Storage configuration

    /**
     * The maximum disk space that the application can use in gigabytes.
     */
    public const APP_STORAGE_USAGE_CAP_GB = 20;

    /**
     * The minimum disk space that must be available in gigabytes.
     */
    public const MINIMUM_DISK_SPACE_GB = 1;

    /**
     * The maximum upload size in megabytes.
     * This value should be less than or equal to the value set in the php.ini file.
     */
    public const MAX_UPLOAD_SIZE_MB = 100;

    /**
     * The root folder for all stored files.
     */
    public const APP_STORAGE_FOLDER = "Files/";

    #endregion

    #region Cache configuration

    /**
     * The cache directory.
     */
    const CACHE_FOLDER = "App/Cache/";

    /**
     * The cache file extension.
     */
    const CACHE_FILE_EXTENSION = ".cache";

    /**
     * The maximum cache size in megabytes.
     */
    const MAX_CACHE_SIZE_MB = 25;

    #endregion

    #region Database configuration

    /**
     * The database host.
     */
    public const DB_HOST_ENV_VAR = "GUSI_FRAMEWORK_DB_HOST";

    /**
     * The database port.
     */
    public const DB_PORT_ENV_VAR = "GUSI_FRAMEWORK_DB_PORT";

    /**
     * The database name.
     */
    public const DB_NAME_ENV_VAR = "GUSI_FRAMEWORK_DB_NAME";

    /**
     * The database charset.
     */
    public const DB_CHARSET = "utf8mb4";

    /**
     * The database user environment variable.
     */
    public const DB_USER_ENV_VAR = "GUSI_FRAMEWORK_DB_USER";

    /**
     * The database password environment variable.
     */
    public const DB_PASSWORD_ENV_VAR = "GUSI_FRAMEWORK_DB_PASSWORD";

    /**
     * If true it will log with stack trace MySQL duplicate key 1062. Otherwise will be omitted on error log.
     */
    public const DB_LOG_DUPLICATE_KEY = false;

    #endregion

    #region Resource configuration

    /**
     * The path to the resources folder.
     */
    public const RESOURCES_PATH = "Resources/";

    /**
     * The maximum resource size in megabytes.
     */
    public const MAX_RESOURCE_SIZE_MB = 15;

    /**
     * Time in Unix Timestamp at which the resource will be stored in cache
     */
    public const RESOURCE_CACHE_TIME = 31536000;

    #endregion
}