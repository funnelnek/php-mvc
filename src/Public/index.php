<?php require_once '../vendor/autoload.php';

use Funnelnek\Core\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();


// Run Application
Application::run();

echo phpinfo();
