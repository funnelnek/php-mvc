<?php

namespace Funnelnek\Core\Data\Query\Interfaces;

use Funnelnek\Core\Interfaces\IExecutable;
use Funnelnek\Core\Interfaces\IPreparable;


interface IQuery extends IExecutable, IPreparable, INumberRows
{
}
