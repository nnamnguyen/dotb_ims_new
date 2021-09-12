{*

*}

<b>{$MOD.LBL_IMPORT_VCARDTEXT}</b>
{literal}
<script type="text/javascript" src="cache/javascript/dotbcrm12.min.js"></script>
<script type="text/javascript">
<!--
function validate_vcard()
{
    if (document.getElementById("vcard_file").value=="") {
        YAHOO.DOTB.MessageBox.show({msg: '{/literal}{$ERROR_TEXT}{literal}'} );
    }
    else
        document.EditView.submit();
}
-->
</script>
{/literal}
<form name="EditView" method="POST" ENCTYPE="multipart/form-data" action="index.php">
{dotb_csrf_form_token}
<input type="hidden" name="max_file_size" value="30000">
<input type='hidden' name='action' value='ImportVCardSave'>
<input type='hidden' name='module' value='{$MODULE}'>
<input type='hidden' name='from' value='ImportVCard'>

<input size="60" name="vcard" id="vcard_file" type="file" />&nbsp;
<input class='button' type="button" onclick='validate_vcard()' value="{$APP.LBL_IMPORT_VCARD_BUTTON_LABEL}" 
    title="{$APP.LBL_IMPORT_VCARD_BUTTON_TITLE}" />
</form>
<div class="error">{$ERROR}</div>
