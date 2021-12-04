<?php

namespace Funnelnek\Configuration\Constant;


class Settings
{
    //Project Namespace Configuration
    public const NAMESPACE = 'Funnelnek\\';
    public const APP_NAMESPACE = Settings::NAMESPACE . 'App\\';
    public const CONTROLLER_NAMESPACE = Settings::APP_NAMESPACE . 'Controller\\';
    public const SERVICE_NAMESPACE = Settings::APP_NAMESPACE . 'Service\\';

    // Project Directories Configuration
    public const ROOT_DIR = '/var/www/html';
    public const PUBLIC_DIR = Settings::ROOT_DIR . "/Public";
    public const TEMPLATE_DIR = Settings::ROOT_DIR . '/App/View';
    public const CONTROLLER_DIR = Settings::ROOT_DIR . '/App/Controller';
    public const MIDDLEWARE_DIR = Settings::ROOT_DIR . '/App/Middleware';
    public const ROUTE_DIR = Settings::ROOT_DIR . '/App/Routes';
    public const CONFIG_DIR = Settings::ROOT_DIR . '/Configuration';

    // File Uploads Directories
    public const TEMP_FILE_UPLOAD = Settings::ROOT_DIR . '/Cache/File/Repository/Temp';
    public const FILE_STORAGE = Settings::ROOT_DIR . '/Cache/File/Repository/Storage';
}
