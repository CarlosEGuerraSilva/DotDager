<?php
namespace App\Core\Framework\Enumerables;

/**
 * ResourceIntervals - Sets the intervals for the resources for how long they should be cached in seconds
 * @package App\Core\Framework\Enumerables
 */
enum ResourceIntervals: int {
	case ONE_DAY = 86400;
	case ONE_WEEK = 604800;
	case ONE_MONTH = 2629800;
	case TWO_MONTHS = 5259600;
	case THREE_MONTHS = 7889400;
	case SIX_MONTHS = 15778800;
	case ONE_YEAR = 31557600;
}