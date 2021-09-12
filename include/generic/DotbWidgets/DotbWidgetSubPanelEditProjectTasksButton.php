<?php





class DotbWidgetSubPanelEditProjectTasksButton extends DotbWidgetSubPanelTopButton
{
    public function getDisplayName()
    {
        return $GLOBALS['mod_strings']['LBL_VIEW_GANTT_TITLE'];
    }

    public function getWidgetId()
    {
        return 'project_task_submit_button';
    }

    public function display(array $widget_data, $additionalFormFields = array())
	{
		global $mod_strings;

		$title = $mod_strings['LBL_VIEW_GANTT_TITLE'];
		$value = $this->getDisplayName();
		$module_name = 'Project';
		$id = $widget_data['focus']->id;

		return '<form action="index.php" method="Post">'
			. '<input type="hidden" name="module" value="Project"> '
			. '<input type="hidden" name="action" value="EditGridView"> '
			. '<input type="hidden" name="return_module" value="Project" /> '
			. '<input type="hidden" name="return_action" value="DetailView" /> '
			. '<input type="hidden" name="project_id" value="' .$id . '" /> '
			. '<input type="hidden" name="return_id" value="' .$id . '" /> '
			. '<input type="hidden" name="record" value="' . $id .'" /> '
			. '<input type="submit" name="EditProjectTasks" '
			. ' class="button"'
            . ' id="' . $this->getWidgetId() . '"'
			. ' title="' . $title . '"'
			. ' value="' . $value . '" />'
			. '</form>';
	}
}
