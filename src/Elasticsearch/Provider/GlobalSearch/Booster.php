<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch;

/**
 *
 * This class is used to apply the different boost values on the fields
 * being queried by the GlobalSearch provider. It supports weighted boost
 * values and boost overrides from the vardefs.
 *
 */
class Booster
{
    /**
     * Default boost value if non defined
     * @var float
     */
    protected $defaultBoost = 1;

    /**
     * Normalization precision
     * @var integer
     */
    protected $precision = 2;

    /**
     * List of mapping types which are weighted
     * @var array
     */
    protected $weighted = array();

    /**
     * Set weighted list
     * @param array $weighted
     */
    public function setWeighted(array $weighted)
    {
        $this->weighted = array_merge($this->weighted, $weighted);
    }

    /**
     * Get boost value from defs or use default
     * @param array $defs Field vardefs
     * @param string $weightId Identifier to apply weighted boost
     * @return float
     */
    public function getBoostValue(array $defs, $weightId)
    {
        if (isset($defs['full_text_search']['boost'])) {
            $boost = (float) $defs['full_text_search']['boost'];
        } else {
            $boost = $this->defaultBoost;
        }
        return $this->normalizeBoost($boost, $weightId);
    }

    /**
     * Normalize boost value
     * @param float $boost
     * @param string $weightId Identifier to apply weighted boost
     * @return float
     */
    private function normalizeBoost($boost, $weightId)
    {
        return round($this->weight($boost, $weightId), $this->precision);
    }

    /**
     * Weight the boost
     * @param float $boost
     * @param string $weightId Identifier to apply weighted boost
     * @return float
     */
    private function weight($boost, $weightId)
    {
        if (isset($this->weighted[$weightId])) {
            $boost = $boost * $this->weighted[$weightId];
        }
        return $boost;
    }
}
