<?php

namespace Funnelnek\Core\Module;

use Funnelnek\App\Service\AppServicesProvider;
use Funnelnek\Core\Exception\Exception;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\HTTP\Exception\BadRequestException;
use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;
use Funnelnek\Core\Injection\Traits\DependencyInjection;
use Funnelnek\Core\Module\Configuration;
use Funnelnek\Core\Router\Router;

final class Application
{
    use DependencyInjection;
    private function __construct()
    {
        self::$instance = $this;

        new ApplicationServer($this);
        new Configuration($this);

        $this->builder = new ApplicationBuilder($this);
    }

    public const Name = "Funnelnek";
    public const VERSION = "1.0.0";
    public Configuration $configuration;
    public ApplicationServer $server;
    public Router $router;
    public Request $request;
    public Response $response;

    private static Application $instance;
    private ApplicationBuilder $builder;



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
