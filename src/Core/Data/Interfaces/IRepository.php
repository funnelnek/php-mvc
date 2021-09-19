<?php

namespace Funnelnek\Core\Data\Interfaces;

use Funnelnek\Core\Data\DBSet;
use Funnelnek\Core\Module\QueryBuilder;

interface IRepository
{

    public static function find(array $query = []): IQueryBuilder;
    public static function findOne(array $query = []): IQueryBuilder;
    public static function findAndModify(array $query = []): IQueryBuilder;
    public static function findOneAndUpdate(array $query = []): IQueryBuilder;
    public static function findOneAndDelete(array $query = []): IQueryBuilder;
    public static function findOneAndReplace(array $query = []): IQueryBuilder;
    public static function create(array $query = []);
    public static function insert(array $query = []): IQueryBuilder;
    public static function insertOne(array $query = []): IQueryBuilder;
    public static function insertMany(array $query = []): IQueryBuilder;
    public static function deleteOne(array $query = []): IQueryBuilder;
    public static function deleteMany(array $query = []): IQueryBuilder;
    public static function update(array $query = []): IQueryBuilder;
    public static function updateOne(array $query = []): IQueryBuilder;
    public static function updateMany(array $query = []): IQueryBuilder;
    public static function replaceOne(array $query = []): IQueryBuilder;
    public static function bulkWrite(array $query = []): IQueryBuilder;
    public static function startTransaction();
    public static function endTransaction();
    public static function commit();
    public static function rollback();
    public static function exec();
}
