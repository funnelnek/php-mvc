<?php

namespace Funnelnek\Core\Module;


class Cookie
{

    public static function valid(string $key, string $value)
    {
    }

    public function __construct(
        protected string $name,
        protected string $value,
        protected ?CookieConfiguration $configuration = null
    ) {
    }
    public function touch()
    {
    }
}
