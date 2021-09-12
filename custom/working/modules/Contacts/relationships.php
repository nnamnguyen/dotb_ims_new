<?php

$relationships = array (
  'accounts_contacts' => 
  array (
    'name' => 'accounts_contacts',
    'table' => 'accounts_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'account_id' => 
      array (
        'name' => 'account_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'primary_account' => 
      array (
        'name' => 'primary_account',
        'type' => 'bool',
        'default' => '0',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'required' => false,
        'default' => '0',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'accounts_contactspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_account_contact',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'account_id',
          1 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_contid_del_accid',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'deleted',
          2 => 'account_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'accounts_contacts' => 
      array (
        'lhs_module' => 'Accounts',
        'lhs_table' => 'accounts',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'accounts_contacts',
        'join_key_lhs' => 'account_id',
        'join_key_rhs' => 'contact_id',
        'primary_flag_column' => 'primary_account',
        'primary_flag_side' => 'rhs',
        'primary_flag_default' => true,
      ),
    ),
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'accounts_contacts',
    'join_key_lhs' => 'account_id',
    'join_key_rhs' => 'contact_id',
    'primary_flag_column' => 'primary_account',
    'primary_flag_side' => 'rhs',
    'primary_flag_default' => true,
    'readonly' => true,
    'relationship_name' => 'accounts_contacts',
    'rhs_subpanel' => 'ForAccounts',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'calls_contacts' => 
  array (
    'name' => 'calls_contacts',
    'table' => 'calls_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => '36',
      ),
      'call_id' => 
      array (
        'name' => 'call_id',
        'type' => 'id',
        'len' => '36',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
        'len' => '36',
      ),
      'required' => 
      array (
        'name' => 'required',
        'type' => 'varchar',
        'len' => '1',
        'default' => '1',
      ),
      'accept_status' => 
      array (
        'name' => 'accept_status',
        'type' => 'varchar',
        'len' => '25',
        'default' => 'none',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'calls_contactspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_call_call',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'call_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_call_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_call_contact',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'call_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'calls_contacts' => 
      array (
        'lhs_module' => 'Calls',
        'lhs_table' => 'calls',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'calls_contacts',
        'join_key_lhs' => 'call_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Calls',
    'lhs_table' => 'calls',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'calls_contacts',
    'join_key_lhs' => 'call_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'calls_contacts',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => 'ForContactsCalls',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_bugs' => 
  array (
    'name' => 'contacts_bugs',
    'table' => 'contacts_bugs',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'bug_id' => 
      array (
        'name' => 'bug_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '50',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contacts_bugspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_bug_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_bug_bug',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'bug_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_contact_bug',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'bug_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contacts_bugs' => 
      array (
        'lhs_module' => 'Contacts',
        'lhs_table' => 'contacts',
        'lhs_key' => 'id',
        'rhs_module' => 'Bugs',
        'rhs_table' => 'bugs',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'contacts_bugs',
        'join_key_lhs' => 'contact_id',
        'join_key_rhs' => 'bug_id',
      ),
    ),
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Bugs',
    'rhs_table' => 'bugs',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'contacts_bugs',
    'join_key_lhs' => 'contact_id',
    'join_key_rhs' => 'bug_id',
    'readonly' => true,
    'relationship_name' => 'contacts_bugs',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_cases' => 
  array (
    'name' => 'contacts_cases',
    'table' => 'contacts_cases',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'case_id' => 
      array (
        'name' => 'case_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '50',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contacts_casespk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_case_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_case_case',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'case_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_contacts_cases',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'case_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contacts_cases' => 
      array (
        'lhs_module' => 'Contacts',
        'lhs_table' => 'contacts',
        'lhs_key' => 'id',
        'rhs_module' => 'Cases',
        'rhs_table' => 'cases',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'contacts_cases',
        'join_key_lhs' => 'contact_id',
        'join_key_rhs' => 'case_id',
      ),
    ),
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Cases',
    'rhs_table' => 'cases',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'contacts_cases',
    'join_key_lhs' => 'contact_id',
    'join_key_rhs' => 'case_id',
    'readonly' => true,
    'relationship_name' => 'contacts_cases',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_users' => 
  array (
    'name' => 'contacts_users',
    'table' => 'contacts_users',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'user_id' => 
      array (
        'name' => 'user_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contacts_userspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_users_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_users_user',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'user_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_contacts_users',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'user_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contacts_users' => 
      array (
        'lhs_module' => 'Users',
        'lhs_table' => 'users',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'user-based',
        'join_table' => 'contacts_users',
        'join_key_lhs' => 'user_id',
        'join_key_rhs' => 'contact_id',
        'user_field' => 'user_id',
      ),
    ),
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'contacts_users',
    'join_key_lhs' => 'user_id',
    'join_key_rhs' => 'contact_id',
    'user_field' => 'user_id',
    'readonly' => true,
    'relationship_name' => 'contacts_users',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'meetings_contacts' => 
  array (
    'name' => 'meetings_contacts',
    'table' => 'meetings_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => '36',
      ),
      'meeting_id' => 
      array (
        'name' => 'meeting_id',
        'type' => 'id',
        'len' => '36',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
        'len' => '36',
      ),
      'required' => 
      array (
        'name' => 'required',
        'type' => 'varchar',
        'len' => '1',
        'default' => '1',
      ),
      'accept_status' => 
      array (
        'name' => 'accept_status',
        'type' => 'varchar',
        'len' => '25',
        'default' => 'none',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'meetings_contactspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_mtg_mtg',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'meeting_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_mtg_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_meeting_contact',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'meeting_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'meetings_contacts' => 
      array (
        'lhs_module' => 'Meetings',
        'lhs_table' => 'meetings',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'meetings_contacts',
        'join_key_lhs' => 'meeting_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Meetings',
    'lhs_table' => 'meetings',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'meetings_contacts',
    'join_key_lhs' => 'meeting_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'meetings_contacts',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => 'ForContactsMeetings',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_contacts' => 
  array (
    'name' => 'opportunities_contacts',
    'table' => 'opportunities_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '50',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'opportunities_contactspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_opp_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_opp_opp',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'opportunity_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_opportunities_contacts',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'opportunity_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'opportunities_contacts' => 
      array (
        'lhs_module' => 'Opportunities',
        'lhs_table' => 'opportunities',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'opportunities_contacts',
        'join_key_lhs' => 'opportunity_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'opportunities_contacts',
    'join_key_lhs' => 'opportunity_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'opportunities_contacts',
    'rhs_subpanel' => 'ForOpportunities',
    'lhs_subpanel' => 'ForContactsOpportunities',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'projects_contacts' => 
  array (
    'name' => 'projects_contacts',
    'table' => 'projects_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'project_id' => 
      array (
        'name' => 'project_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'projects_contacts_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_proj_con_proj',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'project_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_proj_con_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      3 => 
      array (
        'name' => 'projects_contacts_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'project_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'projects_contacts' => 
      array (
        'lhs_module' => 'Project',
        'lhs_table' => 'project',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'projects_contacts',
        'join_key_lhs' => 'project_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Project',
    'lhs_table' => 'project',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'projects_contacts',
    'join_key_lhs' => 'project_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'projects_contacts',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'quotes_contacts_shipto' => 
  array (
    'name' => 'quotes_contacts_shipto',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'id',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'true_relationship_type' => 'one-to-many',
    'join_table' => 'quotes_contacts',
    'join_key_rhs' => 'quote_id',
    'join_key_lhs' => 'contact_id',
    'relationship_role_column' => 'contact_role',
    'relationship_role_column_value' => 'Ship To',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'quote_id' => 
      array (
        'name' => 'quote_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '20',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'quotes_contacts_shipto',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'quotes_contacts_billto' => 
  array (
    'name' => 'quotes_contacts_billto',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'id',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'true_relationship_type' => 'one-to-many',
    'join_table' => 'quotes_contacts',
    'join_key_rhs' => 'quote_id',
    'join_key_lhs' => 'contact_id',
    'relationship_role_column' => 'contact_role',
    'relationship_role_column_value' => 'Bill To',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'quote_id' => 
      array (
        'name' => 'quote_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '20',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'quotes_contacts_billto',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contracts_contacts' => 
  array (
    'name' => 'contracts_contacts',
    'table' => 'contracts_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'contract_id' => 
      array (
        'name' => 'contract_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contracts_contacts_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'contracts_contacts_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'contract_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contracts_contacts' => 
      array (
        'lhs_module' => 'Contracts',
        'lhs_table' => 'contracts',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'contracts_contacts',
        'join_key_lhs' => 'contract_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Contracts',
    'lhs_table' => 'contracts',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'contracts_contacts',
    'join_key_lhs' => 'contract_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'contracts_contacts',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_dataprivacy' => 
  array (
    'name' => 'contacts_dataprivacy',
    'table' => 'contacts_dataprivacy',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'dataprivacy_id' => 
      array (
        'name' => 'dataprivacy_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contacts_dataprivacypk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_dataprivacy_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_dataprivacy_dataprivacy',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'dataprivacy_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_contacts_dataprivacy',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'dataprivacy_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contacts_dataprivacy' => 
      array (
        'lhs_module' => 'Contacts',
        'lhs_table' => 'contacts',
        'lhs_key' => 'id',
        'rhs_module' => 'DataPrivacy',
        'rhs_table' => 'data_privacy',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'contacts_dataprivacy',
        'join_key_lhs' => 'contact_id',
        'join_key_rhs' => 'dataprivacy_id',
      ),
    ),
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'DataPrivacy',
    'rhs_table' => 'data_privacy',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'contacts_dataprivacy',
    'join_key_lhs' => 'contact_id',
    'join_key_rhs' => 'dataprivacy_id',
    'readonly' => true,
    'relationship_name' => 'contacts_dataprivacy',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'documents_contacts' => 
  array (
    'name' => 'documents_contacts',
    'true_relationship_type' => 'many-to-many',
    'relationships' => 
    array (
      'documents_contacts' => 
      array (
        'lhs_module' => 'Documents',
        'lhs_table' => 'documents',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'documents_contacts',
        'join_key_lhs' => 'document_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'table' => 'documents_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => 36,
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => true,
      ),
      'document_id' => 
      array (
        'name' => 'document_id',
        'type' => 'id',
        'len' => 36,
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
        'len' => 36,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'documents_contactsspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'documents_contacts_contact_id',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contact_id',
          1 => 'document_id',
        ),
      ),
      2 => 
      array (
        'name' => 'documents_contacts_document_id',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'document_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'lhs_module' => 'Documents',
    'lhs_table' => 'documents',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'documents_contacts',
    'join_key_lhs' => 'document_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'documents_contacts',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_cases_1' => 
  array (
    'name' => 'contacts_cases_1',
    'true_relationship_type' => 'one-to-many',
    'from_studio' => true,
    'relationships' => 
    array (
      'contacts_cases_1' => 
      array (
        'lhs_module' => 'Contacts',
        'lhs_table' => 'contacts',
        'lhs_key' => 'id',
        'rhs_module' => 'Cases',
        'rhs_table' => 'cases',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'contacts_cases_1_c',
        'join_key_lhs' => 'contacts_cases_1contacts_ida',
        'join_key_rhs' => 'contacts_cases_1cases_idb',
      ),
    ),
    'table' => 'contacts_cases_1_c',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'default' => 0,
      ),
      'contacts_cases_1contacts_ida' => 
      array (
        'name' => 'contacts_cases_1contacts_ida',
        'type' => 'id',
      ),
      'contacts_cases_1cases_idb' => 
      array (
        'name' => 'contacts_cases_1cases_idb',
        'type' => 'id',
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'idx_contacts_cases_1_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_contacts_cases_1_ida1_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contacts_cases_1contacts_ida',
          1 => 'deleted',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_contacts_cases_1_idb2_deleted',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contacts_cases_1cases_idb',
          1 => 'deleted',
        ),
      ),
      3 => 
      array (
        'name' => 'contacts_cases_1_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contacts_cases_1cases_idb',
        ),
      ),
    ),
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Cases',
    'rhs_table' => 'cases',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'contacts_cases_1_c',
    'join_key_lhs' => 'contacts_cases_1contacts_ida',
    'join_key_rhs' => 'contacts_cases_1cases_idb',
    'readonly' => true,
    'relationship_name' => 'contacts_cases_1',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'is_custom' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
  ),
  'contacts_modified_user' => 
  array (
    'name' => 'contacts_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'modified_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contacts_modified_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_created_by' => 
  array (
    'name' => 'contacts_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'created_by',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contacts_created_by',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_activities' => 
  array (
    'name' => 'contact_activities',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Activities',
    'rhs_table' => 'activities',
    'rhs_key' => 'id',
    'rhs_vname' => 'LBL_ACTIVITY_STREAM',
    'relationship_type' => 'many-to-many',
    'join_table' => 'activities_users',
    'join_key_lhs' => 'parent_id',
    'join_key_rhs' => 'activity_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'activity_id' => 
      array (
        'name' => 'activity_id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'parent_type' => 
      array (
        'name' => 'parent_type',
        'type' => 'varchar',
        'len' => 100,
      ),
      'parent_id' => 
      array (
        'name' => 'parent_id',
        'type' => 'id',
        'len' => 36,
      ),
      'fields' => 
      array (
        'name' => 'fields',
        'type' => 'json',
        'dbType' => 'longtext',
        'required' => true,
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'vname' => 'LBL_DELETED',
        'type' => 'bool',
        'default' => '0',
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'contact_activities',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_direct_reports' => 
  array (
    'name' => 'contact_direct_reports',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'reports_to_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_direct_reports',
    'rhs_subpanel' => 'ForContacts',
    'lhs_subpanel' => 'ForContacts',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_leads' => 
  array (
    'name' => 'contact_leads',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Leads',
    'rhs_table' => 'leads',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_leads',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_notes' => 
  array (
    'name' => 'contact_notes',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Notes',
    'rhs_table' => 'notes',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_notes',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_notes_parent' => 
  array (
    'name' => 'contact_notes_parent',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Notes',
    'rhs_table' => 'notes',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'readonly' => true,
    'relationship_name' => 'contact_notes_parent',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_calls_parent' => 
  array (
    'name' => 'contact_calls_parent',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Calls',
    'rhs_table' => 'calls',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'readonly' => true,
    'relationship_name' => 'contact_calls_parent',
    'rhs_subpanel' => 'ForContactsCalls',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_meetings_parent' => 
  array (
    'name' => 'contact_meetings_parent',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Meetings',
    'rhs_table' => 'meetings',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'readonly' => true,
    'relationship_name' => 'contact_meetings_parent',
    'rhs_subpanel' => 'ForContactsMeetings',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_tasks' => 
  array (
    'name' => 'contact_tasks',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Tasks',
    'rhs_table' => 'tasks',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_tasks',
    'rhs_subpanel' => 'ForContactsAll_tasks',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_tasks_parent' => 
  array (
    'name' => 'contact_tasks_parent',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Tasks',
    'rhs_table' => 'tasks',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'readonly' => true,
    'relationship_name' => 'contact_tasks_parent',
    'rhs_subpanel' => 'ForContactsAll_tasks',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_assigned_user' => 
  array (
    'name' => 'contacts_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'assigned_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contacts_assigned_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_products' => 
  array (
    'name' => 'contact_products',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'Products',
    'rhs_table' => 'products',
    'rhs_key' => 'contact_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_products',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_following' => 
  array (
    'name' => 'contacts_following',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'subscriptions',
    'join_key_lhs' => 'created_by',
    'join_key_rhs' => 'parent_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Contacts',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'contacts_following',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_favorite' => 
  array (
    'name' => 'contacts_favorite',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'dotbfavorites',
    'join_key_lhs' => 'modified_user_id',
    'join_key_rhs' => 'record_id',
    'relationship_role_column' => 'module',
    'relationship_role_column_value' => 'Contacts',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'contacts_favorite',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_dri_workflow_templates' => 
  array (
    'name' => 'contact_dri_workflow_templates',
    'relationship_type' => 'one-to-many',
    'lhs_key' => 'id',
    'lhs_module' => 'DRI_Workflow_Templates',
    'lhs_table' => 'dri_workflow_templates',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'dri_workflow_template_id',
    'readonly' => true,
    'relationship_name' => 'contact_dri_workflow_templates',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contact_smses' => 
  array (
    'name' => 'contact_smses',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'lhs_key' => 'id',
    'rhs_module' => 'C_SMS',
    'rhs_table' => 'c_sms',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contact_smses',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'campaign_contacts' => 
  array (
    'name' => 'campaign_contacts',
    'lhs_module' => 'Campaigns',
    'lhs_table' => 'campaigns',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'campaign_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'campaign_contacts',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'projects_contacts_resources' => 
  array (
    'name' => 'projects_contacts_resources',
    'lhs_module' => 'Project',
    'lhs_table' => 'project',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'project_resources',
    'join_key_lhs' => 'project_id',
    'join_key_rhs' => 'resource_id',
    'relationship_role_column' => 'resource_type',
    'relationship_role_column_value' => 'Contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'vname' => 'LBL_ID',
        'required' => true,
        'type' => 'id',
        'reportable' => false,
        'comment' => 'Unique identifier',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'vname' => 'LBL_DATE_MODIFIED',
        'type' => 'datetime',
        'required' => true,
        'comment' => 'Date record last modified',
      ),
      'modified_user_id' => 
      array (
        'name' => 'modified_user_id',
        'rname' => 'user_name',
        'id_name' => 'modified_user_id',
        'vname' => 'LBL_MODIFIED_USER_ID',
        'type' => 'assigned_user_name',
        'table' => 'users',
        'isnull' => false,
        'dbType' => 'id',
        'reportable' => true,
        'comment' => 'User who last modified record',
      ),
      'created_by' => 
      array (
        'name' => 'created_by',
        'rname' => 'user_name',
        'id_name' => 'modified_user_id',
        'vname' => 'LBL_CREATED_BY',
        'type' => 'assigned_user_name',
        'table' => 'users',
        'isnull' => false,
        'dbType' => 'id',
        'comment' => 'User who created record',
      ),
      'project_id' => 
      array (
        'name' => 'project_id',
        'vname' => 'LBL_PROJECT_ID',
        'reportable' => false,
        'dbtype' => 'id',
        'type' => 'id',
      ),
      'resource_id' => 
      array (
        'name' => 'resource_id',
        'vname' => 'LBL_RESOURCE_ID',
        'reportable' => false,
        'dbtype' => 'id',
        'type' => 'id',
      ),
      'resource_type' => 
      array (
        'name' => 'resource_type',
        'vname' => 'LBL_RESOURCE_TYPE',
        'reportable' => false,
        'type' => 'varchar',
        'len' => 20,
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'vname' => 'LBL_DELETED',
        'type' => 'bool',
        'required' => false,
        'default' => 0,
        'comment' => 'Record deletion indicator',
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'projects_contacts_resources',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'dri_workflow_contacts' => 
  array (
    'name' => 'dri_workflow_contacts',
    'relationship_type' => 'one-to-many',
    'lhs_key' => 'id',
    'lhs_module' => 'Contacts',
    'lhs_table' => 'contacts',
    'rhs_module' => 'DRI_Workflows',
    'rhs_table' => 'dri_workflows',
    'rhs_key' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'dri_workflow_contacts',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contacts_b_invoices_1' => 
  array (
    'rhs_label' => 'Invoices',
    'lhs_label' => 'Contacts',
    'rhs_subpanel' => 'default',
    'lhs_module' => 'Contacts',
    'rhs_module' => 'B_Invoices',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
    'relationship_name' => 'contacts_b_invoices_1',
  ),
);