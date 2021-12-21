<?php

declare(strict_types=1);

namespace Funnelnek\Core\Data\ORM;

use DateTime;
use Funnelnek\Core\Data\SQL\DataType\Date;

interface IDataMapper
{
    public function map($column, $property): mixed;
    public function double(): float;
    public function int(): int;
    public function string(): string;
    public function float(): float;
    public function boolean(): bool;
    public function array(): array;
    public function object(): object;
    public function null();
    public function enum(): mixed;
    public function blob(): mixed;
    public function uuid(): string;
    public function date(): string|Date;
    public function datetime(): string|DateTime;
    public function time(): string|DateTime;
    public function timestamp(): string|DateTime;
    public function year(): string|Date;
    public function regex(): string;
    public function decimal(): float;
    public function set(): mixed;
}
