<?php

namespace Funnelnek\App\Model;

use Funnelnek\Core\Data\Attribute\Definition\ID;
use Funnelnek\Core\Data\Attribute\Definition\UNIQUE;
use Funnelnek\Core\Data\Attribute\Repository\Repository;
use Funnelnek\Core\Data\Model;

#[Repository(name: 'redirects')]
class Redirect extends Model
{
    #[ID]
    public string $id;

    #[UNIQUE]
    public string $url;
}
