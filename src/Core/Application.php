<?php

namespace Funnelnek\Core;

use Funnelnek\App\Services\RouteServiceProvider;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Application\ApplicationBuilder;
use Funnelnek\Core\Application\ApplicationConfiguration;
use Funnelnek\Core\Exception;
use Funnelnek\Core\HTTP\Exception\BadRequestException;
use Funnelnek\Core\Interfaces\IApplication;
use Funnelnek\Core\Service\Container\ServiceContainer;


final class Application extends ServiceContainer implements IApplication
{
    public const Name = "Funnelnek";
    public const VERSION = "1.0.0";

    private static Application $instance;
    private ApplicationBuilder $builder;
    private ?ApplicationConfiguration $config;

    private function __construct()
    {
        self::$instance = $this;
        $this->instance(self::class, $this);
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

    /**
     * Method boot
     *
     * @return void
     */
    private function boot(): Application
    {
        $app = $this->builder->config();
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
        echo "<br/> Hello Application Server! <br/>";
        // $router = $this->get(RouteServiceProvider::class);
        // $router->dispatch();
    }
}
