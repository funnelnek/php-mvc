<?php

namespace Funnelnek\App\Model;

use Funnelnek\Core\Data\Attribute\Definition\UNIQUE;
use Funnelnek\Core\Data\Attribute\Definition\VARCHAR;
use Funnelnek\Core\Data\Model;

class Site extends Model
{
    #[UNIQUE]
    #[VARCHAR('100')]
    public string $name;

    #[UNIQUE]
    #[VARCHAR(200)]
    public string $hostname;

    #[VARCHAR(255)]
    public string $logo;

    #[VARCHAR(75)]
    public string $slogan;

    #[VARCHAR(255)]
    public string $document_root;
}
