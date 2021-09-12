<!-- -->
{*

*}

{literal}
<style type="text/css">
	.x-grid3-dirty-cell {background: none;}
</style>
{/literal}
<form id='visibility_editor' name='visibility_editor'  onsubmit='return false;'>
{dotb_csrf_form_token}
</form>
<script type="text/javascript">
var visgrid =  {$visibility_grid};
var visibilityEditor = new ModuleBuilder.VisibilityEditor ( visgrid , 'visibility_editor' , {$onSave} , {$onClose} ) ;
visibilityEditor.myEditorPanel.show();
</script>

