<?php

namespace Funnelnek\Configuration\Constant;


class Settings
{
    //Project Namespace Configuration
    final public const NAMESPACE = 'Funnelnek\\';
    final public const APP_NAMESPACE = Settings::NAMESPACE . 'App\\';
    final public const CONTROLLER_NAMESPACE = Settings::APP_NAMESPACE . 'Controller\\';
    final public const SERVICE_NAMESPACE = Settings::APP_NAMESPACE . 'Service\\';
    final public const CONFIGURATION_NAMESPACE = Settings::APP_NAMESPACE . 'Configuration\\';

    // Project Directories Configuration
    final public const ROOT_DIR = '/var/www/html';
    final public const APP_DIR = Settings::ROOT_DIR . '/App';
    final public const PUBLIC_DIR = Settings::ROOT_DIR . "/Public";
    final public const TEMPLATE_DIR = Settings::APP_DIR . '/View';
    final public const CONTROLLER_DIR = Settings::APP_DIR . '/Controller';
    final public const MIDDLEWARE_DIR = Settings::APP_DIR . '/Middleware';
    final public const ROUTE_DIR = Settings::APP_DIR . '/Routes';
    final public const CONFIG_DIR = Settings::ROOT_DIR . '/Configuration';
    final public const TEMP_FILE_UPLOAD_DIR = Settings::ROOT_DIR . '/Cache/File/Repository/Temp';
    final public const FILE_STORAGE_DIR = Settings::ROOT_DIR . '/Cache/File/Repository/Storage';

    // Project Start-up Files
    final public const APP_INDEX_FILE = Settings::PUBLIC_DIR . "/index.php";
    final public const CONFIGURATION_FILE = Settings::CONFIG_DIR . "/config.php";
    final public const WEB_ROUTES_FILE = Settings::ROOT_DIR . "/www.php";
    final public const API_ROUTES_FILE = Settings::ROOT_DIR . "/api.php";

    final public const ECOMMERCE_ENABLED = true;
    final public const SUPPORTED_FILE_EXTENSIONS_PATTERN = "php|txt|html?|s?css|js[xs]?|tsx?|bin|json|xml|sql|jpe?g|gif|svg|webp|png|[tc]sv|docx?|xlsx?|yml";
}
