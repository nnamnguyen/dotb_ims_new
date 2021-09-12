<?php




/**
 * Metadata context interface
 *
 * Describes the context which the metadata is effective in
 */
interface MetaDataContextInterface
{
    /**
     * Returns the context hash (used for caching context specific metadata).
     *
     * @return array
     */
    public function getHash();

    /**
     * Checks if the given metadata file is valid in the context.
     *
     * @param array $file Metadata file info
     *
     * @return boolean
     */
    public function isValid(array $file);

    /**
     * Compares the priority of two metadata files
     *
     * @param array $a Metadata file info
     * @param array $b Metadata file info
     *
     * @return int
     */
    public function compare(array $a, array $b);
}
