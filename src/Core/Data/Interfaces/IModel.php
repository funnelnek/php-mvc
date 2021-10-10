<?php

namespace Funnelnek\Core\Data\Interfaces;

use Funnelnek\Core\Data\Attribute\Definition\ID;


interface IModel
{
    public function save();
    public function delete();
}
