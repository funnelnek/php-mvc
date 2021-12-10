<?php

namespace Funnelnek\Configuration\Database;

use Funnelnek\Core\Configuration;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Application;
use Funnelnek\Core\Traits\Accessor\FileNameFromPath;

abstract class DatabaseConfiguration extends Configuration
{
    use FileNameFromPath;

    // Protected Constants
    final protected const DATABASE_NAMESPACE = Settings::APP_NAMESPACE . "\\Database";

    // Public Constants
    final public const DATABASE_DIR = Settings::APP_DIR . "/Database";



    // Protected Instance Properties
    protected bool $loaded = false;
    protected string $charset = "utf8mb4";
    protected string $collation = "utf8mb4_general_ci";
}
