<?php

namespace Funnelnek\Core\Traits\Product\Model;

use Funnelnek\Core\Data\Attribute\Definition\VARCHAR;

class OnlineProduct
{
    #[VARCHAR(length: 255)]
    public string $permalink;
}
