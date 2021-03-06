<?php



use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Result;
use Dotbcrm\Dotbcrm\Elasticsearch\Query\Result\ParserInterface;

/**
 * Adapter class to Elastica Result
 *
 *                      !!! DEPRECATION WARNING !!!
 *
 * All code in include/DotbSearchEngine is going to be deprecated in a future
 * release. Do not use any of its APIs for code customizations as there will be
 * no guarantee of support and/or functionality for it. Use the new framework
 * located in the directories src/SearchEngine and src/Elasticsearch.
 *
 * @deprecated
 */
class DotbSeachEngineElasticResult extends DotbSearchEngineAbstractResult
{
    /**
     * @var \Elastica\Result
     */
    protected $elasticaResult;

    /**
     * @var ParserInterface
     */
    protected $resultParser;

    /**
     * @param \Elastica\Result $result
     */
    public function __construct(\Elastica\Result $result)
    {
        $this->elasticaResult = $result;
    }

    /**
     * Get bean
     * @return DotbBean
     */
    public function getBean()
    {
        if (empty($this->bean)) {
            $this->bean = BeanFactory::getBean($this->getModule(), $this->getId());
            $source = $this->elasticaResult->getSource();
            if (isset($source['erased_fields'])) {
                $this->bean->erased_fields = json_decode($source['erased_fields'], true);
            }
            if (empty($this->bean)) {
                $msg = sprintf(
                    "Unable to load bean '%s' for module '%s' for FTS result set",
                    $this->getId(),
                    $this->getModule()
                );
                $GLOBALS['log']->fatal($msg);
            }
        }
        return $this->bean;
    }

    /**
     * Return the id of the
     *
     * @return string
     */
    public function getId()
    {
        return $this->elasticaResult->getId();
    }

    /**
     *
     * @return array
     */
    public function getModule()
    {
        return $this->elasticaResult->getType();
    }

    /**
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->elasticaResult->getScore();
    }

    /**
     * This function returns an array of highlighted key-value pairs.
     *
     * @param maxFields - the number of highlighted fields to return, 0 = all
     *
     * @return array of key value pairs
     */
    public function getHighlightedHitText($maxFields = 0)
    {
        $ret = array();

        if (isset($this->resultParser)) {
            $highlights = $this->resultParser->parseHighlights($this->elasticaResult);
        } else {
            $highlights = $this->elasticaResult->getHighlights();
        }

        if (!empty($highlights) && is_array($highlights)) {
            $highlighter = new DotbSearchEngineHighlighter();
            $highlighter->setModule($this->getModule());
            $ret = $highlighter->processHighlightText($highlights);
            if ($maxFields > 0) {
                $ret = array_slice($ret, 0, $maxFields);
            }
        }

        return $ret;
    }

    /**
     * Return _source
     * @return array
     */
    public function getSource()
    {
        return $this->elasticaResult->getSource();
    }

    /**
     * Set result parser
     * @param ParserInterface $parser
     */
    public function setResultParser(ParserInterface $parser)
    {
        $this->resultParser = $parser;
    }
}
