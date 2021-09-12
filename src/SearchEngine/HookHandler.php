<?php


namespace Dotbcrm\Dotbcrm\SearchEngine;

/**
 *
 * Logic hook handler
 *
 */
class HookHandler
{
    /**
     * To be used from logic hooks to index a bean.
     *
     * @param \DotbBean $bean
     * @param string $event Triggered event
     * @param array $arguments Optional arguments
     */
    public function indexBean($bean, $event, $arguments)
    {
        // no cookies if you are not a real bean
        if (!$bean instanceof \DotbBean) {
            $this->getLogger()->fatal("Indexbean: Not bean ->" . var_export(get_class($bean), true));
            return;
        }

        // favorites handling - index the actual bean
        if ($bean instanceof \DotbFavorites) {
            if ($newBean = \BeanFactory::getBean($bean->module, $bean->record_id)) {
                $this->getSearchEngine()->indexBean($newBean);
            }
        }

        $engine = $this->getSearchEngine()->indexBean($bean);
    }

    /**
     * Get search engine object
     * @return \Dotbcrm\Dotbcrm\SearchEngine\SearchEngine
     */
    protected function getSearchEngine()
    {
        return SearchEngine::getInstance();
    }

    /**
     * Get logger object
     * @return \LoggerManager
     */
    protected function getLogger()
    {
        return \LoggerManager::getLogger();
    }
}
