<?php require_once '../vendor/autoload.php';

use Funnelnek\Core\Module\Application;

use function Funnelnek\Core\Http\Utilities\Cookies\get_response_cookies;
use function Funnelnek\Core\Http\Utilities\get_request_body;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();


// Run Application
// Application::run();
