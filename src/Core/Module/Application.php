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
        // Getting server info.
        self::$instance = $this;
        self::$ip = $_SERVER['SERVER_ADDR'];
        self::$hostname = $_SERVER['HOSTNAME'];
        self::$phpVersion = $_SERVER['PHP_VERSION'];
        self::$user = $_SERVER['USER'];
        self::$serverName = $_SERVER['SERVER_NAME'];
        self::$serverPort = $_SERVER['SERVER_PORT'];
        self::$serverSoftware = $_SERVER['SERVER_SOFTWARE'];
        self::$protocol = $_SERVER['SERVER_PROTOCOL'];
        self::$publicDir = $_SERVER['DOCUMENT_ROOT'];
        self::$path = $_SERVER['PATH_INFO'];
        self::$remoteAddr = $_SERVER['REMOTE_ADDR'];
        self::$remotePort = $_SERVER['REMOTE_PORT'];
        self::$url = $_SERVER['REQUEST_URI'];
        self::$scriptName = $_SERVER['SCRIPT_NAME'];
        self::$method = $_SERVER['REQUEST_METHOD'];
        self::$query = $_SERVER['QUERY_STRING'];
        self::$filename = $_SERVER['SCRIPT_FILENAME'];
        self::$fcgiRole = $_SERVER['FCGI_ROLE'];
        self::$accepts = $_SERVER['HTTP_ACCEPT'];
        self::$userAgent = $_SERVER['HTTP_USER_AGENT'];
        self::$httpHost = $_SERVER['HTTP_HOST'];
        self::$redirectStatus = $_SERVER['REDIRECT_STATUS'];
        self::$httpLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        self::$configuration = new Configuration($this);

        $this->builder = new ApplicationBuilder($this);
    }

    public const Name = "Funnelnek";
    public const VERSION = "1.0.0";
    public static Configuration $configuration;
    public static string $ip;
    public static string $hostname;
    public static string $phpVersion;
    public static string $user;
    public static string $serverName;
    public static string $serverPort;
    public static string $serverSoftware;
    public static string $protocol;
    public static string $publicDir;
    public static string $path;
    public static string $remoteAddr;
    public static string $remotePort;
    public static string $url;
    public static string $scriptName;
    public static string $method;
    public static string $query;
    public static string $filename;
    public static string $fcgiRole;
    public static string $httpConnection;
    public static string $accepts;
    public static string $userAgent;
    public static string $httpHost;
    public static string $redirectStatus;
    public static string $httpLang;
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
        // Run app's services.
        //AppServicesProvider::run();
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

    private function loadControllers()
    {
        $controllers = glob(Settings::CONTROLLER_PATH . '/*.php', GLOB_ERR | GLOB_NOSORT);
        $namespace = Settings::CONTROLLER_NAMESPACE;
        foreach ($controllers as $controller) {
            preg_match('/([a-zA-Z]+Controller)\.php$/', $controller, $match);
            $control =  $namespace . $match[1];
        }
    }

    public function __get($prop)
    {
        switch ($prop) {
            case "pathinfo":
                return self::$path;
            case "config":
                return self::$configuration;
            case "isInstalled":
                return self::$configuration->isInstalled();
            default:
                throw new Exception("");
        }
    }
}
