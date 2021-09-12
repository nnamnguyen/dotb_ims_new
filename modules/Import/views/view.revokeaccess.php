<?php


class ImportViewRevokeAccess extends DotbView
{
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
    {
        if (isset($_REQUEST['application'])) {
            $response = array(
                'result' => $this->revokeAccess($_REQUEST['application']),
                'sources' => $this->getAuthenticatedImportableExternalEAPMs(),
            );
        } else {
            $response = array(
                'result' => false,
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private function revokeAccess($application)
    {
        if ($application == 'Google') {
            $api = new ExtAPIGoogle();
            return $api->revokeToken();
        }

        return false;
    }

    private function getAuthenticatedImportableExternalEAPMs()
    {
        return ExternalAPIFactory::getModuleDropDown('Import', false, false);
    }
}
