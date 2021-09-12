

function prep_edit(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='DetailView';
    the_form.return_id.value = the_form.record.value;
	the_form.action.value='EditView';
	the_form.dotb_body_only.value='0';
}

function prep_edit_project_tasks(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='DetailView';
    the_form.return_id.value = the_form.record.value;
	the_form.action.value='EditGridView';
	the_form.dotb_body_only.value='0';
}

function prep_duplicate(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='index';
	the_form.isDuplicate.value=true;
	the_form.action.value='EditView';
	the_form.dotb_body_only.value='0';
}

function prep_delete(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='ListView';
	the_form.action.value='Delete';
	the_form.return_id.value='';
	the_form.dotb_body_only.value='0';
}

function prep_save_as_template(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='DetailView';
    the_form.return_id.value = the_form.record.value;
	the_form.action.value='Convert';
	the_form.dotb_body_only.value='0';
}
function prep_save_as_project(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='ProjectTemplatesDetailView';
    the_form.return_id.value = the_form.record.value;
	the_form.action.value='Convert';
}

function prep_export_to_project(the_form)
{
	the_form.return_module.value='Project';
	the_form.return_action.value='DetailView';
    the_form.return_id.value = the_form.record.value;
	the_form.action.value='Export';
	the_form.dotb_body_only.value='1';
}
