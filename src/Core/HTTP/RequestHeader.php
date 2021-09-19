<?php

namespace Funnelnek\Core\HTTP;

use Funnelnek\Configuration\Constant\Settings;

include Settings::ROOT_PATH . '/Core/Function/CacheControl.php';

use function Funnelnek\Core\Utilities\Function\{get_request_cache_control};


class RequestHeader
{

    private array $cookies = [];
    private array $headers = [];
    private string $contentType;
    private CacheControl $cache;

    public function __construct()
    {
        $this->headers = apache_request_headers();
        $this->cache = new CacheControl(get_request_cache_control());
    }
    public function get(string $header)
    {
        return $this->headers[$header];
    }

    public function etag()
    {
    }

    public function cors()
    {
    }

    /**
     * Method accepts
     *
     * @param string $mime [explicite description]
     *
     * @return void
     */
    public function accepts(string $mime)
    {
        return str_contains($this->header['Accept'], $mime);
    }

    public function getContentType(string $accepts)
    {
        $accepting = explode(',', $accepts);
        foreach ($accepting as $accept) {
        }
    }
}
