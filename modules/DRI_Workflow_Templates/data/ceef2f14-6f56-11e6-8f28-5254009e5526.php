<?php

return array(
    'id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
    'name' => 'Email Marketing Internal Process Management',
    'description' => '',
    'team_id' => '1',
    'team_set_id' => '1',
    'acl_team_set_id' => '',
    'acl_team_names' => '',
    'available_modules' => '^Contacts^,^Cases^',
    'dri_subworkflow_templates' =>
        array(
            '08286af2-6f57-11e6-83fa-5254009e5526' =>
                array(
                    'id' => '08286af2-6f57-11e6-83fa-5254009e5526',
                    'name' => 'Newsletter Content Definition',
                    'description' => '',
                    'team_id' => '1',
                    'team_set_id' => '1',
                    'acl_team_set_id' => '',
                    'acl_team_names' => '',
                    'label' => '01. Newsletter Content Definition',
                    'sort_order' => '1',
                    'points' => '40',
                    'related_activities' => '4',
                    'dri_workflow_task_templates' =>
                        array(
                            '11c7ffd6-6f58-11e6-9226-5254009e5526' =>
                                array(
                                    'id' => '11c7ffd6-6f58-11e6-9226-5254009e5526',
                                    'name' => 'Newsletter Content Definition',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'customer_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '1',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '08286af2-6f57-11e6-83fa-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Content Definition',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            '51c5c83e-6f58-11e6-ba5b-5254009e5526' =>
                                array(
                                    'id' => '51c5c83e-6f58-11e6-ba5b-5254009e5526',
                                    'name' => 'Content Concept To Digital Agency',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'customer_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '2',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '08286af2-6f57-11e6-83fa-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Content Definition',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('11c7ffd6-6f58-11e6-9226-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            '67c9b1fe-6f58-11e6-8ec3-5254009e5526' =>
                                array(
                                    'id' => '67c9b1fe-6f58-11e6-8ec3-5254009e5526',
                                    'name' => 'Newsletter MockUp Received',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'agency_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '3',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '08286af2-6f57-11e6-83fa-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Content Definition',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('51c5c83e-6f58-11e6-ba5b-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            'aa390468-6f58-11e6-bdf2-5254009e5526' =>
                                array(
                                    'id' => 'aa390468-6f58-11e6-bdf2-5254009e5526',
                                    'name' => 'Newsletter MockUp Accepted',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '4',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '08286af2-6f57-11e6-83fa-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Content Definition',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('67c9b1fe-6f58-11e6-8ec3-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                        ),
                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                ),
            '6839fc62-6f57-11e6-a53c-5254009e5526' =>
                array(
                    'id' => '6839fc62-6f57-11e6-a53c-5254009e5526',
                    'name' => 'Test Newsletter Content',
                    'description' => '',
                    'team_id' => '1',
                    'team_set_id' => '1',
                    'acl_team_set_id' => '',
                    'acl_team_names' => '',
                    'label' => '02. Test Newsletter Content',
                    'sort_order' => '2',
                    'points' => '40',
                    'related_activities' => '4',
                    'dri_workflow_task_templates' =>
                        array(
                            '0d824ec6-6f59-11e6-8a29-5254009e5526' =>
                                array(
                                    'id' => '0d824ec6-6f59-11e6-8a29-5254009e5526',
                                    'name' => 'Newsletter Html uploaded',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '2',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '6839fc62-6f57-11e6-a53c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Test Newsletter Content',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('dbe88326-6f58-11e6-b3ec-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            '216c5012-6f59-11e6-ade5-5254009e5526' =>
                                array(
                                    'id' => '216c5012-6f59-11e6-ade5-5254009e5526',
                                    'name' => 'Newsletter test send',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '3',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '6839fc62-6f57-11e6-a53c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Test Newsletter Content',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('0d824ec6-6f59-11e6-8a29-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            '5b081fae-6f59-11e6-a99d-5254009e5526' =>
                                array(
                                    'id' => '5b081fae-6f59-11e6-a99d-5254009e5526',
                                    'name' => 'Newsletter test send is OK',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '4',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '6839fc62-6f57-11e6-a53c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Test Newsletter Content',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            'dbe88326-6f58-11e6-b3ec-5254009e5526' =>
                                array(
                                    'id' => 'dbe88326-6f58-11e6-b3ec-5254009e5526',
                                    'name' => 'Newsletter Html received',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'agency_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '1',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => '6839fc62-6f57-11e6-a53c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Test Newsletter Content',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                        ),
                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                ),
            'b55f1554-6f57-11e6-960c-5254009e5526' =>
                array(
                    'id' => 'b55f1554-6f57-11e6-960c-5254009e5526',
                    'name' => 'Newsletter Sending',
                    'description' => '',
                    'team_id' => '1',
                    'team_set_id' => '1',
                    'acl_team_set_id' => '',
                    'acl_team_names' => '',
                    'label' => '03. Newsletter Sending',
                    'sort_order' => '3',
                    'points' => '20',
                    'related_activities' => '2',
                    'dri_workflow_task_templates' =>
                        array(
                            'ad19671c-6f59-11e6-a00b-5254009e5526' =>
                                array(
                                    'id' => 'ad19671c-6f59-11e6-a00b-5254009e5526',
                                    'name' => 'Validation Final Target List',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '1',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => 'b55f1554-6f57-11e6-960c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Sending',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                            'd6557bde-6f59-11e6-a08b-5254009e5526' =>
                                array(
                                    'id' => 'd6557bde-6f59-11e6-a08b-5254009e5526',
                                    'name' => 'Email Sending',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => '',
                                    'priority' => 'Medium',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '0',
                                    'sort_order' => '2',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => 'b55f1554-6f57-11e6-960c-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Newsletter Sending',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('ad19671c-6f59-11e6-a00b-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                        ),
                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                ),
            'd6178484-6f57-11e6-838a-5254009e5526' =>
                array(
                    'id' => 'd6178484-6f57-11e6-838a-5254009e5526',
                    'name' => 'Redemption Monitor & Reports',
                    'description' => '',
                    'team_id' => '1',
                    'team_set_id' => '1',
                    'acl_team_set_id' => '',
                    'acl_team_names' => '',
                    'label' => '04. Redemption Monitor & Reports',
                    'sort_order' => '4',
                    'points' => '10',
                    'related_activities' => '1',
                    'dri_workflow_task_templates' =>
                        array(
                            '42489970-6f5a-11e6-bcca-5254009e5526' =>
                                array(
                                    'id' => '42489970-6f5a-11e6-bcca-5254009e5526',
                                    'name' => 'Share Newsletter KPI Reports',
                                    'description' => '',
                                    'team_id' => '1',
                                    'team_set_id' => '1',
                                    'acl_team_set_id' => '',
                                    'acl_team_names' => '',
                                    'task_due_date_type' => 'days_from_previous_activity_completed',
                                    'priority' => 'High',
                                    'type' => 'internal_task',
                                    'activity_type' => 'Tasks',
                                    'duration_minutes' => '0',
                                    'direction' => 'Outbound',
                                    'points' => '10',
                                    'time_of_day' => '12:00',
                                    'task_due_days' => '14',
                                    'sort_order' => '1',
                                    'duration_hours' => '1',
                                    'duration' => '',
                                    'dri_subworkflow_template_id' => 'd6178484-6f57-11e6-838a-5254009e5526',
                                    'dri_subworkflow_template_name' => 'Redemption Monitor & Reports',
                                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                                    'blocked_by' => json_encode(array('d6557bde-6f59-11e6-a08b-5254009e5526')),
                                    'target_assignee' => 'inherit',
                                    'assignee_rule' => 'inherit',
                                ),
                        ),
                    'dri_workflow_template_id' => 'ceef2f14-6f56-11e6-8f28-5254009e5526',
                    'dri_workflow_template_name' => 'Email Marketing Internal Process Management',
                ),
        ),
    'points' => '110',
    'related_activities' => '11',
    'assignee_rule' => 'stage_start',
    'target_assignee' => 'current_user',
);