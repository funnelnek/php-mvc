<?php

namespace Funnelnek\Core\HTTP;

class ActionResult
{
    public function __construct(
        protected int $status,
        protected string $view,
        protected $data
    ) {
    }
}
