<?php

namespace Funnelnek\App\Model;

use Funnelnek\Core\Data\Attribute\Definition\BIGINT;
use Funnelnek\Core\Data\Attribute\Definition\BOOLEAN;
use Funnelnek\Core\Data\Attribute\Definition\FOREIGN_KEY;
use Funnelnek\Core\Data\Attribute\Definition\SMALLINT;
use Funnelnek\Core\Data\Attribute\Definition\TINYINT;
use Funnelnek\Core\Data\Attribute\Definition\VARCHAR;
use Funnelnek\Core\Data\Attribute\Definition\UNIQUE;
use Funnelnek\Core\Data\Attribute\Repository\Repository;
use Funnelnek\Core\Data\Model;

#[Repository(name: "menus")]
class Menu extends Model
{
    #[UNIQUE]
    #[VARCHAR(75)]
    public string $name;

    #[UNIQUE]
    #[VARCHAR(255)]
    public string $permalink;

    #[TINYINT]
    public int $position = 0;

    #[BIGINT]
    #[FOREIGN_KEY(repository: "menus", field: "name")]
    public ?int $parent;

    #[BOOLEAN]
    public bool $enabled = true;
}
