<?php

namespace App\Core\Framework\Classes;

use App\Core\Framework\Enumerables\QueryTypes;
use App\Core\Framework\Structures\DatabaseResult;
use App\Core\Server\Database\Database;
use App\Core\Server\Logger;
use BadFunctionCallException;
use LogicException;

/**
 * Class QueryBuilder
 *
 * Represents a query builder for constructing SQL queries.
 */
class QueryBuilder
{
	private $queryParts = [];
	private $params = [];
	private $searchParams = [];
	private $queryType;
	private $ignoreWhere = false;

	public const LIKE_ENDS_WITH = "%@"; // Starts with
	public const LIKE_STARTS_WITH = "@%"; // Ends with
	public const LIKE_CONTAINS = "%@%"; // Contains
	public const TYPE_JOIN_INNER = 'INNER';
	public const TYPE_JOIN_LEFT = 'LEFT';
	public const TYPE_JOIN_LEFT_OUTER = 'LEFT OUTER';
	public const TYPE_JOIN_RIGHT = 'RIGHT';
	public const TYPE_JOIN_RIGHT_OUTER = 'RIGHT OUTER';
	public const TYPE_JOIN_FULL = 'FULL';
	public const TYPE_JOIN_FULL_OUTER = 'FULL OUTER';
	public const TYPE_JOIN_CROSS = 'CROSS';
	public const TYPE_JOIN_SELF = 'SELF';

	/**
	 * QueryBuilder constructor.
	 *
	 * Initializes the query parts and parameters.
	 */
	public function __construct()
	{
		$this->setDefaults();
	}

	/**
	 * Sets the default values for the query parts and parameters.
	 */
	public function setDefaults()
	{
		$this->queryParts = [
			'select' => '',
			'from' => '',
			'join' => [],
			'where' => [],
			'search' => [],
			'group' => '',
			'having' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'insert' => '',
			'update' => '',
			'delete' => '',
		];
		$this->params = [];
		$this->queryType = null;
		$this->ignoreWhere = false;
	}

	public function count(string $column = '*', string $alias = 'count'): self
	{
		$tableAlias = $this->queryParts['table_alias'] ?? null;
		$columnWithAlias = $column;

		if ($column !== '*' && $tableAlias) {
			$columnWithAlias = "$tableAlias.$column";
		}

		$this->queryType = QueryTypes::SELECT;
		$this->queryParts['select'] = "SELECT COUNT($columnWithAlias) AS $alias";
		if (empty($this->queryParts['from'])) {
			throw new \LogicException("FROM clause is required to perform COUNT.");
		}
		return $this;
	}

	public function sum(string $column, string $alias = 'sum'): self
	{
		$tableAlias = $this->queryParts['table_alias'] ?? null;
		$columnWithAlias = $tableAlias ? "$tableAlias.$column" : $column;

		$this->queryType = QueryTypes::SELECT;
		$this->queryParts['select'] = "SELECT SUM($columnWithAlias) AS $alias";
		if (empty($this->queryParts['from'])) {
			throw new \LogicException("FROM clause is required to perform SUM.");
		}
		return $this;
	}

	public function avg(string $column, string $alias = 'avg'): self
	{
		$tableAlias = $this->queryParts['table_alias'] ?? null;
		$columnWithAlias = $tableAlias ? "$tableAlias.$column" : $column;

		$this->queryType = QueryTypes::SELECT;
		$this->queryParts['select'] = "SELECT AVG($columnWithAlias) AS $alias";
		if (empty($this->queryParts['from'])) {
			throw new \LogicException("FROM clause is required to perform AVG.");
		}
		return $this;
	}

	/**
	 * Sets the query type to SELECT and constructs the SELECT query.
	 *
	 * @param string $table The name of the table to select from.
	 * @param array $columns An array of column names to select. If an associative array is provided ($key => $value), $value will be used as column alias.
	 * @param string|null $alias An optional alias for the table.
	 * @return $this The QueryBuilder instance.
	 */
	public function select(string $table, array $columns = ['*'], string $alias = null)
	{
		$this->queryType = QueryTypes::SELECT;
		$tableWithAlias = $alias ? "$table AS $alias" : $table;
		$this->queryParts['from'] = "FROM $tableWithAlias";
		$this->queryParts['table_alias'] = $alias; // Almacenar el alias de la tabla

		$columnsList = [];
		foreach ($columns as $key => $value) {
			if (is_string($key)) {
				$columnName = $key;
				$columnAlias = $value;
			} else {
				$columnName = $value;
				$columnAlias = null;
			}

			$fullColumnName = $alias ? "$alias.$columnName" : "$columnName";

			if ($columnAlias) {
				$columnsList[] = "$fullColumnName AS $columnAlias";
			} else {
				$columnsList[] = $fullColumnName;
			}
		}
		$this->queryParts['select'] = "SELECT " . implode(', ', $columnsList);
		return $this;
	}

	/**
	 * Sets the query type to INSERT and constructs the INSERT query.
	 *
	 * @param string $table The name of the table to insert into.
	 * @param array $data An associative array of column names and values to insert.
	 * @return $this The QueryBuilder instance.
	 */
	public function insert(string $table, array $data)
	{
		$this->queryType = QueryTypes::INSERT;
		$columns = implode(', ', array_keys($data));
		$placeholders = implode(', ', array_fill(0, count($data), '?'));
		$this->queryParts['insert'] = "INSERT INTO $table ($columns) VALUES ($placeholders)";
		$this->params = array_values($data);
		return $this;
	}

	/**
	 * Sets the query type to UPDATE and constructs the UPDATE query.
	 *
	 * @param string $table The name of the table to update.
	 * @param array $data An associative array of column names and values to update.
	 * @return $this The QueryBuilder instance.
	 */
	public function update(string $table, array $data)
	{
		$this->queryType = QueryTypes::UPDATE;
		$set = [];
		foreach ($data as $column => $value) {
			$set[] = "$column = ?";
			$this->params[] = $value;
		}
		$set = implode(', ', $set);
		$this->queryParts['update'] = "UPDATE $table SET $set";
		return $this;
	}

	/**
	 * Sets the query type to DELETE and constructs the DELETE query.
	 *
	 * @param string $table The name of the table to delete from.
	 * @param bool $ignoreWhere Whether to ignore the FROM clause in the DELETE query.
	 * @return $this The QueryBuilder instance.
	 */
	public function delete(string $table, bool $ignoreWhere = false)
	{
		$this->queryType = QueryTypes::DELETE;
		$this->queryParts['delete'] = "DELETE FROM $table";
		$this->ignoreWhere = $ignoreWhere;
		return $this;
	}

	/**
	 * Adds a JOIN clause to the query.
	 *
	 * @param string $table The name of the table to join.
	 * @param string|array $first The first column or an array of conditions.
	 * @param string|null $operator The operator (=, <, >, etc.) or null if $first is an array.
	 * @param string|null $second The second column or value.
	 * @param string $type The type of join (INNER, LEFT, RIGHT).
	 * @param string|null $alias An optional alias for the table.
	 * @return $this The QueryBuilder instance.
	 */
	public function join(string $table, $first, $operator = null, $second = null, $type = 'INNER', $alias = null)
	{
		$tableWithAlias = $alias ? "$table AS $alias" : $table;

		if (is_array($first)) {
			$onConditions = [];
			foreach ($first as $condition) {
				if (count($condition) == 3) {
					list($col1, $op, $col2) = $condition;
					$onConditions[] = "$col1 $op $col2";
				}
			}
			$onClause = implode(' AND ', $onConditions);
		} else {
			$onClause = "$first $operator $second";
		}

		$this->queryParts['join'][] = " $type JOIN $tableWithAlias ON $onClause";
		return $this;
	}

	/**
	 * Adds a WHERE clause to the query.
	 *
	 * @param string $column The column to filter by.
	 * @param mixed $value The value to filter by.
	 * @param string $operator The operator to use (=, <, >, etc.).
	 * @param string $boolean The boolean operator to use (AND, OR).
	 * @return $this The QueryBuilder instance.
	 */
	public function where(string $column, $value, $operator = '=', $boolean = 'AND')
	{
		$alias = $this->queryParts['table_alias'] ?? null;
		$columnWithAlias = $alias ? "$alias.$column" : $column;
		$this->queryParts['where'][] = [$boolean, "$columnWithAlias $operator ?", $value];
		return $this;
	}

	/**
	 * Adds a WHERE clause to the query using the LIKE operator.
	 *
	 * @param string $column The column to filter by.
	 * @param mixed $value The value to filter by.
	 * @param string $likeType The type of LIKE operation to use.
	 * @param string $boolean The boolean operator to use (AND, OR).
	 * @return $this The QueryBuilder instance.
	 */
	public function whereLike(string $column, $value, $likeType = self::LIKE_CONTAINS, $boolean = 'AND')
	{
		$likeValue = str_replace("@", $value, $likeType);
		return $this->where($column, $likeValue, 'LIKE', $boolean);
	}

	/**
	 * Adds a WHERE clause to the query using the NOT operator.
	 *
	 * @param string $column The column to filter by.
	 * @param mixed $value The value to filter by.
	 * @param string $operator The operator to use.
	 * @return $this The QueryBuilder instance.
	 */
	public function whereNot(string $column, $value, $operator = '=')
	{
		return $this->where($column, $value, $operator, 'AND NOT');
	}

	/**
	 * Adds an OR WHERE clause to the query.
	 *
	 * @param string $column The column to filter by.
	 * @param mixed $value The value to filter by.
	 * @param string $operator The operator to use.
	 * @return $this The QueryBuilder instance.
	 */
	public function orWhere(string $column, $value, $operator = '=')
	{
		return $this->where($column, $value, $operator, 'OR');
	}

	/**
	 * Makes a keyword search on the specified columns with the given search string and a maximum number of keywords.
	 * The search string is split into keywords and each keyword is searched for in the specified columns.
	 * WARNING: As this method searches for each keyword in each column, it can be slow for large datasets and/or large number of keywords and columns.
	 *
	 * @param array $columns The columns to search in.
	 * @param string $search The search string.
	 * @param int $maxKeywords The maximum number of keywords to search for.
	 * @return $this The QueryBuilder instance.
	 */
	public function keyWordSearch(array $columns, string $search, int $maxKeywords = 5)
	{
		if (empty($search) || !$search || !is_string($search) || strlen($search) == 0) {
			return $this;
		}
		$keywords = array_slice(explode(' ', $search), 0, $maxKeywords);

		foreach ($keywords as $keyword) {
			foreach ($columns as $column) {
				$this->queryParts['search'][] = ['AND', "$column LIKE ?", '%' . $keyword . '%'];
			}
		}

		return $this;
	}

	/**
	 * Adds a GROUP BY clause to the query.
	 *
	 * @param array $columns The columns to group by.
	 * @return $this The QueryBuilder instance.
	 */
	public function groupBy(array $columns): self
	{
		$alias = $this->queryParts['table_alias'] ?? null;
		$columnsWithAlias = [];

		foreach ($columns as $column) {
			$columnWithAlias = $alias ? "$alias.$column" : $column;
			$columnsWithAlias[] = $columnWithAlias;
		}

		$this->queryParts['group'] = ' GROUP BY ' . implode(', ', $columnsWithAlias);
		return $this;
	}

	/**
	 * Adds a HAVING clause to the query.
	 *
	 * @param string $condition The condition for the HAVING clause.
	 * @return $this The QueryBuilder instance.
	 */
	public function having(string $column, $value, string $operator = '=', string $boolean = 'AND'): self
	{
		$columnWithAlias = $column; // Asumimos que el usuario proporciona el nombre de la columna o alias correctamente

		$this->queryParts['having'][] = [$boolean, "$columnWithAlias $operator ?", $value];
		return $this;
	}

	/**
	 * Adds an ORDER BY clause to the query.
	 *
	 * @param array $columns An array of column names to order by.
	 * @param string $direction The direction to order by (ASC, DESC).
	 * @return $this The QueryBuilder instance.
	 */
	public function orderBy(array $columns, $useAlias = false): self
	{
		$alias = $useAlias ? $this->queryParts['table_alias'] ?? null : null;
		$orderList = [];
		foreach ($columns as $column => $direction) {
			if (is_numeric($column)) {
				$column = $direction;
				$direction = 'ASC';
			}
			$columnWithAlias = $alias ? "$alias.$column" : $column;
			$orderList[] = "$columnWithAlias $direction";
		}
		$this->queryParts['order'] = " ORDER BY " . implode(', ', $orderList);
		return $this;
	}

	/**
	 * Adds a LIMIT clause to the query.
	 *
	 * @param int $limit The number of rows to limit the query to.
	 * @return $this The QueryBuilder instance.
	 */
	public function limit(int $limit)
	{
		$this->queryParts['limit'] = " LIMIT $limit";
		return $this;
	}

	/**
	 * Adds an OFFSET clause to the query.
	 *
	 * @param int $offset The number of rows to offset the query by.
	 * @return $this The QueryBuilder instance.
	 */
	public function offset(int $offset)
	{
		$this->queryParts['offset'] = " OFFSET $offset";
		return $this;
	}

	/**
	 * Merges joins from another QueryBuilder instance.
	 *
	 * @param QueryBuilder $other The other QueryBuilder instance.
	 * @return $this The QueryBuilder instance.
	 */
	public function mergeJoins(QueryBuilder $other)
	{
		$this->queryParts['join'] = array_merge($this->queryParts['join'], $other->queryParts['join']);
		return $this;
	}

	/**
	 * Merges select columns from another QueryBuilder instance.
	 *
	 * @param QueryBuilder $other The other QueryBuilder instance.
	 * @return $this The QueryBuilder instance.
	 */
	public function mergeSelects(QueryBuilder $other)
	{
		$currentSelect = str_replace('SELECT ', '', $this->queryParts['select']);
		$otherSelect = str_replace('SELECT ', '', $other->queryParts['select']);
		$this->queryParts['select'] = 'SELECT ' . $currentSelect . ', ' . $otherSelect . ' ' . $this->queryParts['from'];
		return $this;
	}

	/**
	 * Adds a parameter to the query.
	 *
	 * @param mixed $param The parameter value.
	 * @return $this The QueryBuilder instance.
	 */
	public function addParam($param)
	{
		$this->params[] = $param;
		return $this;
	}

	/**
	 * Executes the query, resets the query parts and parameters to their default values and returns the result.
	 * This method **must** be called after constructing the query to perform the query.
	 *
	 * @return DatabaseResult The result of the query.
	 * @throws LogicException If DELETE or UPDATE are performed without where and flag $ignoreWhere is false.
	 * @throws BadFunctionCallException If its performed a non-supported query type
	 */
	public function execute(): DatabaseResult
	{
		$database = Database::DB();
		$query = $this->getQuery();
		$params = $this->getParams();
		$result = null;

		Logger::LogDebug(null, ['query' => $query, 'params' => $params, 'raw_query' => $this->getRawQuery()], true);

		if (in_array($this->queryType, [QueryTypes::DELETE, QueryTypes::UPDATE], true) && empty($this->queryParts['where']) && !$this->ignoreWhere) {
			throw new LogicException("{$this->queryType->value} query without WHERE clause is not allowed.");
		}

		if (!method_exists($database, strtolower($this->queryType->value))) {
			throw new BadFunctionCallException("Unsupported query type");
		}

		$method = $this->queryType->value;
		$result = $database->$method($query, $params);

		$this->setDefaults();
		return $result;
	}

	/**
	 * Gets the query string.
	 *
	 * @return string The query string.
	 */
	public function getQuery(): string
	{
		$query = '';
		switch ($this->queryType) {
			case QueryTypes::SELECT:
				$query .= $this->queryParts['select']
					. ' ' . $this->queryParts['from']
					. $this->addToQuery($this->queryParts['join'])
					. $this->buildWhereClause()
					. $this->queryParts['group']
					. $this->buildHavingClause()
					. $this->queryParts['order']
					. $this->queryParts['limit']
					. $this->queryParts['offset'];
				break;
			case QueryTypes::INSERT:
				$query .= $this->queryParts['insert'];
				break;
			case QueryTypes::UPDATE:
				$query .= $this->queryParts['update'] . $this->buildWhereClause();
				break;
			case QueryTypes::DELETE:
				$query .= $this->queryParts['delete'] . $this->buildWhereClause();
				break;
		}
		return $query;
	}

	/**
	 * Gets the raw query string with embebed params.
	 * WARNING: This is unsafe, use carefully, params are not sanitized.
	 *
	 * @return string The query string.
	 */
	public function getRawQuery(): string
	{
		$query = $this->getQuery();
		$params = $this->params;
		$paramIndex = 0;

		$queryWithParams = preg_replace_callback('/\?/', function ($matches) use ($params, &$paramIndex) {
			if (!isset($params[$paramIndex])) {
				return '?';
			}
			$param = $params[$paramIndex++];
			// Escapar el parámetro
			if (is_string($param)) {
				return "'" . addslashes($param) . "'";
			} elseif (is_null($param)) {
				return 'NULL';
			} elseif (is_bool($param)) {
				return $param ? '1' : '0';
			} else {
				return $param;
			}
		}, $query);

		return $queryWithParams;
	}

	/**
	 * Builds the WHERE clause of the query.
	 *
	 * @return string The WHERE clause.
	 */
	private function buildWhereClause(): string
	{
		if (empty($this->queryParts['where']) && empty($this->queryParts['search'])) {
			return '';
		}

		$clauses = [];
		foreach ($this->queryParts['where'] as $index => [$boolean, $expression, $value]) {
			$prefix = $index === 0 ? ' WHERE ' : " $boolean ";
			$clauses[] = $prefix . $expression;
			if ($value !== null) {
				$this->params[] = $value;
			}
		}

		if (sizeof($this->queryParts['search']) > 0) {
			$searchWhere = "";
			$searchGroup = "";
			foreach ($this->queryParts['search'] as $index => [$boolean, $group, $keyword]) {
				if ($index == 0) {
					$searchWhere = (sizeof($this->queryParts['where']) == 0) ? ' WHERE ' : " $boolean ";
				}
				$prefix = str_contains($searchGroup, "?") ? " OR " : " ";
				$searchGroup .= $prefix . $group;
				for ($i = 0; $i < substr_count($group, "?"); $i++) {
					if ($keyword !== null) {
						$this->params[] = $keyword;
					}
				}
			}
			$searchWhere .= "(" . $searchGroup . ")";
			$clauses[] = $searchWhere;
		}

		return implode('', $clauses);
	}

	private function buildHavingClause(): string
	{
		if (empty($this->queryParts['having'])) {
			return '';
		}

		$havingParts = [];
		foreach ($this->queryParts['having'] as $having) {
			[$boolean, $condition, $value] = $having;
			$havingParts[] = strtoupper($boolean) . ' ' . $condition;
			$this->params[] = $value;
		}

		$havingString = implode(' ', $havingParts);
		$havingString = preg_replace('/^(AND|OR)\s/', 'HAVING ', $havingString, 1);

		return ' ' . $havingString;
	}

	/**
	 * Gets the query parameters.
	 *
	 * @return array The query parameters.
	 */
	public function getParams()
	{
		return $this->params;
	}

	private function addToQuery($value): string
	{
		if (is_string($value) && $value !== '') {
			return ' ' . $value;
		} elseif (is_array($value) && count($value) > 0) {
			return ' ' . implode(' ', $value);
		} else {
			return '';
		}
	}
}