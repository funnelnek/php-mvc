<?php

namespace Funnelnek\Core\Data;

use Funnelnek\App\Service\DBContextService;
use Funnelnek\Core\Data\DBOperation;
use Funnelnek\Core\Data\Interfaces\IModel;
use Funnelnek\Core\Data\Interfaces\IQueryBuilder;
use Funnelnek\Core\Data\Interfaces\IRepository;
use Funnelnek\Core\Data\SQLBuilder;

abstract class Repository implements IRepository
{
    // protected static DBContextService $DB;
    protected static IQueryBuilder $query;
    protected static IModel $model;
    // private function __construct(DBContextService $db, IModel $model)
    // {
    //     static::$DB = $db;
    //     static::$model = $model;
    // }
    public static function find(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function findOne(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function findAndModify(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function findOneAndUpdate(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function findOneAndDelete(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function findOneAndReplace(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::SELECT);
    }
    public static function create(array $query = [])
    {
        return static::setQuery($query, DBOperation::INSERT);
    }
    public static function insert(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::INSERT);
    }
    public static function insertOne(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::INSERT);
    }
    public static function insertMany(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::INSERT);
    }
    public static function deleteOne(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::DELETE);
    }
    public static function deleteMany(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::DELETE);
    }
    public static function update(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::UPDATE);
    }
    public static function updateOne(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::UPDATE);
    }
    public static function updateMany(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::UPDATE);
    }
    public static function replaceOne(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::UPDATE);
    }
    public static function bulkWrite(array $query = []): IQueryBuilder
    {
        return static::setQuery($query, DBOperation::INSERT);
    }
    public static function startTransaction()
    {
    }
    public static function endTransaction()
    {
    }
    public static function commit()
    {
    }
    public static function rollback()
    {
    }
    public static function exec()
    {
        $prepared = static::$query->build();
    }

    protected static function setQuery(array $query, string $operation)
    {
        return static::$query = new SQLBuilder(query: $query, model: static::$model, operation: DBOperation::SELECT);
    }
}
