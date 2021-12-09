<?php

namespace Funnelnek\Core\Application;

use Funnelnek\Core\Application;

class ApplicationServer
{
    public function __construct(private Application $app)
    {
        // Getting server info.
        $this->ip = $_SERVER['SERVER_ADDR'];
        $this->hostname = $_SERVER['HOSTNAME'];
        $this->phpVersion = $_SERVER['PHP_VERSION'];
        $this->serverName = $_SERVER['SERVER_NAME'];
        $this->serverPort = $_SERVER['SERVER_PORT'];
        $this->serverSoftware = $_SERVER['SERVER_SOFTWARE'];
        $this->protocol = $_SERVER['SERVER_PROTOCOL'];
        $this->publicDir = $_SERVER['DOCUMENT_ROOT'];
        $this->path = $_SERVER['PATH_INFO'];
        $this->remoteAddr = $_SERVER['REMOTE_ADDR'];
        $this->remotePort = $_SERVER['REMOTE_PORT'];
        $this->url = $_SERVER['REQUEST_URI'];
        $this->scriptName = $_SERVER['SCRIPT_NAME'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->query = $_SERVER['QUERY_STRING'];
        $this->filename = $_SERVER['SCRIPT_FILENAME'];
        $this->fcgiRole = $_SERVER['FCGI_ROLE'];
        $this->accepts = $_SERVER['HTTP_ACCEPT'];
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->httpHost = $_SERVER['HTTP_HOST'];
        $this->redirectStatus = $_SERVER['REDIRECT_STATUS'];
        $this->httpLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];


        $app->server = $this;
    }

    public readonly string $ip;
    public readonly string $hostname;
    public readonly string $phpVersion;
    public readonly string $user;
    public readonly string $serverName;
    public readonly string $serverPort;
    public readonly string $serverSoftware;
    public readonly string $protocol;
    public readonly string $publicDir;
    public readonly string $path;
    public readonly string $remoteAddr;
    public readonly string $remotePort;
    public readonly string $url;
    public readonly string $scriptName;
    public readonly string $method;
    public readonly string $query;
    public readonly string $filename;
    public readonly string $fcgiRole;
    public readonly string $httpConnection;
    public readonly string $accepts;
    public readonly string $userAgent;
    public readonly string $httpHost;
    public readonly string $redirectStatus;
    public readonly string $httpLang;

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
