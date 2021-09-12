{*

*}

<script>
    {literal}
    $(document).ready(function(){
	    $("ul.clickMenu").each(function(index, node){
	        $(node).dotbActionMenu();
	    });
    });
    {/literal}
</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
{dotb_csrf_form_token}
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if !empty($smarty.request.return_module) || !empty($smarty.request.relate_to)}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="is_template" value="1">
{assign var='place' value="_HEADER"} <!-- to be used for id for buttons with custom code in def files-->
{{if isset($form.hidden)}}
{{foreach from=$form.hidden item=field}}
{{$field}}   
{{/foreach}}
{{/if}}
{{if empty($form.button_location) || $form.button_location == 'top'}}
{{if !empty($form) && !empty($form.buttons)}}
   {{foreach from=$form.buttons key=val item=button}}
      {{dotb_button module="$module" id="$button" form_id="$form_id" view="$view" appendTo="header_buttons" location="HEADER"}}
   {{/foreach}}
{{else}}
{{dotb_button module="$module" id="SAVE" view="$view" form_id="$form_id" location="HEADER" appendTo="header_buttons"}}
{{dotb_button module="$module" id="CANCEL" view="$view" form_id="$form_id" location="HEADER" appendTo="header_buttons"}}
{{/if}}
{{if empty($form.hideAudit) || !$form.hideAudit}}
{{dotb_button module="$module" id="Audit" view="$view" form_id="$form_id" appendTo="header_buttons"}}
{{/if}}
{{/if}}
{{dotb_action_menu buttons=$header_buttons class="fancymenu" flat=true}}
</td>
<td align='right'>{{$ADMIN_EDIT}}
{{if $panelCount == 0}}
    {{* Render tag for VCR control if SHOW_VCR_CONTROL is true *}}
	{{if $SHOW_VCR_CONTROL}}
		{$PAGINATION}
	{{/if}}
{{/if}}
</td>
</tr>
</table>
