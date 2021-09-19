<?php

namespace Funnelnek\Core\Data;

use Funnelnek\Core\Data\Attribute\Definition\ID;
use Funnelnek\Core\Data\Interfaces\IModel;

class Model implements IModel
{
    #[ID]
    protected int $id;
}
