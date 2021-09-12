<?php


namespace Dotbcrm\Dotbcrm\Bean\Visibility;

use Dotbcrm\Dotbcrm\Bean\Visibility\Layer\Sql;
use Dotbcrm\Dotbcrm\Bean\Visibility\Layer\DotbQuery;

interface Strategy extends DotbQuery, Sql/*, ElasticSearch*/
{
}
