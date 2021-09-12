<?php

namespace DRI_Workflow_Templates;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class TemplateExporter
{
    /**
     * @var array
     */
    private static $fieldBlacklist = array (
        'deleted',
        'date_entered',
        'date_modified',
        'modified_user_id',
        'created_by',
        'my_favorite',
        'favorite_link',
        'following',
        'following_link',
        'modified_by_name',
        'created_by_name',
        'doc_owner',
        'user_favorites',
        'created_by_link',
        'modified_user_link',
        'activities',
        'team_count',
        'team_link',
        'team_name',
        'team_count_link',
        'teams',
        'copied_template_id',
        'copied_template_name',
        'copied_template_link',
        'leads',
        'accounts',
        'contacts',
        'cases',
        'bugs',
        'opportunities',
        'contracts',
        'copies',
        'dri_workflows',
        'tasks',
        'dri_subworkflows',
        'tag',
        'tag_link',
        'locked_fields',
        'locked_fields_link',
        'blocked_by_link',
        'dri_workflow_template_link',
        'dri_subworkflow_template_link',
        'dri_workflow_template_link',
        'calls',
        'meetings',
        'active',
    );

    /**
     * @var array
     */
    private static $links = array (
        'dri_subworkflow_templates',
        'dri_workflow_task_templates',
        'web_hooks',
        'forms',
    );

    /**
     * @param string $id
     * @return array
     */
    public function exportId($id)
    {
        $template = \DRI_Workflow_Template::getById($id);
        return $this->export($template);
    }

    /**
     * @param \DotbBean $bean
     * @return array
     */
    public function export(\DotbBean $bean)
    {
        $data = $bean->toArray();

        // remove fields in blacklist
        $data = array_diff_key($data, array_flip(self::$fieldBlacklist));

        // export blocked by in old field as well to be compatible with older versions
        if ($bean instanceof \DRI_Workflow_Task_Template && $bean->hasBlockedBy()) {
            $blockedBy = $bean->getBlockedBy();
            $blockedBy = array_shift($blockedBy);

            if ($blockedBy instanceof \DRI_Workflow_Task_Template) {
                $data['blocked_by_id'] = $blockedBy->id;
                $data['blocked_by_name'] = $blockedBy->name;
            }
        }

        foreach ($data as $link => $value) {
            if ($bean->field_defs[$link]['type'] === 'link' && in_array($link, self::$links, true)) {
                $bean->load_relationship($link);

                $data[$link] = array ();
                foreach ($bean->$link->getBeans() as $related) {
                    $data[$link][$related->id] = $this->export($related);
                }
            }
        }

        return $data;
    }
}
