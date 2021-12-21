<?php

namespace Funnelnek\Configuration\Database;

use Funnelnek\Core\Configuration;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Traits\Accessor\FileNameFromPath;

abstract class DatabaseConfiguration extends Configuration
{
    use FileNameFromPath;

    /**
     * @var string 
     * The database namespace.
     */
    final public const DATABASE_NAMESPACE = Settings::APP_NAMESPACE . "\\Database";

    /**
     * @var string
     * The app database directory.
     */
    final public const DATABASE_DIR = Settings::APP_DIR . "/Database";


    /**
     * @var bool 
     * Determines if this configuration is already loaded.
     */
    protected bool   $loaded = false;

    /**
     * @var string 
     * The database character set.
     */
    protected string $charset = "utf8mb4";

    /**
     * The database character set collation.
     */
    protected string $collation = "utf8mb4_general_ci";
}
