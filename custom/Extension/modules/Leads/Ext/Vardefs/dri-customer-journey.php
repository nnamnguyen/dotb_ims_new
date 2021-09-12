<?php

VardefManager::addTemplate('Leads', 'Lead', 'customer_journey_parent', 'Lead', true);

# This flag disables population of the template id when converting the lead.
# This logic should be managed by \Leads_LogicHook_DRICustomerJourney::convertLead
$dictionary['Lead']['fields']['dri_workflow_template_id']['duplicate_on_record_copy'] = 'no';
