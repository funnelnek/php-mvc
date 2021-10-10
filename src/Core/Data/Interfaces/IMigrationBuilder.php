<?php

namespace Funnelnek\Core\Data\Interfaces;

interface IMigrationBuilder
{
    public function merge();
    public function createCollection(string $name, array $options = null): IModelBuilder;
    public function update();
    public function delete();
}
