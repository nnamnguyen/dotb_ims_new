<?php


$popupMeta = array('moduleMain' => 'Team',
						'varName' => 'TEAM',
						'orderBy' => 'teams.private, teams.name',
						'whereClauses' => 
							array('name' => 'teams.name', 'private' => 'teams.private'),
                        'whereStatement'=> "( teams.associated_user_id IS NULL OR teams.associated_user_id NOT IN ( SELECT id FROM users WHERE status = 'Inactive' OR portal_only = '1' ))",
						'searchInputs' =>
							array('name')
						);


?>
 
 