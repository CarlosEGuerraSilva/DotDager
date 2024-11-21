<?php

namespace App\Core\Framework\Enumerables;

enum QueryTypes: string
{
	case SELECT = 'SELECT';
	case INSERT = 'INSERT';
	case UPDATE = 'UPDATE';
	case DELETE = 'DELETE';
}