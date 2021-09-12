<?php

class ConnectorApi extends DotbApi
{
    /**
     * internal instance of connector manager
     * @var null
     */
    public $connectorManager = null;

    public function registerApiRest()
    {
        return array(
            'getConnectors' => array(
                'reqType' => 'GET',
                'path' => array('connectors'),
                'pathVars' => array('connectors'),
                'method' => 'getConnectors',
                'shortHelp' => 'Gets connector information',
                'longHelp' => 'include/api/help/connectors_get_help.html',
            ),
        );
    }

    /**
     * gets instance conenctor manager
     * @return ConnectorManager
     */
    public function getConnectorManager()
    {
        if (empty($this->connectorManger)) {
            $this->connectorManager = new ConnectorManager();
        }
        return $this->connectorManager;
    }

    /**
     * gets connector metadata
     *
     * @param ServiceBase $api api object
     * @param array $args arguments passed from api
     * @return array
     */
    public function getConnectors(ServiceBase $api, array $args)
    {
        $cm = $this->getConnectorManager();
        // build cache
        return $cm->getUserConnectors();
    }

    /**
     * handles if given connector hash is valid
     * @param array $args arguments passed from api
     * @throws DotbApiExceptionInvalidHash
     */
    public function validateHash(array $args)
    {
        if (!empty($args['connectorHash'])) {
            $cm = $this->getConnectorManager();
            $valid = $cm->isHashValid($args['connectorHash']);
            if (!$valid) {
                // hash is invalid throw api error for 412
                throw new DotbApiExceptionInvalidHash(
                    'EXCEPTION_CONNECTORS_META_OUT_OF_DATE',
                    null,
                    null,
                    0,
                    'connectors_meta_out_of_date'
                );
            }
        }
    }

}
