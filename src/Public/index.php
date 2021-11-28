<?php require_once '../vendor/autoload.php';

use Funnelnek\Core\Module\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();


// Run Application
// Application::run();
echo $_SERVER["REQUEST_URI"];
