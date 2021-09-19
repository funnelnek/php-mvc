<?php

namespace Funnelnek\Core\Data\Interfaces;

interface IQueryBuilder
{
    public function filter();
    public function where();
    public function include();
    public function select(array $fields);
    public function eq();
    public function ne();
    public function lt();
    public function lte();
    public function gt();
    public function gte();
    public function regex();
    public function in();
    public function not();
    public function notIn();
    public function and();
    public function or();
    public function nor();
    public function exists();
    public function type();
    public function text();
    public function schema();
    public function mod();
    public function expr();
    public function limit();
    public function offset();
    public function slice();
    public function id();
    public function groupBy();
    public function orderBy();
    public function count();
    public function build();
}
