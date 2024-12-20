<?php
namespace App\Core\Framework\Classes;

class Strings{
	#region App internal strings
	public const API_UNHANDLED_EXCEPTION = 'API_UNHANDLED_EXCEPTION';
	public const APP_DESCRIPTION = 'APP_DESCRIPTION';
	public const APP_DESCRIPTION_NO_NAME = 'APP_DESCRIPTION_NO_NAME';
	public const APP_INTERNAL_SERVER_ERROR_EXPLAIN = 'APP_INTERNAL_SERVER_ERROR_EXPLAIN';
	public const APP_LOGO_FILENAME = 'APP_LOGO_FILENAME';
	public const APP_NAME = 'APP_NAME';
	public const APP_PAGE_NOT_FOUND_EXPLAIN = 'APP_PAGE_NOT_FOUND_EXPLAIN';
	public const APP_PAGE_ON_BUILDING_EXPLAIN = 'APP_PAGE_ON_BUILDING_EXPLAIN';
	public const BUILDING_PAGE = "BUILDING_PAGE";
	public const CONTROLLER_NOT_FOUND = 'CONTROLLER_NOT_FOUND';
	public const DATABASE_DELETE_FAILED = "DATABASE_DELETE_FAILED";
	public const DATABASE_DELETE_SUCCESS = "DATABASE_DELETE_SUCCESS";
	public const DATABASE_INSERT_FAILED = "DATABASE_INSERT_FAILED";
	public const DATABASE_INSERT_SUCCESS = "DATABASE_INSERT_SUCCESS";
	public const DATABASE_OPERATION_FAILED = "DATABASE_OPERATION_FAILED";
	public const DATABASE_OPERATION_SUCCESS = "DATABASE_OPERATION_SUCCESS";
	public const DATABASE_SELECT_FAILED = "DATABASE_SELECT_FAILED";
	public const DATABASE_SELECT_SUCCESS = "DATABASE_SELECT_SUCCESS";
	public const DATABASE_STATEMENT_NOT_PERFORMED = "DATABASE_STATEMENT_NOT_PERFORMED";
	public const DATABASE_UPDATE_FAILED = "DATABASE_UPDATE_FAILED";
	public const DATABASE_UPDATE_SUCCESS = "DATABASE_UPDATE_SUCCESS";
	public const EMPTY = "EMPTY";
	public const FORBIDDEN = 'FORBIDDEN';
	public const INCOMPLETE_POST = 'INCOMPLETE_POST';
	public const INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
	public const METHOD_NOT_ALLOWED = 'METHOD_NOT_ALLOWED';
	public const NOT_FOUND = "NOT_FOUND";
	public const NOT_LOGGED_IN = "NOT_LOGGED_IN";
	public const OPERATION_ERROR = 'OPERATION_ERROR';
	public const OPERATION_NO_RESULTS = 'OPERATION_NO_RESULTS';
	public const OPERATION_SUCCESS = 'OPERATION_SUCCESS';
	public const OPERATION_UNSOLVED = 'OPERATION_UNSOLVED';
	public const REGEX_FAILED = "REGEX_FAILED";
	public const REQUEST_UNDEFINED = "REQUEST_UNDEFINED";
	public const RESOURCE_NOT_FOUND = "RESOURCE_NOT_FOUND";
	public const SUCCESSFUL_LOGIN = "SUCCESSFUL_LOGIN";
	public const UNKNOWN_ACTION = 'UNKNOWN_ACTION';
	public const UNSUCCESSFUL_LOGIN = "UNSUCCESSFUL_LOGIN";
	public const VIEW_NOT_FOUND = "VIEW_NOT_FOUND";
	#endregion

	#region User defined strings
	public const DOT_DAGER_LANDING_GREETINGS = "DOT_DAGER_LANDING_GREETINGS";
	public const DOT_DAGER_LANDING_INTRODUCTION = "DOT_DAGER_LANDING_INTRODUCTION";
	public const DOT_DAGER_LANDING_CTA_BUTTON = "DOT_DAGER_LANDING_CTA_BUTTON";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TITLE = "DOT_DAGER_LANDING_SECTION_ABOUT_TITLE";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_SUBTLE = "DOT_DAGER_LANDING_SECTION_ABOUT_SUBTLE";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1 = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2 = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3 = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_1_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_2_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_TOPIC_3_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRAS = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRAS";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1 = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_1_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2 = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_2_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3 = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3";
	public const DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_ABOUT_EXTRA_3_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_SUBTLE = "DOT_DAGER_LANDING_SECTION_PROJECTS_SUBTLE";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_TITLE = "DOT_DAGER_LANDING_SECTION_PROJECTS_TITLE";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_1_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_1_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_2_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_2_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_3_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_3_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_4_DESCRIPTION = "DOT_DAGER_LANDING_SECTION_PROJECTS_PROJECT_4_DESCRIPTION";
	public const DOT_DAGER_LANDING_SECTION_DAGERFANS_TITLE = "DOT_DAGER_LANDING_SECTION_DAGERFANS_TITLE";
	public const DOT_DAGER_LANDING_SECTION_DAGERFANS_SUBTLE = "DOT_DAGER_LANDING_SECTION_DAGERFANS_SUBTLE";
	public const DOT_DAGER_LANDING_SECTION_CONTACT_TITLE = "DOT_DAGER_LANDING_SECTION_CONTACT_TITLE";
	public const DOT_DAGER_LANDING_SECTION_CONTACT_SUBTLE = "DOT_DAGER_LANDING_SECTION_CONTACT_SUBTLE";
	public const DOT_DAGER_LANDING_SECTION_CONTACT_DETAILS = "DOT_DAGER_LANDING_SECTION_CONTACT_DETAILS";
	public const DOT_DAGER_LINKS_HOME = "DOT_DAGER_LINKS_HOME";
	public const DOT_DAGER_LINKS_PROJECTS = "DOT_DAGER_LINKS_PROJECTS";
	public const DOT_DAGER_LINKS_ABOUT = "DOT_DAGER_LINKS_ABOUT";
	public const DOT_DAGER_LINKS_CONTACT = "DOT_DAGER_LINKS_CONTACT";
	public const DOT_DAGER_QUICKLINKS = "DOT_DAGER_QUICKLINKS";
	public const DOT_DAGER_PROJECT_IMAGE = "DOT_DAGER_PROJECT_IMAGE";
	public const DOT_DAGER_GENERIC_PHOTO = "DOT_DAGER_GENERIC_PHOTO";
	public const DOT_DAGER_TOGGLE_THEME = "DOT_DAGER_TOGGLE_THEME";
	public const DOT_DAGER_TOGGLE_LANG = "DOT_DAGER_TOGGLE_LANG";
	public const DOT_DAGER_MADE_BY = "DOT_DAGER_MADE_BY";
	#endregion
}