<?php


namespace Dotbcrm\Dotbcrm\Dbal\Query;

use Doctrine\DBAL\Query\QueryBuilder as BaseQueryBuilder;

/**
 * {@inheritDoc}
 */
class QueryBuilder extends BaseQueryBuilder
{
    /**
     * Imports sub-query parameters into itself and returns string representation of the sub-query
     *
     * @param BaseQueryBuilder $subBuilder Sub-query builder
     * @return string
     */
    public function importSubQuery(BaseQueryBuilder $subBuilder)
    {
        $params = $subBuilder->getParameters();
        foreach ($params as $key => $value) {
            $this->createPositionalParameter(
                $value,
                $subBuilder->getParameterType($key)
            );
        }

        return $subBuilder->getSQL();
    }
}
