{*

*}
<form name='StudioWizard' id='StudioWizard' enctype='multipart/form-data' method='post' action='index.php?module=ModuleBuilder&action=portalstylesave&to_pdf=1' onsubmit="document.getElementById('uploadLabel').innerHTML=''; document.getElementById('StudioWizard').target = 'upload_target';">
{dotb_csrf_form_token}
<table>
	<tr>
		<td><input type ='file' name='filename'></td>
		<td><input type ='submit' value='{$mod.LBL_BTN_UPLOAD}' class='button'></td>
    </tr>
</table>
<iframe name="upload_target" id="upload_target" src="" title="" style="width:0;height:0;border:0px solid #fff;">
</iframe>
</form>
<br>
<span id='uploadLabel' class='error'>&nbsp;</span>
<br>
<h3>{$mod.LBL_SP_PREVIEW}</h3>
{literal}
<iframe name="style_preview" id="style_preview" width='90%' height=600 src='index.php?module=ModuleBuilder&action=portalpreview' title='index.php?module=ModuleBuilder&action=portalpreview'>
</iframe>
{/literal}
{literal}
<script>
ModuleBuilder.helpRegister('StudioWizard');
ModuleBuilder.helpSetup('portalStyle','default');
</script>
{/literal}
