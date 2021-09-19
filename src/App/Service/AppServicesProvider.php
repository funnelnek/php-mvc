<?php

namespace Funnelnek\App\Service;

use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Service\ServiceProvider;
use Funnelnek\Core\Injection\Traits\DependencyInjection;


class AppServicesProvider extends ServiceProvider
{
    use DependencyInjection;
    private static bool $booted = false;
    private static bool $loaded = false;

    /**
     * Method run
     *
     * @return void
     */
    public static function run()
    {
        if (!self::$booted) {
            self::boot();
        }

        if (!self::$loaded) {
            self::start();
        }

        // This is a test remove when done.
        //self::get(RequestService::class);
    }

    /**
     * Method boot
     *
     * @return void
     */
    public static function boot()
    {
        // Registering services in the App's Service folder.
        $services = glob(Settings::SERVICE_PATH . '/*.php', GLOB_ERR | GLOB_NOSORT);
        foreach ($services as $service) {
            echo "Founded File: {$service}<br/>";
            preg_match('/([a-zA-Z]+Service)\.php$/', $service, $match);
            if (!empty($match)) {
                if (self::has($service)) {
                    continue;
                }
                self::register(__NAMESPACE__ . '\\' . $match[1]);
            }
        }
        echo "<br/>";
    }

    public static function register(string $service, $implementation = null, $strategy = "transient")
    {
        self::set($service, $implementation, $strategy);
    }
    private static function start()
    {
    }
}
