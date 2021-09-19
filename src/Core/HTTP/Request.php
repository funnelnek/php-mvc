<?php

namespace Funnelnek\Core\HTTP;

use Exception;
use Funnelnek\Configuration\Constant\Settings;
use Funnelnek\Core\Attribute\Service\InjectionStrategy;
use Funnelnek\Core\Module\Application;

use function Funnelnek\Core\Utilities\Function\{get_request_body, get_request_cookies};


include_once Settings::ROOT_PATH . '/Core/Function/Cookie.php';
include_once Settings::ROOT_PATH . '/Core/Function/Request.php';

#[InjectionStrategy(strategy: 'singleton')]
final class Request
{
    protected static Request $instance;
    protected RequestHeader $header;
    protected HttpQuery $query;
    protected string $path = '/';
    protected string $url;
    protected string $method;
    protected string $id;
    protected array $body;
    protected array $cookies = [];

    private function __construct()
    {
        if (!isset(self::$instance)) {
            self::$instance = $this;
            $this->id = random_bytes(32);
            $this->header = new RequestHeader();
            $this->query = new HttpQuery();
            $this->path = Application::$path;
            $this->method = Application::$method;
            $this->url = Application::$url;
            $this->cookies = get_request_cookies();
            $this->body = get_request_body();
        }
        return self::$instance;
    }
    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function getHost(): string
    {
        return "";
    }
    public function getCookies()
    {
        return $this->cookies;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
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
