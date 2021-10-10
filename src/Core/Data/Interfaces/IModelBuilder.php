<?php

namespace Funnelnek\Core\Data\Interfaces;

interface IModelBuilder
{
    public function property(string $name);
    public function hasKey();
    public function isRequired();
    public function isUnique();
    public function isType();
    public function composite();
}
