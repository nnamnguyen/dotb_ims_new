{*

*}

<script type='text/javascript'>var fileFields = new Array();</script>
<BR>
<form name="ConfigureDotbpdfSettings" enctype='multipart/form-data' method="POST" action="index.php?action=DotbpdfSettings&module=Configurator" onSubmit="if(checkFileType(null,1))return (check_form('ConfigureDotbpdfSettings'));else return false;">
{dotb_csrf_form_token}
<span class='error'>{$error}</span>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="padding-bottom: 2px;">
            <input id="SAVE_HEADER" title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button"  type="submit"  name="save" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >
            &nbsp;<input id="CANCEL_HEADER" title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=PdfManager&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " >
        </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td>

    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="edit view" {if $pdf_enable_ezpdf=="0"}style="display:none"{/if}>
        <tr>
           <td scope="row" style="text-align: center;">{html_radios name="dotbpdf_pdf_class" options=$pdf_class selected=$selected_pdf_class separator='    ' onchange='processPDFClass()'}</td>
        </tr>
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view" id="settingsForTCPDF">
        <tr>
            <th align="left" scope="row" colspan="4"><h4 >{$MOD.DOTBPDF_BASIC_SETTINGS}</h4></th>
        </tr>
        <tr>
            <td scope="row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                {counter start=0 assign='count'}
                {foreach from=$DotbpdfSettings item=property key=name}
                    {if $property.class == "basic"}
                        {counter}
                        {include file="modules/Configurator/tpls/DotbpdfSettingsFields.tpl"}
                    {/if}
                {/foreach}
                {if $count is odd}
                        <td  ></td>
                        <td  ></td>
                    </tr>
                {/if}
            </table>
            </td>
        </tr>
    </table>


    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">
        <tr>
            <th align="left" scope="row" colspan="4"><h4 >{$MOD.DOTBPDF_LOGO_SETTINGS}</h4></th>
        </tr>
        <tr>
            <td scope="row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                {counter start=0 assign='count'}
                {foreach from=$DotbpdfSettings item=property key=name}
                    {if $property.class == "logo"}
                        {counter}
                        {include file="modules/Configurator/tpls/DotbpdfSettingsFields.tpl"}
                    {/if}
                {/foreach}
                {if $count is odd}
                        <td  ></td>
                        <td  ></td>
                    </tr>
                {/if}
            </table>
            </td>
        </tr>
    </table>
<!--
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">
        <tr>
            <th align="left" scope="row" colspan="4"><h4 >{$MOD.DOTBPDF_ADVANCED_SETTINGS}</h4></th>
        </tr>
        <tr>
            <td scope="row" scope="row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                {counter start=0 assign='count'}
                {foreach from=$DotbpdfSettings item=property key=name}
                    {if $property.class == "advanced"}
                        {counter}
                        {include file="modules/Configurator/tpls/DotbpdfSettingsFields.tpl"}
                    {/if}
                {/foreach}
                {if $count is odd}
                        <td  ></td>
                        <td  ></td>
                    </tr>
                {/if}
            </table>
            </td>
        </tr>
    </table>
-->
    </td>
    </tr>
</table>

<div style="padding-top: 2px;">
<input id="SAVE_FOOTER" title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button"  type="submit" name="save" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " />
&nbsp;<input id="CANCEL_FOOTER" title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=PdfManager&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " />
</div>
{$JAVASCRIPT}
</form>
{literal}
<script type='text/javascript'>
function checkFileType(id, submit) {
	if (submit == 0) {
		var fileName = document.getElementById(id).value;
	  	if ({/literal}{$GD_WARNING}{literal}==1 && (fileName.lastIndexOf(".png") != -1||
	  		fileName.lastIndexOf(".PNG") != -1)) {
	  		fileFields[id]=id;
	  		//alert({/literal}DOTB.language.get('Configurator', 'PDF_GD_WARNING'{literal}));
	  	}
  	}
  	else if (submit == 1) {
  		for (fileField in fileFields) {
			var fileName = document.getElementById(fileField).value;
		  	if ({/literal}{$GD_WARNING}{literal}==1 && (fileName.lastIndexOf(".png") != -1||
		  		fileName.lastIndexOf(".PNG") != -1)) {
		  		//add_error_style('ConfigureDotbpdfSettings', fileField, DOTB.language.get('Configurator', 'PDF_GD_WARNING'));
		  		alert({/literal}DOTB.language.get('Configurator', 'PDF_GD_WARNING'{literal}));
		  		return false;
		  	}
  		}
  	}
  	return true;
 }
 function verifyPercent(id){
     var s = document.getElementById(id).value;
     if(isInteger(s)){
         if(inRange(s, 0, 100)){
             return true;
         }else{
             document.getElementById(id).value = "";
             return false;
         }
     }else{
         document.getElementById(id).value = "";
         return false;
     }
 }
 function verifyNumber(id){
     var s = document.getElementById(id).value;
     if(isNumeric(s)){
         return true;
     }else{
         document.getElementById(id).value = "";
         return false;
     }
 }
 function processPDFClass(){
     document.getElementById('settingsForTCPDF').style.display="";
    // document.getElementById('fontManager').style.display="";
     if(!check_form('ConfigureDotbpdfSettings')){
         for (var i = 0; i <document.ConfigureDotbpdfSettings.dotbpdf_pdf_class.length; i++) {
             if(document.ConfigureDotbpdfSettings.dotbpdf_pdf_class[i].value == "TCPDF"){
                 document.ConfigureDotbpdfSettings.dotbpdf_pdf_class[i].checked=true;
             }
         }
     }else{
         var chosen = "";
         for (var i = 0; i <document.ConfigureDotbpdfSettings.dotbpdf_pdf_class.length; i++) {
             if (document.ConfigureDotbpdfSettings.dotbpdf_pdf_class[i].checked) {
                 chosen = document.ConfigureDotbpdfSettings.dotbpdf_pdf_class[i].value;
             }
         }
         if(chosen == "EZPDF"){
             document.getElementById('settingsForTCPDF').style.display="none";
             //document.getElementById('fontManager').style.display="none";
         }
     }
 }
 processPDFClass();
</script>
{/literal}
