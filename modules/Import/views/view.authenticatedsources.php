<?php


class ImportViewAuthenticatedSources extends DotbView
{
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
    {
        $sources = $this->getAuthenticatedImportableExternalEAPMs();

        header('Content-Type: application/json');
        echo json_encode($sources);
    }

    private function getAuthenticatedImportableExternalEAPMs()
    {
        return ExternalAPIFactory::getModuleDropDown('Import', false, false);
    }
}
