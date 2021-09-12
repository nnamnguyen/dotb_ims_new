<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Adapter;

use Dotbcrm\Dotbcrm\SearchEngine\Capability\Aggregation\ResultInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Query\Result\ParserInterface;

/**
 *
 * Adapter class for \Elastica\Result
 *
 */
class Result implements ResultInterface
{
    /**
     * @var \Elastica\Result
     */
    protected $result;

    /**
     * @var ParserInterface
     */
    protected $resultParser;

    /**
     * Ctor
     * @param \Elastica\Result $result
     */
    public function __construct(\Elastica\Result $result)
    {
        $this->result = $result;
    }

    /**
     * Set result parser
     * @param ParserInterface $parser
     */
    public function setResultParser(ParserInterface $parser)
    {
        $this->resultParser = $parser;
    }

    /**
     * Overload \Elastica\Result
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args = array())
    {
        return call_user_func_array(array($this->result, $method), $args);
    }

    //// ResultInterface ////

    /**
     * {@inheritdoc}
     */
    public function getModule()
    {
        return $this->result->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->result->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        if ($this->resultParser) {
            return $this->resultParser->parseSource($this->result);
        }
        return $this->result->getSource();
    }

   /**
     * {@inheritdoc}
     */
    public function getDataFields()
    {
        return array_keys($this->getData());
    }

    /**
     * {@inheritdoc}
     */
    public function getScore()
    {
        return $this->result->getScore();
    }

    /**
     * {@inheritdoc}
     */
    public function getHighlights()
    {
        if ($this->resultParser) {
            return $this->resultParser->parseHighlights($this->result);
        }
        return $this->result->getHighlights();
    }

    /**
     * {@inheritdoc}
     */
    public function getBean($retrieve = false)
    {
        // TODO: move this logic into central bean handling for Elasticsearch

        if ($retrieve) {
            $bean = \BeanFactory::getBean($this->getModule(), $this->getId());
        } else {
            $bean = \BeanFactory::newBean($this->getModule());
            $bean->populateFromRow(array_merge(['id' => $this->getId()], $this->getData()), true);
        }

        // Dispatch event for logic hook framework
        $this->dispatchEvent($bean, 'after_retrieve_elastic', array('data' => $this->getData()));

        return $bean;
    }

    /**
     * Dispatch logic hook event on given DotbBean
     * @param \DotbBean $bean
     * @param string $event Logic hook event
     * @param array $args Optional arguments
     */
    protected function dispatchEvent(\DotbBean $bean, $event, array $args = array())
    {
        $bean->call_custom_logic($event, $args);
    }
}
