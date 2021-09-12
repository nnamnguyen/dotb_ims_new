<?php



class MyDocumentsDashlet extends DashletGeneric { 

    public function __construct($id, $def = null)
	{
		global $current_user, $app_strings;
		require('modules/Documents/Dashlets/MyDocumentsDashlet/MyDocumentsDashlet.data.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'Documents');

        $this->searchFields = $dashletData['MyDocumentsDashlet']['searchFields'];
        $this->columns = $dashletData['MyDocumentsDashlet']['columns'];

        $this->seedBean = BeanFactory::newBean('Documents');        
    }

    function displayOptions() {
        $this->processDisplayOptions();

        $types = getDocumentsExternalApiDropDown();
        $this->currentSearchFields['doc_type']['input'] = '<select size="3" multiple="true" name="doc_type[]">'
	                                              . get_select_options_with_id($types, (empty($this->filters['doc_type']) ? '' : $this->filters['doc_type']))
	                                              . '</select>';
        $this->configureSS->assign('searchFields', $this->currentSearchFields);
        return $this->configureSS->fetch($this->configureTpl);
    }
}
