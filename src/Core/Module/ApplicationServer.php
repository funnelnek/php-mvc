<?php

namespace Funnelnek\Core\Module;

use Funnelnek\Core\HTTP\Request;
use Funnelnek\Core\HTTP\Response;

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

    public string $ip;
    public string $hostname;
    public string $phpVersion;
    public string $user;
    public string $serverName;
    public string $serverPort;
    public string $serverSoftware;
    public string $protocol;
    public string $publicDir;
    public string $path;
    public string $remoteAddr;
    public string $remotePort;
    public string $url;
    public string $scriptName;
    public string $method;
    public string $query;
    public string $filename;
    public string $fcgiRole;
    public string $httpConnection;
    public string $accepts;
    public string $userAgent;
    public string $httpHost;
    public string $redirectStatus;
    public string $httpLang;

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
