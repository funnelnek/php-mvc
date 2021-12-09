<?php

declare(strict_types=1);

namespace Funnelnek\Core;

use Funnelnek\App\Services\RouteServiceProvider;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Application\ApplicationBuilder;
use Funnelnek\Core\Application\ApplicationConfiguration;
use Funnelnek\Core\Exception;
use Funnelnek\Core\HTTP\Exception\BadRequestException;
use Funnelnek\Core\Interfaces\IApplication;
use Funnelnek\Core\Router\Router;
use Funnelnek\Core\Service\ServiceContainer;


final class Application extends ServiceContainer implements IApplication
{
    public const VERSION = "1.0.0";
    public const Name = "Funnelnek";

    private static Application $instance;
    private ApplicationBuilder $builder;

    public readonly ApplicationConfiguration $config;

    private function __construct()
    {
        parent::__construct();
        self::$instance = $this;
        $this->instance(self::class, $this);
        $this->config = new ApplicationConfiguration($this);
        $this->builder = new ApplicationBuilder($this);
    }

    //Run Application
    public static function run(): void
    {
        $rootPath = Settings::PUBLIC_DIR;

        // Check to assure the processing script is the app's main entry script (e.g. index.php).
        if (!preg_match("#^${rootPath}\/index.php#", $_SERVER['SCRIPT_FILENAME'])) {
            throw new BadRequestException();
        }

        $app = self::getInstance();
        $app->serve();
    }

    /**
     * getInstance - Gets the singleton application instance.
     *
     * @return Application
     */
    public static function getInstance(): Application
    {
        //Check if the app is already instantiated.
        switch (!isset(self::$instance)) {
            case true:
                $app = new Application();
                $app->boot();
            default:
                return self::$instance;
        }
    }

    public function __get(string $property)
    {
        switch ($property) {
            default:
                if (property_exists($this, $property)) {
                    return $this[$property];
                }
                return null;
        }
    }

    /**
     * Method boot
     *
     * @return void
     */
    private function boot(): Application
    {
        $this->config->load();
        $app = $this->builder;
        $app->build();
        return $this;
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

    private function serve()
    {
        $router = $this->get(RouteServiceProvider::class);
        $router->dispatch();
    }
}
