<?php

declare(strict_types=1);

namespace Funnelnek\Core\Data\Interfaces;

interface IDatabaseMigration
{
    public function create(): void;
    public function migrate(): void;
    public function rollback(): void;
    public function upgrade(): void;
}
