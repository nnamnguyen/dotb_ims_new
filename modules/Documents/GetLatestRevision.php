<?php

//updates the link between contract and document with latest revision of
//the document and sends the control back to calling page.

require_once('include/formbase.php');
if (!empty($_REQUEST['record'])) {

	$document = BeanFactory::getBean('Documents', $_REQUEST['record']);
	if (!empty($document->document_revision_id) && !empty($_REQUEST['get_latest_for_id']))  {
        $query = 'UPDATE linked_documents'
            . ' SET document_revision_id = ' . $document->db->quoted($document->document_revision_id)
            . ', date_modified = ' . $document->db->quoted(TimeDate::getInstance()->nowDb())
            . ' WHERE id = ' . $document->db->quoted($_REQUEST['get_latest_for_id']);
		$document->db->query($query);
	}	
}
handleRedirect();
