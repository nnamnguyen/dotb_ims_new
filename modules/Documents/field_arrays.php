<?php

/*********************************************************************************

 * Description:  Contains field arrays that are used for caching
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$fields_array['Document'] = array ('column_fields' => Array("id"
		,"document_name"
		,"description"
		,"category_id"
		,"subcategory_id"
		,"status_id"
		,"active_date"
		,"exp_date"
		,"date_entered"
		,"date_modified"
		,"created_by"
		,"modified_user_id"
		,"team_id"
		,"document_revision_id"
		,"related_doc_id"
		,"related_doc_rev_id"
		,"is_template"
		,"template_type"
		),
        'list_fields' =>  Array("id"
		,"document_name"
		,"description"
		,"category_id"
		,"subcategory_id"
		,"status_id"
		,"active_date"
		,"exp_date"
		,"date_entered"
		,"date_modified"
		,"created_by"
		,"modified_user_id"
		,"team_id"
		,"document_revision_id"
		,"last_rev_create_date"
		,"last_rev_created_by"
		,"latest_revision"
		,"file_url"
		,"file_url_noimage"
		),
        'required_fields' => Array("document_name"=>1,"active_date"=>1,"revision"=>1),
);
?>