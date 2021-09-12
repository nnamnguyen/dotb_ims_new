<?php


namespace Dotbcrm\Dotbcrm\SearchEngine\Capability\GlobalSearch;

/**
 *
 * Result interface for GlobalSearch capability
 *
 */
interface ResultInterface
{
    /**
     * Get module name
     * @return string
     */
    public function getModule();

    /**
     * Get record id
     * @return string
     */
    public function getId();

    /**
     * Get raw key/value pair data
     * @return array
     */
    public function getData();

    /**
     * Get list of available result fields
     * @return array
     */
    public function getDataFields();

    /**
     * Get score
     * @return float
     */
    public function getScore();

    /**
     * Get highlights
     * @return array
     */
    public function getHighlights();

    /**
     * Get DotbBean
     * @param boolean $retrieve When true, perform a database retrieve
     *      disregarding the data collected from the search engine backend.
     *      For best performance do not use retrieve mode.
     * @return \DotbBean
     */
    public function getBean($retrieve = false);
}
