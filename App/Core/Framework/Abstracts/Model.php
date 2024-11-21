<?php

namespace App\Core\Framework\Abstracts;

use App\Core\Application\Configuration;
use App\Core\Framework\Classes\QueryBuilder;
use App\Core\Framework\Structures\DatabaseResult;
use App\Core\Exceptions\ModelException;
use App\Core\Framework\Interfaces\Modelable;
use App\Core\Framework\Structures\Collection;

abstract class Model implements Modelable
{
	public abstract static function table(): string;
	public abstract static function primaryKey(): string;

	/**
	 * Converts an array to a model
	 * @param array $data The data to convert to a model.
	 * @return static
	 */
	public static function fromArray(array $data): static
	{
		$Model = new static();
		foreach ($data as $key => $value) {
			$Model->$key = $value;
		}
		return $Model;
	}

	/**
	 * Gets all records from the table of the model and return them as a Collection
	 * @return Collection
	 */
	public static function all(): Collection
	{
		$Query = new QueryBuilder();
		$Query->select(static::table(), ["*"]);
		$Result = $Query->execute();
		if (!$Result->result) {
			throw new ModelException($Result->message . " @" . static::table(), 678);
		}
		$Collection = new Collection();
		foreach ($Result->fetch as $Row) {
			$Model = static::fromArray($Row);
			$Collection->addElement($Model);
		}
		return $Collection;
	}

	/**
	 * Gets records from the table of the model and return them as a QueryBuilder
	 * @param array $columns The columns to select from the table.
	 * @return QueryBuilder
	 */
	public static function get(array $columns = ["*"], string $alias = null): QueryBuilder
	{
		$Query = new QueryBuilder();
		$Query->select(static::table(), $columns, $alias);
		return $Query;
	}

	/**
	 * Creates a new record in the table of the model
	 * @param array $data The data to insert into the table.
	 * @return DatabaseResult
	 */
	public static function create(array $data): DatabaseResult
	{
		$Query = new QueryBuilder();
		$Query->insert(static::table(), $data);
		return $Query->execute();
	}

	/**
	 * Inserts records into the table of the model
	 * @param array $data The data to insert into the table.
	 * @return QueryBuilder
	 */
	public static function insert(array $data): QueryBuilder
	{
		$Query = new QueryBuilder();
		$Query->insert(static::table(), $data);
		return $Query;
	}

	/**
	 * Updates records in the table of the model
	 * @param array $data The data to update in the table.
	 * @return QueryBuilder
	 */
	public static function update(array $data): QueryBuilder
	{
		$Query = new QueryBuilder();
		$Query->update(static::table(), $data);
		return $Query;
	}

	/**
	 * Deletes records from the table of the model
	 * @param bool $ignoreFrom Whether to ignore the FROM clause in the DELETE query, defaults to false.
	 * @return QueryBuilder
	 */
	public static function delete(bool $ignoreFrom = false): QueryBuilder
	{
		$Query = new QueryBuilder();
		$Query->delete(static::table(), $ignoreFrom);
		return $Query;
	}

	/**
	 * Sets a property of the model
	 * @param string $key The property to set.
	 * @param mixed $value The value to set the property to.
	 * @throws ModelException if the property does not exist in the model and Configuration::STRICT_MODELS is true.
	 */
	public function set(string $key, $value)
	{
		if (!property_exists(static::class, $key) && Configuration::STRICT_MODELS) {
			throw new ModelException("Property $key does not exist in " . static::class, 678);
		}
		$this->$key = $value;
	}

	/**
	 * Saves the model to the database
	 * @return DatabaseResult
	 */
	public function save(): DatabaseResult
	{
		$Query = new QueryBuilder();
		$data = get_object_vars($this);
		$primaryKey = static::primaryKey();

		if ($primaryKey) {
			if (!isset($this->$primaryKey)) {
				// If primary key is not set, insert new record
				$Query->insert(static::table(), $data);
			} else {
				// Check if record exists
				$existingRecord = (new QueryBuilder())
					->select(static::table(), [$primaryKey])
					->where($primaryKey, $this->$primaryKey)
					->execute();

				if ($existingRecord->result && count($existingRecord->fetch) > 0) {
					// If the record exists, update it
					$Query->update(static::table(), $data)->where($primaryKey, $this->$primaryKey);
				} else {
					// If the record does not exist, insert it
					$Query->insert(static::table(), $data);
				}
			}
		} else {
			// If there is no primary key, always insert a new record
			$Query->insert(static::table(), $data);
		}
		return $Query->execute();
	}

	/**
	 * Finds a single record by its primary key.
	 *
	 * @param mixed $id The primary key value.
	 * @return static|null
	 */
	public static function find($id)
	{
		$primaryKey = static::primaryKey();
		$query = (new QueryBuilder())
			->select(static::table(), ['*'])
			->where($primaryKey, $id)
			->limit(1);

		$result = $query->execute();
		if ($result->result && count($result->fetch) > 0) {
			return static::fromArray($result->fetch[0]);
		}
		return null;
	}

	/**
	 * Defines a one-to-many relationship.
	 *
	 * @param string $related The related model class.
	 * @param string $foreignKey The foreign key in the related model.
	 * @param string $localKey The local key in this model.
	 * @return QueryBuilder
	 */
	public function hasMany(string $related, string $foreignKey, string $localKey)
	{
		$relatedTable = $related::table();
		$localTable = static::table();
		$localKeyValue = $this->$localKey;

		$query = (new QueryBuilder())
			->select($relatedTable, ["$relatedTable.*"])
			->join($localTable, "$relatedTable.$foreignKey", '=', "$localTable.$localKey")
			->where("$localTable.$localKey", $localKeyValue);

		return $query;
	}

	/**
	 * Defines a belongs-to relationship.
	 *
	 * @param string $related The related model class.
	 * @param string $foreignKey The foreign key in this model.
	 * @param string $ownerKey The primary key in the related model.
	 * @return QueryBuilder
	 */
	public function belongsTo(string $related, string $foreignKey, string $ownerKey)
	{
		$relatedTable = $related::table();
		$localTable = static::table();
		$foreignKeyValue = $this->$foreignKey;

		$query = (new QueryBuilder())
			->select($relatedTable, ["$relatedTable.*"])
			->join($localTable, "$localTable.$foreignKey", '=', "$relatedTable.$ownerKey")
			->where("$localTable.$foreignKey", $foreignKeyValue);

		return $query;
	}

	public static function with(array $relations)
	{
		$query = static::get();

		foreach ($relations as $relation) {
			$instance = new static();
			if (method_exists($instance, $relation)) {
				/** @var QueryBuilder $relationQuery */
				$relationQuery = $instance->$relation();
				// Combinar los JOINs
				$query->mergeJoins($relationQuery);
				// Combinar las columnas seleccionadas
				$query->mergeSelects($relationQuery);
			}
		}

		return $query;
	}

	/**
	 * Converts the model to a JSON string
	 * @return string
	 */
	public function __toString()
	{
		return json_encode($this);
	}
}