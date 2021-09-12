<?php


/*********************************************************************************

 * Description: view handler for step 1 of the import process
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 ********************************************************************************/

class ImportViewExtimport extends ImportView
{
    protected $pageTitleKey = 'LBL_STEP_DUP_TITLE';
    protected $importSource = FALSE;
    protected $externalSource = '';
    protected $offset = 0;
    protected $recordsPerImport = 10;
    protected $importDone = FALSE;

    public function __construct($bean = null, $view_object_map = array())
    {
        parent::__construct($bean, $view_object_map);
        $this->externalSource = isset($_REQUEST['external_source']) ? $_REQUEST['external_source'] : '';
        $this->offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : '0';
        $this->recordsPerImport = !empty($_REQUEST['records_per_import']) ? $_REQUEST['records_per_import'] : $this->recordsPerImport;
        $this->importSource = $this->getExternalSourceAdapter();
        $this->importSource->setCurrentOffset($this->offset);
        $GLOBALS['log']->fatal("Initiating external source import- source:{$this->externalSource}, offset: {$this->offset}, recordsPerImport: {$this->recordsPerImport}");
    }
 	/**
     * @see DotbView::display()
     */
 	public function display()
    {
        global $mod_strings, $app_strings, $current_user;
        global $dotb_config;

        if($this->importSource === FALSE)
        {
            $GLOBALS['log']->fatal("Found invalid adapter");
            $this->handleImportError($mod_strings['LBL_EXTERNAL_ERROR_NO_SOURCE']);
        }

        $columncount = isset($_REQUEST['columncount']) ? $_REQUEST['columncount'] : '';
        $fieldKeyTranslator = $this->getDotbToExternalFieldMapping($columncount);

        try
        {
            $this->importSource->loadDataSet($this->recordsPerImport);
        }
        catch(Exception $e)
        {
            $GLOBALS['log']->fatal("Unable to import external feed, exception: " . $e->getMessage() );
            $this->handleImportError($mod_strings['LBL_EXTERNAL_ERROR_FEED_CORRUPTED']);
        }

        if (!ImportCacheFiles::ensureWritable())
        {
            $GLOBALS['log']->fatal($mod_strings['LBL_ERROR_IMPORT_CACHE_NOT_WRITABLE']);
            $this->handleImportError($mod_strings['LBL_ERROR_IMPORT_CACHE_NOT_WRITABLE']);
        }

        $importer = new Importer($this->importSource, $this->bean);
        $importer->setFieldKeyTranslator($fieldKeyTranslator);
        $importer->import();

        //Send back our results.
        $metaResult = array('done' => FALSE, 'totalRecordCount' => $this->importSource->getTotalRecordCount() );
        echo json_encode($metaResult);
        dotb_cleanup(TRUE);
    }

    protected function handleImportError($errorMessage)
    {
        $resp = array('totalRecordCount' => -1, 'done' => TRUE, 'error' => $errorMessage);
        echo json_encode($resp);
        dotb_cleanup(TRUE);

    }

    protected function getExternalSourceAdapter()
    {
        if( substr($this->externalSource,7) == 'custom:')
        {
            return $this->getCustomExternalSourceAdapter();
        }
        else
        {
            return new ExternalSourceEAPMAdapter($this->externalSource);
        }
    }

    protected function getCustomExternalSourceAdapter()
    {
        $externalSourceName = ucfirst($this->externalSource);
        $externalSourceClassName = "ExternalSource{$externalSourceName}Adapter";
        $externalSourceFile = "modules/Import/sources/{$externalSourceClassName}.php";
        if(!DotbAutoLoader::requireWithCustom($externalSourceFile)) {
            $GLOBALS['log']->fatal("Unable to load external source adapter, file does not exist: {$externalSourceFile} ");
            return FALSE;
        }

        if( class_exists($externalSourceClassName) )
        {
            $GLOBALS['log']->fatal("Returning external source: $externalSourceClassName");
            return new $externalSourceClassName();
        }
        else
        {
            $GLOBALS['log']->fatal("Unable to load external source adapter class: $externalSourceClassName");
            return FALSE;
        }

    }

    /**
     * Return the user mapping that was constructed during the first page of import.
     *
     * @param  $columncount
     * @return array
     */
    protected function getDotbToExternalFieldMapping($columncount)
    {
        $userMapping = array();
        for($i=0;$i<$columncount;$i++)
        {
            $dotbKeyIndex = 'colnum_' . $i;
            $extKeyIndex = 'extkey_' . $i;
            $dotbKey = $_REQUEST[$dotbKeyIndex];
            //User specified don't map, keep going.
            if($dotbKey == -1)
                continue;

            $extKey = $_REQUEST[$extKeyIndex];
            //$defaultValue = $_REQUEST[$dotbKey];
            $userMapping[$dotbKey] = $extKey;
        }

        return $userMapping;
    }
}
