<?php require_once '../vendor/autoload.php';

use Dotenv\Parser\Value;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Module\Application;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();


//Run Application
Application::run();
