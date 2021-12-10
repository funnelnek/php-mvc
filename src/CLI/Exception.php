<?php

declare(strict_types=1);

namespace Funnelnek\CLI;

use Exception as GlobalException;
use Throwable;

/**
 * https://joshtronic.com/2013/09/02/how-to-use-colors-in-command-line-output/
 * 
 * Foreground Colors
 * Color	        Code
 * ----------------------
 * Black	        0;30
 * Dark Grey	    1;30
 * Red	            0;31
 * Light Red	    1;31
 * Green	        0;32
 * Light Green	    1;32
 * Brown	        0;33
 * Yellow	        1;33
 * Blue	            0;34
 * Light Blue	    1;34
 * Magenta	        0;35
 * Light Magenta	1;35
 * Cyan	            0;36
 * Light Cyan	    1;36
 * Light Grey	    0;37
 * White	        1;37
 * 
 * 
 * Background Colors
 * Color	    Code
 * ------------------
 * Black	    40
 * Red	        41
 * Green	    42
 * Yellow	    43
 * Blue	        44
 * Magenta	    45
 * Cyan	        46
 * Light Grey	47
 */

abstract class Exception extends GlobalException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function __toString(): string
    {
        return $this->message;
    }
}
