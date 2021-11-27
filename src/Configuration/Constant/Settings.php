<?php

namespace Funnelnek\Configuration\Constant;


class Settings
{
    //Project Configuration
    public const NAMESPACE = 'Funnelnek\\';
    public const APP_NAMESPACE = Settings::NAMESPACE . 'App\\';
    public const CONTROLLER_NAMESPACE = Settings::APP_NAMESPACE . 'Controller\\';
    public const SERVICE_NAMESPACE = Settings::APP_NAMESPACE . 'Service\\';
    public const ROOT_PATH = '/var/www/html';
    public const PUBLIC_PATH = Settings::ROOT_PATH . "/Public";
    public const TEMPLATE_PATH = Settings::ROOT_PATH . '/App/View';
    public const CONTROLLER_PATH = Settings::ROOT_PATH . '/App/Controller';
    public const MIDDLEWARE_PATH = Settings::ROOT_PATH . '/App/Middleware';
    public const ROUTE_PATH = Settings::ROOT_PATH . '/App/Routes';
    public const SERVICE_PATH = Settings::ROOT_PATH . '/App/Service';
    public const CONFIG_PATH = Settings::ROOT_PATH . '/Configuration';

    //Routing Configuration
    public const PATH_PARAM_VAR_PATTERN = '/\{(?<name>[[:alpha:]][[:alnum:]]+?)(?:\:(?<match>[^\}]+))?\}/ig';
    public const PATH_WILDCARD_PATTERN = '/\*/';
    public const PATH_WILDCARD_REPLACEMENT = '[^\\/]';
    public const PARAMS_REPLACEMENT_PATTERN = '(?P<$1>$2)';
    public const DEFAULT_PATH_CAPTURE_PATTERN = '[[:alnum:]-]+';

    // File Uploads
    public const TEMP_FILE_UPLOAD = Settings::ROOT_PATH . '/Cache/File/Repository/Temp';
    public const FILE_STORAGE = Settings::ROOT_PATH . '/Cache/File/Repository/Storage';
}
