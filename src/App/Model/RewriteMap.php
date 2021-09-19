<?php

namespace Funnelnek\App\Model;

use Funnelnek\Core\Data\Attribute\Definition\FOREIGN_KEY;
use Funnelnek\Core\Data\Attribute\Definition\ID;
use Funnelnek\Core\Data\Attribute\Definition\REQUIRED;
use Funnelnek\Core\Data\Attribute\Definition\UNIQUE;
use Funnelnek\Core\Data\Attribute\Repository\Repository;
use Funnelnek\Core\Data\Model;

#[Repository(name: 'rewrites')]
class RewriteMap extends Model
{
    #[ID]
    #[REQUIRED]
    public string $id;

    #[REQUIRED]
    public string $type;

    #[REQUIRED]
    public string $url;

    #[REQUIRED]
    public string $rewrite;

    #[REQUIRED]
    public int $status;

    #[REQUIRED]
    #[UNIQUE]
    #[FOREIGN_KEY('pages', 'id')]
    public string $pageId;
}
