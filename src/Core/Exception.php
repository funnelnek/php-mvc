<?php

namespace Funnelnek\Core;

use Exception as GlobalException;
use Throwable;

class Exception extends GlobalException
{
    protected const TYPE = "Generic Exception";
    protected const MESSAGE = "(type - err:code): name - message - space";
    protected const CODE = 0;

    protected string $name;

    public function __construct(string $message = "", int $code = 0, protected ?Throwable $previous = null)
    {
        $message = $message ? $message : $this->message ?? "";
        $message = $this->toMessage($message);
        $code = $code ? $code : $this->code ?? 0;
        parent::__construct($message, $code, $previous);
    }

    protected function toMessage(string $message): string
    {
        return trim(str_replace(["type", "name", "code", "message", "space"], [
            static::TYPE,
            $this->name,
            static::CODE,
            $message,
            static::class
        ], static::MESSAGE));
    }

    public function __toString()
    {
        echo "<h3 style=\"font-variant: small-caps; font-family: sans-serif;\">{$this->message}</h3> <pre>{$this->getTraceAsString()}</pre>";
        return static::TYPE;
    }
}
