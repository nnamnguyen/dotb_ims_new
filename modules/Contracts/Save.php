<?php




require_once ('include/formbase.php');



global $timedate;
if(!empty($_POST['expiration_notice_time_meridiem']) && !empty($_POST['expiration_notice_time'])) {
	$_POST['expiration_notice_time'] = $timedate->merge_time_meridiem($_POST['expiration_notice_time'],$timedate->get_time_format(), $_POST['expiration_notice_time_meridiem']);
}


$dotbbean = BeanFactory::newBean('Contracts');
$dotbbean = populateFromPost('', $dotbbean);

if (!$dotbbean->ACLAccess('Save')) {
	ACLController :: displayNoAccess(true);
	dotb_cleanup(true);
}
if(empty($dotbbean->id)) {
    $dotbbean->id = create_guid();
    $dotbbean->new_with_id = true;
}

$check_notify = isset($GLOBALS['check_notify']) ? $GLOBALS['check_notify'] : false;
$dotbbean->save($check_notify);
$return_id = $dotbbean->id;

if (!empty($_POST['type']) && $_POST['type'] !== $_POST['old_type']) {
	//attach all documents from contract type into contract.
	$ctype = BeanFactory::getBean('ContractTypes', $_POST['type']);
	if (!empty($ctype->id)) {
		$ctype->load_relationship('documents');
		$doc = BeanFactory::newBean('Documents');
		$documents=$ctype->documents->getBeans($doc);
		if (count($documents) > 0) {
			$dotbbean->load_relationship('contracts_documents');
			foreach($documents as $document) {
				$dotbbean->contracts_documents->add($document->id,array('document_revision_id'=>$document->document_revision_id));
			}			
		}	
	}
}
handleRedirect($return_id, 'Contracts');
?>