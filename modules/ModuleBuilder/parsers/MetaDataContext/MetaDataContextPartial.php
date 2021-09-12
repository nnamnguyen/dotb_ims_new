<?php




/**
 * Partial Context includes only the set of metadata which is not context specific (generic across all projections)
 */
class MetaDataContextPartial implements MetaDataContextInterface
{
    /** {@inheritDoc} */
    public function getHash()
    {
        return 'partial';
    }

    /** {@inheritDoc} */
    public function isValid(array $file)
    {
        // it shouldn't be a context specific file
        return empty($file['params']);
    }

    /** {@inheritDoc} */
    public function compare(array $a, array $b)
    {
        // all files are equal since they are not context specific
        return 0;
    }
}
