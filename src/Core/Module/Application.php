<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Core\Exception\Exception;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\HTTP\Exception\BadRequestException;
use Funnelnek\Core\Service\Container\ServiceContainer;

final class Application extends ServiceContainer
{
    public const Name = "Funnelnek";
    public const VERSION = "1.0.0";

    private static Application $instance;
    private ApplicationBuilder $builder;

    private function __construct()
    {
        self::$instance = $this;
        $this->builder = new ApplicationBuilder($this);
    }

    //Run Application
    public static function run()
    {
        $rootPath = Settings::PUBLIC_PATH;

        // Check to assure the processing script is the app's main script.
        if (!preg_match("#^${rootPath}\/index.php#", $_SERVER['SCRIPT_FILENAME'])) {
            throw new BadRequestException();
        }

        //Check if the app is already instantiated.
        if (!isset(self::$instance)) {
            $app = new Application();
            $app->boot();
        }

        // echo "<pre>";
        // var_dump(static::$providers);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump(Router::$routes);
        // echo "</pre>";
    }

    /**
     * Method getInstance
     *
     * @return void
     */
    public static function getInstance()
    {
        return self::$instance;
    }
    /**
     * Method boot
     *
     * @return void
     */
    private function boot()
    {
        $this->builder->build();
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
